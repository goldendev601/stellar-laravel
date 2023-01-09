<?php

namespace App\ModelsExtended;

use App\ModelsExtended\Interfaces\IHasFolderStoragePathModelInterface;
use App\ModelsExtended\Traits\HasImageUrlSavingModelTrait;
use App\ModelsExtended\Traits\MessageBirdRelatedModelTrait;
use App\Repositories\PhoneNumberManipulationTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use MessageBird\Objects\Contact;

/**
 * @property string $phone
 * @property string $name
 * @property string|null $image_url
 * @property SmsMessage|null $last_received_conversation
 * @property SmsMessage|null $last_sent_conversation
 */
class Member extends \App\Models\Member implements IHasFolderStoragePathModelInterface
{
    use MessageBirdRelatedModelTrait, HasImageUrlSavingModelTrait;
    use PhoneNumberManipulationTrait;

    protected $appends = [ 'image_url', 'phone','name'];

    // allow all fields to be mass assignable
    protected $fillable = [];
    protected $guarded = [];

    /**
     * @param array|int[] $member_ids
     * @return Builder[]|Collection|Member[]
     */
    public static function getMembersWithId(array $member_ids): Collection|array
    {
        return self::query()->whereIn("id", $member_ids )->get();
    }

    /**
     * @return Builder|null|Member
     */
    public static function getActiveMemberWithId(int $member_id): Builder|Member|null
    {
        return self::query()
            ->where('member_status_id', MemberStatus::Active )
            ->where("id", $member_id )
            ->first();
    }

    /**
     * @return Builder[]|Collection
     */
    public static function fetchActiveMembersWithLastSent(?string $filter = null)
    {
        return self::with('last_sent_conversation' )
            ->whereHas('last_sent_conversation')
            ->when($filter, function (Builder $builder) use ( $filter) {
                $builder->where(function (Builder $builder) use ( $filter) {
                    $builder->where('member.first_name', 'like', "%$filter%")
                        ->orWhere('member.last_name', 'like', "%$filter%");
                });
            } )
            ->where('member_status_id', MemberStatus::Active )
            ->get()
            ->sortByDesc(fn(Member $member)=> $member->last_sent_conversation->status_date_time->timestamp )
            ->map(fn(Member $member) => array_merge($member->only('id', 'first_name', 'last_name', 'image_url','name' ),
                $member->last_sent_conversation->only('body', 'status_date_time', 'status_time','status_date')
            ));

    }

    /**
     * @return Builder[]|Collection|Member[]
     */
    public static function fetchActiveMembersWithoutMessages(?string $filter = null)
    {
        return self::query()
            ->whereDoesntHave('last_sent_conversation')
            ->when($filter, function (Builder $builder) use ( $filter) {
                $builder->where(function (Builder $builder) use ( $filter) {
                    $builder->where('member.first_name', 'like', "%$filter%")
                        ->orWhere('member.last_name', 'like', "%$filter%");
                });
            } )
            ->where('member_status_id', MemberStatus::Active )
            ->orderBy('member.first_name' )
            ->get();
    }

    /**
     * Returns the version of the phone like +12233566
     *
     * @return Attribute
     */
    protected function phone(): Attribute
    {
        return Attribute::make(
            get: fn () => self::cleanUpPhoneNumber($this->msisdn),
        );
    }
    protected function statusDateTime(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status_date_time->diffForHumans(),
        );
    }
    /**
     * @return Attribute
     */
    public function name(): Attribute
    {

        return new Attribute(function () {
            $v = Str::of($this->first_name)->trim();
            if ($this->last_name) {
                $v= $v->append(' '.$this->last_name);
            }
            return $v->trim();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|Model|object
     */
    public function last_received_conversation()
    {
        return $this->hasOne(SmsMessage::class,  'receiver_msisdn', 'msisdn')
            ->latest('status_date_time');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|Model|object
     */
    public function last_sent_conversation()
    {
        return $this->hasOne(SmsMessage::class,  'sender_msisdn', 'msisdn')
            ->latest('status_date_time');
    }

    /**
     * @param string $msisdn
     * @return Model|Builder|Member|null
     */
    public static function getMemberByMsisdn(string $msisdn): Model|Builder|Member|null
    {
        return self::query()->where( 'msisdn',  $msisdn)
            ->first();
    }

    /**
     * @param Contact $contact
     * @return Model|Member|Builder|null
     */
    public static function createOrUpdateFromMessageBird(Contact $contact): Model|Member|Builder|null
    {
        $g = self::getByMessageBirdId($contact->getId());
        if( $g )
            $g->update([
                'first_name' => $contact->firstName,
                'last_name' => $contact->lastName,
                'email' => $contact->getCustomDetails()->custom1,
                ]);
        else
        {
            $g = self::createOrUpdateContact(
                $contact->msisdn,
                $contact->firstName, $contact->lastName, $contact->getCustomDetails()->custom1,
                Carbon::createFromTimeString($contact->getCreatedDatetime()),
                $contact->getUpdatedDatetime()? Carbon::createFromTimeString($contact->getUpdatedDatetime()): null,
                $contact->getId()
            );
        }
        return $g;
    }

    /**
     * @param string $msisdn
     * @param string $first_name
     * @param string|null $last_name
     * @param string|null $email
     * @param Carbon|null $created_at
     * @param Carbon|null $updated_at
     * @param string|null $message_bird_id
     * @return Builder|Model
     */
    public static function createOrUpdateContact( string $msisdn, string $first_name,
                                                  ?string $last_name, ?string $email = null,
                                                  ?Carbon $created_at = null,
                                                  ?Carbon $updated_at = null,
                                                  ?string $message_bird_id = null,
                                                  int $member_status_id = MemberStatus::Active
    ): Member
    {
      return self::query()->updateOrCreate([ 'msisdn' => $msisdn ], [
          "message_bird_id" => $message_bird_id,
          'first_name' => $first_name,
          'last_name' => $last_name,
          'email' => $email,
          "created_at" => $created_at?? now(),
          "updated_at" => $updated_at?? now(),
          "member_status_id" => $member_status_id,
      ]);
    }



    public function getFolderStorageRelativePath(): string
    {
        return "members/{$this->id}";
    }

    public static function getPhoneToMsisdn($phone): string
    {
      return  self::phoneToMsisdn($phone);
    }
}

<?php

namespace App\ModelsExtended;

use App\ModelsExtended\Traits\MessageBirdRelatedModelTrait;
use App\Repositories\SMS\MessageBirdRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

/**
 * @property Member | null $receiver
 * @property Member | null $sender
 */
class SmsMessage extends \App\Models\SmsMessage
{
    use MessageBirdRelatedModelTrait;

    /**
     * @param string $message_bird_id
     * @param string $sender_msisdn
     * @param string $receiver_msisdn
     * @param string $body
     * @param string $status
     * @param string $status_reason
     * @param string|null $recipient_country
     * @param string|null $recipient_operator
     * @param float|null $price_amount
     * @param string|null $price_currency
     * @param Carbon $status_date_time
     * @return Model|ContactGroup|Builder|null
     */

    protected $appends = [ 'status_time', 'status_day_time','status_date'];

    public static function createOrUpdateFromMessageBird(string $message_bird_id, string $sender_msisdn,
                                                         string $receiver_msisdn, string $body,
                                                         string $status, string $status_reason, ?string $recipient_country, ?string $recipient_operator,
                                                         ?float $price_amount, ?string $price_currency, Carbon $status_date_time
    ): Model|ContactGroup|Builder|null
    {
        return self::query()->updateOrCreate([
            'message_bird_id' => $message_bird_id,
            'sender_msisdn' => $sender_msisdn,
            'receiver_msisdn' => $receiver_msisdn,
        ],
            [
                'body' => $body,
                'status' => $status,
                'status_reason' => $status_reason,
                'status_date_time' => $status_date_time, // Status DateTime here gotten from MessageBird is in UTC
                'recipient_country' => $recipient_country,
                'recipient_operator' => $recipient_operator,
                'price_amount' => $price_amount,
                'price_currency' => $price_currency,
            ]);
    }

    /**
     * @return BelongsTo
     */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'receiver_msisdn', 'msisdn');
    }

    /**
     * @return BelongsTo
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'sender_msisdn', 'msisdn');
    }

    /**
     * @param Member $member
     * @param string $message
     * @return void
     * @throws \JsonException
     * @throws \MessageBird\Exceptions\HttpException
     */
    public static function startConversation(Member $member, string $message)
    {
        $messageBirdRepository = new MessageBirdRepository();
        $messageBirdRepository->sendSMS( [ $member->msisdn ], $message  );
    }

    public function getStatusDayTimeAttribute($value)
    {
        $isToday = $this->status_date_time->isToday();
        $isYesterday = $this->status_date_time->isYesterday();
        $date  = $isToday ? 'Today at' : ($isYesterday ? 'Yesterday at': $this->status_date_time->format('j M Y'));
        return  $date . ' ' . $this->status_date_time->format('g:i A');
    }

    public function getStatusTimeAttribute($value)
    {
        return  $this->status_date_time->format('g:i A');
    }
    public function getStatusDateAttribute($value)
    {
        $currentDate = Now();
        $statusDateTime = $this->status_date_time;
        $interval = $currentDate->diff($statusDateTime);
        $days = $interval->format('%a');
       if($days > 7){
           return  $this->status_date_time->format('M d');
       }
        return  $this->status_date_time->format('D');
    }

    /**
     * @param int $member_id
     * @return Collection
     */
    public static function fetchConversationsForMemberId(int $member_id): Collection
    {

        return self::with('sender', 'receiver')
            ->whereHas("sender", function (Builder $builder) use ($member_id){
                $builder->where("member.id", $member_id);
            })->orWhereHas("receiver", function (Builder $builder) use ($member_id){
                $builder->where("member.id", $member_id);
            })
            ->orderBy('status_date_time')
            ->limit(50)
            ->get()
            ->map(function (SmsMessage $chat) use ($member_id){
                return [
                    'is_admin_message' => optional($chat->sender)->id !== $member_id,
                    'message' => $chat->body,
                    'status_date_time' => $chat->status_date_time,
                    'status_day_time' => $chat->status_day_time,
                    'receiver' => $chat->receiver? $chat->receiver->name : $chat->receiver_msisdn,
                    'receiver_image_url' => optional($chat->receiver)->image_url,
                    'receiver_msisdn' => $chat->receiver_msisdn,
                    'sender_msisdn' => $chat->sender_msisdn,
                    'sender' => $chat->sender? $chat->sender->name : $chat->sender_msisdn,
                    'sender_image_url' => optional($chat->sender)->image_url,
                    'status' => $chat->status
                ];
            });
    }
}

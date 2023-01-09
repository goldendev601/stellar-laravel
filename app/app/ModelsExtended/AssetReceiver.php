<?php

namespace App\ModelsExtended;

use App\Repositories\SMS\Message;
use App\Repositories\SMS\MessageBirdRepository;
use App\Repositories\SMS\MessageResponse;
use App\Repositories\SMS\Recipient;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property Asset $asset
 * @property Member $member
 */
class AssetReceiver extends \App\Models\AssetReceiver
{
    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Sample:  AssetReceiver::sendAsset( $asset->id,  $asset->getShareableMessageSample() , [ 24,25,26,27 ]  );
     *
     * @param int $asset_id
     * @param string $message
     * @param array $member_ids
     * @return void
     * @throws \JsonException
     * @throws \MessageBird\Exceptions\HttpException
     */
    public static function sendAsset(int $asset_id, string $message, array $member_ids): void
    {
        $members = self::getMembersWithIdNotSent($member_ids, $asset_id);
        if( !$members->count() ) throw new \Exception( "List doesn't contain valid members with phone numbers!" );

        $collectMsIsdnToMemberId = $members->map(fn( Member $member) => [ $member->phone => $member->id ] )->collapse();

        $messageBirdRepository = new MessageBirdRepository();

        $messageResult = $messageBirdRepository->sendSMS( $members->pluck("msisdn")->toArray(), $message  );
        if($messageResult instanceof MessageResponse && $messageResult->recipients->totalSentCount ) {
            collect($messageResult->recipients->items)
                ->filter(fn(Recipient $recipient) => $recipient->status === Message::DELIVERY__SENT)
                ->each(function (Recipient $recipient) use ($message, $asset_id, $collectMsIsdnToMemberId) {
                    self::query()->updateOrInsert([
                        'asset_id' => $asset_id,
                        'member_id' => $collectMsIsdnToMemberId->get("+" . $recipient->recipient),
                    ], [
                        'message' => $message,
                        'message_bird_id' => $recipient->messageId,
                        'msisdn' => $recipient->recipient,
                        'status' => $recipient->status,
                    ]);

                });
        }
    }


    /**
     * @param array|int[] $member_ids
     * @return Builder[]|Collection|Member[]
     */
    public static function getMembersWithIdNotSent(array $member_ids, int $asset_id): Collection|array
    {
        return Member::query()
            ->whereIn("id", $member_ids )
            ->where("member_status_id", MemberStatus::Active )
            ->whereRaw("length(msisdn) > 6" )
            ->whereDoesntHave( "asset_receivers", function (Builder $builder) use($asset_id){
                $builder->where( 'asset_receiver.asset_id', $asset_id  );
            })
            ->get( );
    }
    public static function getAssetReceiverList(int $asset_id): Collection|array
    {
       return  self::query()->with('member','asset.assetCategory')->where('asset_id',$asset_id)->get();
    }
}

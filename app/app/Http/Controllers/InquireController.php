<?php

namespace App\Http\Controllers;

use App\Console\Commands\Sync\SyncMessageBirdMessagesCommand;
use App\ModelsExtended\Asset;
use App\ModelsExtended\Member;
use App\ModelsExtended\MemberStatus;
use App\ModelsExtended\User;
use App\Notifications\InquireNotification;
use App\Repositories\SMS\MessageBirdRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class InquireController extends Controller
{
    public function makeInquire(Request $request)
    {
        try {
            $phone_number = $request->member['phone'];
            $first_name = $request->member['first_name'];
            $last_name = $request->member['last_name'];
            $email = $request->member['email'];
            $asset_id = $request->asset_id;
            $checkMember = Member::getMemberByMsisdn(Member::getPhoneToMsisdn($phone_number));

            if ($phone_number != null) {
                $member = Member::createOrUpdateContact(
                    Member::getPhoneToMsisdn($phone_number),
                    $first_name,
                    $last_name,
                    $email,
                    null,
                    null,
                    null,
                    $checkMember == null ? MemberStatus::Waitlist : MemberStatus::Active
                );

                $this->sendNotification($member, $asset_id);
                return response()->json([
                    'status' => 200,
                    'message' => 'We have been notified and we will get back to the user ASAP'
                ]);
            }
        }catch (\Exception $e){
            return response()->json([
                'status' => 300,
                'message' => 'Something went wrong. please try again latter.'
            ]);
        }


    }

    public function sendNotificationToUser($member, $asset_id): bool
    {
//        $asset = Asset::getById($asset_id);  // get asset for asset name
//        $user = User::where('email', env('ADMIN_EMAIL'))->first();  // get admin
//        $messageBody = 'I want to inquire about (' . $asset->name . ') from phone number ' . $member->phone;
//
//        $inquire = [
//            'greeting' => 'Hi ' . $user->name . ',',
//            'body' => $messageBody,
//            'thanks' => 'Thank you this is from stellar',
//        ];
//
//        Notification::send($user, new InquireNotification($inquire));
//        $senderApi = new MessageBirdRepository();
//        $senderApi->sendSMS([Member::getPhoneToMsisdn(env('ADMIN_MOBILE'))], $messageBody);
//        sleep(4);

        return true;
    }
    public function sendNotification($member, $asset_id): bool
    {

        $asset = Asset::getById($asset_id);  // get asset for asset name
        $adminMessageBody = 'I want to inquire about (' . $asset->name . ') from phone number ' . $member->phone;

        $adminInquire = [
            'greeting' => 'Hi Admin',
            'body' => $adminMessageBody,
            'thanks' => 'Thank you this is from stellar',
        ];
        $memberInquire = [
            'greeting' => 'Hi '.$member->name,
            'body' => 'We have been notified and we will get back to the user ASAP',
            'thanks' => 'Thank you this is from stellar',
        ];

        //inform admin about inquire
        if(env('ADMIN_EMAIL')){
            Notification::route('mail', env('ADMIN_EMAIL'))->notify( new InquireNotification($adminInquire));
        }

        if(env('ADMIN_MOBILE')){
            $senderApi = new MessageBirdRepository();
            $senderApi->sendSMS([Member::getPhoneToMsisdn(env('ADMIN_MOBILE'))], $adminMessageBody);
            sleep(4);
        }

        //notify member who make inquire

        if($member->email !=null){
            Notification::route('mail', $member->email)->notify( new InquireNotification($memberInquire));
        }

        if($member->msisdn){
            $senderApi = new MessageBirdRepository();
            $senderApi->sendSMS([$member->msisdn], 'We have been notified and we will get back to the user ASAP');
            sleep(4);
        }

        return true;
    }

    public function validateMember(Request $request)
    {
        return  Member::getMemberByMsisdn(Member::getPhoneToMsisdn($request->phone));

    }

}

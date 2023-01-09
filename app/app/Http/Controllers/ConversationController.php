<?php

namespace App\Http\Controllers;

use App\Console\Commands\Sync\SyncMessageBirdMessagesCommand;
use App\Models\Asset;
use App\ModelsExtended\Member;
use App\ModelsExtended\SmsMessage;
use App\ModelsExtended\Vendor;
use App\Repositories\SMS\MessageBirdRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ConversationController extends Controller
{
    /**
     * Show the Library Dashboard.
     *
     * @return Renderable
     */
    public function index($id = null)
    {

        // Check this method startConversation() for starting conversation
//         $this->startConversation();


        // List of members with no conversations
        // return Member::fetchActiveMembersWithoutMessages('fair');


        // Use this to fetch the list on the sidebar for people with conversation
        // return Member::fetchActiveMembersWithLastReceived('Raza');


        // Send Message
        // MsIDN and Message
//         $senderApi->sendSMS([ Member::getActiveMemberWithId(402)->msisdn ], MessageBody );
        // -----------------------------------
//        $senderApi = new MessageBirdRepository();
//        $senderApi->sendSMS([ Member::getActiveMemberWithId(402)->msisdn ],"This is the best Developer Called Ali" );
//        sleep(5);
//        SyncMessageBirdMessagesCommand::loadToday();
        // -----------------------------------


        // Show conversation
//         return SmsMessage::fetchConversationsForMemberId(402);

        $member = ($id != null) ? Member::getActiveMemberWithId($id) : array();
        return view('conversations.index', compact('member'))
            ->withVendors(Vendor::all());
    }

    public function sendSms(Request $request)
    {

        $senderApi = new MessageBirdRepository();
        $senderApi->sendSMS([Member::getActiveMemberWithId($request->input('memberId'))->msisdn], $request->text);
        sleep(4);
        SyncMessageBirdMessagesCommand::loadToday();
    }

    public function membersWithConversation()
    {
        // Use this to fetch the list on the sidebar for people with conversation
        return Member::fetchActiveMembersWithLastSent()->values();
    }

    public function fetchConversationsForMemberId($id)
    {
        // Show conversation
        return SmsMessage::fetchConversationsForMemberId($id);
    }

    public function membersWithNoConversation()
    {
        return Member::fetchActiveMembersWithoutMessages();
    }

    /**
     * Show the Assets Library.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('conversations.create');
    }

    public function startConversation(Request $request)
    {
        // Call the 2 methods
        SmsMessage::startConversation(Member::getActiveMemberWithId($request->memberId), $request->message);
//        sleep(5); // wait 5 secs
//        SyncMessageBirdMessagesCommand::loadToday();
    }

    public function showConversations($id): Renderable
    {
        return view('conversations.current')
            ->with("conversations", SmsMessage::fetchConversationsForMemberId($id));
    }
}

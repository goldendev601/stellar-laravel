<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Responses\OkResponse;
use App\ModelsExtended\Member;
use App\ModelsExtended\MemberStatus;
use App\Repositories\PhoneNumberManipulationTrait;
use App\Rules\PhoneNumberValidationRule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WaitingListController extends Controller
{
    /**
     * Sample usage:
     *  http://ubuntu-dell:14080/api/join-waiting-list?first_name=Diego&last_name=Bustamante&email=diezstamante@gmail.com&phone=851111116709&zip_code=07601
     *
     * @param Request $request
     * @return OkResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:150',
            'last_name' => 'required|string|max:150',
            'email' => 'required|email|max:250',
            'phone' => 'required|string|max:30',
            'zip_code' => 'nullable|string|max:50',
        ]);

        // DEFAULT USA
        $phone = $request->input('phone');
        $phone = Str::of($phone)->startsWith('+')? $phone : '+1' . $phone ;
        $phone = PhoneNumberManipulationTrait::cleanUpPhoneNumber($phone);

        if( ! (new PhoneNumberValidationRule() )->passes('', $phone))
            throw new \InvalidArgumentException('Please, enter a valid phone number!');

        $msisdn = Member::phoneToMsisdn(  $phone );
        $member = Member::getMemberByMsisdn($msisdn);
        if( $member )
        {
            $member->update([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'msisdn' => $msisdn,
                'zipcode' => $request->input('zip_code'),
            ]);
        }
        else
        {
            Member::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'msisdn' => $msisdn,
                'zipcode' => $request->input('zip_code'),
                "member_status_id" => MemberStatus::Waitlist,
            ]);
        }

        // info( "Logging posted data", $request->all() );

        return new OkResponse();
    }
}

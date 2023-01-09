<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Models\MemberGroup;
use App\ModelsExtended\ContactGroup;
use App\ModelsExtended\Member;
use App\ModelsExtended\MemberInterest;
use App\ModelsExtended\MemberStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DataTables;

use Illuminate\Contracts\Support\Renderable;

class MemberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function formatUSAPhone($val): ?string
    {
        if (!$val) return null;
        $v = Str::of(strval($val));
        if ($v->startsWith("00")) $v = $v->substr(2);
        if ($v->length() < 7) return (string)$v;
        return sprintf(
            "+%s (%s) %s-%s",
            $v->substr(0, 1),
            $v->substr(1, 3),
            $v->substr(4, 3),
            $v->substr(7)
        );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $datefilter = !empty($request->datefilter) ? $request->datefilter : '';
            $status = !empty($request->status) ? $request->status : '';
            $search_asset = !empty($request->search_asset) ? $request->search_asset : '';
            $search = !empty($request->search) ? $request->search['value'] : '';
            $cgID = [];
            $member_id = [];

            $query = Member::with(['member_status']);

            if (!empty($datefilter)) {
                $dateFilterTemp = explode('- ', $datefilter);
                if (count($dateFilterTemp) > 0) {
                    $startDate = Carbon::parse(trim($dateFilterTemp[0]))->format('Y-m-d');
                    $endDate = Carbon::parse(trim($dateFilterTemp[1]))->format('Y-m-d');
                    $query->whereBetween('created_at', [$startDate, $endDate]);
                }

            }
            if (!empty($status)) {

                $query->whereIn('member_status_id', $status);
            }

            if (!empty($search_asset)) {
                $query->where(\DB::raw('CONCAT(first_name, " ", last_name)'), 'LIKE', '%' . $search_asset . '%');
            }

            return Datatables::of($query)
                ->editColumn('first_name', function ($row) {
                    return $row->first_name . ' ' . $row->last_name;
                })
                ->editColumn('member_status_id', function ($row) {
                    return $row->member_status->description;
                })
                ->editColumn('created_at', function ($row) {
                    return date('d-m-Y H:i:s', strtotime($row->created_at));
                })
                ->editColumn('msisdn', function ($row) {
                    return $row->phone;
                })
                ->editColumn('contact_group', function ($row) {
                    $mg = MemberGroup::where('member_id', $row->id)->pluck('contact_group_id');
                    if (count($mg) > 0) {
                        $cg = ContactGroup::whereIn('id', $mg)->pluck('name')->toArray();
                        return implode(', ', $cg);
                    } else {
                        return '';
                    }
                })
                ->filterColumn('contact_group', function ($query, $search) {
                    if (!empty($search)) {
                        $cgID = ContactGroup::where('name', 'like', '%' . $search . '%')->pluck('id')->toArray();
                        if (count($cgID) > 0) {
                            $member_id = MemberGroup::whereIn('contact_group_id', $cgID)->pluck('member_id')->toArray();
                            $query->whereIn('id', array_unique($member_id));
                        }
                    }
                })
                ->addColumn('action', 'dashboard.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('dashboard.members');
    }


    public function membersExportCSV(Request $request) 
    {
        $status_info = $request->status;
        $members = [];
        if ($status_info) {
            $filtered_status_list = explode(",", $status_info);
            if (count($filtered_status_list) === 3) {
                $members = Member::whereIn('member_status_id', $filtered_status_list)->with(['member_status'])->orderBy('updated_at','DESC')->limit(240)->get();
            } else {
                $members = Member::whereIn('member_status_id', $filtered_status_list)->with(['member_status'])->orderBy('updated_at','DESC')->get();
            }
        } 

        $fileName = 'members.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Name', 'Email', 'Phone', 'Zip Code', 'Status', 'Created at');

        $file = fopen($fileName, 'w');
        fputcsv($file, $columns);

        foreach ($members as $member) {
            $row['Name'] = $member->first_name . ' ' .  $member->last_name;
            $row['Email'] = $member->email;
            $row['Phone'] = '+' . $member->msisdn;
            $row['Zip Code'] = $member->zipcode;
            $row['Status'] = $member->member_status->description;
            $row['Created at'] = $member->created_at;
            fputcsv($file, array($row['Name'], $row['Phone'], $row['Email'], $row['Zip Code'], $row['Status'], $row['Created at'] ));
        }

        fclose($file);

        return response()->download($fileName, 'members_info.csv', $headers);

    }


    public function addMember()
    {
        $interests = MemberInterest::getUniqueInterest()->get();
        $groups = ContactGroup::getUniqueGroup()->get();
        return view('dashboard.members.add', ['interests' => $interests, 'groups' => $groups, 'statuses' => MemberStatus::all()]);
    }

    public function memberInterest()
    {
        $interests = MemberInterest::getUniqueInterest()->get();
        return response()->json($interests);
    }

    public function editMember($id)
    {
        $member = Member::with('member_interests', 'member_groups.contact_group')->find($id);

        $interests = MemberInterest::getUniqueInterest()->get();
        $groups = ContactGroup::getUniqueGroup()->get();
        return view(
            'dashboard.members.edit',
            [
                'interests' => $interests,
                'statuses' => MemberStatus::all(),
                'member' => $member,
                'groups' => $groups
            ]
        );
    }

    /**
     * @param MemberRequest $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function insertMember(MemberRequest $request)
    {
        try {


            $member = new Member;

            $member->first_name = $request->input('first_name');
            $member->last_name = $request->input('last_name');
            $member->email = $request->input('email');
            $member->msisdn = Member::phoneToMsisdn($request->input('msisdn'));
            $member->zipcode = $request->input('zipcode');
            $member->member_status_id = $request->input('member_status_id');
            $member->save();

            // store image
            if ($request->hasFile('image')) {
                $member->image_relative_url = $member->saveImageOnCloud($request->file('image'), $member);
                $member->update();
            }

            //attach interest
            $interest_inputs = $request->input('interests');
            if (!empty($interest_inputs)) {
                $interest_inputs_arr = explode(",", $interest_inputs);
                $interests = [];
                foreach ($interest_inputs_arr as $key => $value)
                    $interests[] = new MemberInterest(['interest' => $value]);
                $member->member_interests()->saveMany($interests);
            }
            // attach group
            $group_inputs = $request->input('groups');
            if (!empty($group_inputs)) {
                $group__inputs_arr = explode(",", $group_inputs);
                $groups = [];
                foreach ($group__inputs_arr as $key => $value) {
                    $group = ContactGroup::updateOrCreate(['name' => $value], ['name' => $value]);
                    MemberGroup::create(['member_id' => $member->id, 'contact_group_id' => $group->id]);
                }
            }

            return response()->json([
                'status' => 200,
                'message' => 'Saved successfully'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 400,
                'message' => 'Something went wrong, please try again.'
            ]);
        }
    }


    public function updateMember(MemberRequest $request, $id)
    {

        try {

            $member = Member::find($id);
            if (!$member) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Invalid request, Please try again.'
                ]);

            }

            $member->first_name = $request->first_name;
            $member->last_name = $request->last_name;
            $member->email = $request->email;
            $member->msisdn = Member::phoneToMsisdn($request->input('msisdn'));
            $member->zipcode = $request->zipcode;
            $member->member_status_id = $request->member_status_id;
            $member->save();

            // store image
            if ($request->hasFile('image')) {
                $member->image_relative_url = $member->saveImageOnCloud($request->file('image'), $member);
                $member->update();
            }

            // attach interest
            $interest_inputs = $request->input('interests');
            if (!empty($interest_inputs)) {
                $interest_inputs_arr = explode(",", $interest_inputs);
                $interests = [];
                MemberInterest::where('member_id', $id)->delete();
                foreach ($interest_inputs_arr as $key => $value)
                    $interests[] = new MemberInterest(['interest' => $value]);
                $member->member_interests()->saveMany($interests);
            }

            // attach group
            $group_inputs = $request->input('groups');
            if (!empty($group_inputs)) {
                $group__inputs_arr = explode(",", $group_inputs);
                $groups = [];
                MemberGroup::where('member_id', $id)->delete();
                foreach ($group__inputs_arr as $key => $value) {
                    $group = ContactGroup::updateOrCreate(['name' => $value], ['name' => $value]);
                    MemberGroup::create(['member_id' => $member->id, 'contact_group_id' => $group->id]);
                }
            }

            return response()->json([
                'status' => 200,
                'message' => 'Update successfully'
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 400,
                'message' => 'Something went wrong, please try again.'
            ]);
        }
    }


    /**
     * @return Renderable
     */
    public function showMember($memberId): Renderable
    {
        $member = Member::with('member_interests')->find($memberId);
        return view('dashboard.members.current', [
            'member' => $member
        ]);
    }

    public function statusChange(Request $request)
    {
        $id = (int)$request->id;
        $member = Member::find($id);
        if (!$member) {
            return response()->json([
                'status' => 'FAIL',
                'message' => 'Invalid request, Please try again.'
            ]);
        }
        $member->member_status_id = (int)$request->status;
        $member->save();

        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'Status has been updated successfully.'
        ]);
    }

    public function searchUsers(Request $request)
    {
        $user = $request->member;
        $members = Member::select('id', 'first_name', 'last_name')->where(\DB::raw('CONCAT(first_name, " ", last_name)'), 'LIKE', '%' . $user . '%')->get();
        $html = '';
        foreach ($members as $key => $member) {
            $html .= '<li class="member_name">' . $member->first_name . ' ' . $member->last_name . '</li>';
        }

        return response()->json([
            'html' => $html
        ]);
    }
}

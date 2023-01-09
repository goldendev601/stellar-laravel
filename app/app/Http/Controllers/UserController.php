<?php

namespace App\Http\Controllers;

use App\ModelsExtended\User;
use App\ModelsExtended\Role;
use App\ModelsExtended\AccountStatus;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DataTables;
use Mail;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::query()
            ->orderBy(
                'id',
                'DESC'
            )
            ->get();

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editUser($id)
    {
        $user = User::find($id);
        $roles = Role::query()->orderBy('id', 'DESC')->get();
        $statusList = AccountStatus::query()->orderBy('id', 'DESC')->get();

        return view(
            'users.edit',
            [
                'roles' => $roles,
                'statusList' => $statusList,
                'user' => $user
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request, $id)
    {
        try {
            //validation
            $validator = Validator::make($request->all(), [
                'status_id' => 'required',
                'role_id' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = User::find($id);
            if (!$user) {
                return redirect()->back()->with('error', 'Invalid request, Please try again.');
            }

            $user->status_id = $request->input('status_id');
            $user->role_id = $request->input('role_id');
            $user->save();

            Mail::send('email.updateUser', ['firstName' => $user->first_name], function($message) use($request, $user){
                $message->to($user->email);
                $message->subject('From Stellar');
            });

            return redirect('/users')->with("success", "User info has been updated successfully");
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Models\MemberGroup;
use App\ModelsExtended\User;
use App\ModelsExtended\ContactGroup;
use App\ModelsExtended\Member;
use App\ModelsExtended\MemberInterest;
use App\ModelsExtended\MemberStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DataTables;
use Hash;

use Illuminate\Contracts\Support\Renderable;

class SettingController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('dashboard.settings');
    }

    public function submitResetPasswordForm(Request $request)
    {
        $login_user_email = Auth::user()->email;
        $request->validate([
              'password' => 'required|string|min:6',
              'password_confirmation' => 'required|string|min:6'
        ]);

        if(!$request->old_password){
            return back()->withInput()->with('error', 'Please fill the old password');
        }

        if($request->password !== $request->password_confirmation){
            return back()->withInput()->with('error', 'Password is not matched with Confirm Password.');
        }
  
        $user = User::where('email', $login_user_email)
                      ->update(['password' => Hash::make($request->password)]);
 
  
        return redirect('/logout')->with('message', 'Password has been changed!');
    }
    
}

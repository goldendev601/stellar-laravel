<?php
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use App\ModelsExtended\AccountStatus;
use App\ModelsExtended\Role;
use App\ModelsExtended\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials) && \auth()->user()->isActive() ) {
            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully logged in.');
        }

        if( \auth()->check() && !\auth()->user()->isActive() )
        {
            \auth()->logout();
            return redirect("login")->withErrors(['msg' =>'Whoops! Your credential is not Approved yet.']);
        }

        return redirect("login")->withErrors(['msg' =>'Whoops! You have entered invalid credentials']);
    }

    
    public function registration()
    {
        return view('auth.registration');
    }

    public function forgotpassword()
    {
        return view('auth.forgotpassword');
    }
    public function resetpassword()
    {
        return view('auth.forgotpassword');
    }

    public function doRegistration(Request $request)
    {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);

            $data = $request->all();
            $this->create($data);
            return redirect("login")->withErrors(['msg' =>'Your account has been registered. The Organization will approve your registration and get back to you.']);
//        if($check && Auth::attempt(['email'=> $request->input('email'),'password'=>$request->input('password')])){
//            return redirect("dashboard")->with('logiggedin-success', 'Great! You have Successfully registered and logged in');
//        }
//        return redirect("registration")->with('registration-error', 'Something went wrong');
    }

    public function create(array $data)
    {
      return User::create([
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'name' => $data['first_name']." ".$data['last_name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
          'role_id' => Role::Administrator,
          'status_id' => AccountStatus::PENDING_APPROVAL
      ]);
    }

    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }

    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard.index');
        }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }
}
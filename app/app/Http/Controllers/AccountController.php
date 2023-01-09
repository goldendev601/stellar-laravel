<?php

namespace App\Http\Controllers;

use App\ModelsExtended\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
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
        $login_user_id = Auth::user()->id;
        $user = User::where('id', $login_user_id)->first();
        return view(
            'dashboard.account',
            [
                'user' => $user
            ]
        );
    }


    public function editName(Request $request) {
        try {
            $login_user_id = Auth::user()->id;
            $user = User::where('id', $login_user_id)->first();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->name = $request->first_name . " " . $request->last_name;
            $user->save();
            return response()->json([
                'status' => 200,
                'message' => 'Saved successfully',
                'user' => $user
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 400,
                'message' => 'Something went wrong, please try again.'
            ]);
        }
    }

    /**
     * Submit image upload.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageCropPost(Request $request)
    {
        $data = $request->image;

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);

        $data = base64_decode($data);
        $image_name = time() . '.png';
        $path = public_path() . "/images/" . $image_name;

        file_put_contents($path, $data);

        return response()->json(['status' => 1, 'message' => "Image uploaded successfully"]);
    }


    public function editAvatar(Request $request)
    {
        try {

            $login_user_id = Auth::user()->id;
            $user = User::where('id', $login_user_id)->first();

            if ($request->hasFile('image')) {
                $user->image_relative_url = $user->saveImageOnCloud($request->file('image'), $user);
                $user->update();
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
    
}

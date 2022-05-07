<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    //

    public function login()
    {
        return view('home.account.login');
    }

    public function register()
    {
        return view('home.account.register');
    }

    public function doLogin(Request $request) 
    {
        if(setting('captcha_v2_mode') == 'on') {
            $validator = Validator::make($request->all(), [
                "g-recaptcha-response" => "required"
            ]);

            if(!$validator->fails()) {
                if(!validCaptcha(request('g-recaptcha-response'), $request->ip())) {
                    return redirect()->back()->withErrors([
                        __('auth.captcha_failed')
                    ]);
                }
            }else{
                return redirect()->back()->withErrors($validator)->withInput(
                    $request->except('password')
                );
            }
        }

        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required|min:8"
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput(
                $request->except('password')
            );
        }

        $auth = Auth::attempt([
            'email' => $request->email, 
            'password' => $request->password
        ], $request->has('rememberme'));

        if($auth) {

            Log::insert([
                "user" => $request->email,
                "content" => __('account.log_login_success'),
                "useragent" => $request->server('HTTP_USER_AGENT'),
                "ip" => $request->ip()
            ]);

            return redirect('/');

        }else{
            return redirect()->back()->withErrors([
                __('auth.failed')
            ]);
        }

    }

    public function doRegister(Request $request)
    {
        if(setting('captcha_v2_mode') == 'on') {
            $validator = Validator::make($request->all(), [
                "g-recaptcha-response" => "required"
            ]);

            if(!$validator->fails()) {
                if(!validCaptcha(request('g-recaptcha-response'), $request->ip())) {
                    return redirect()->back()->withErrors([
                        __('auth.captcha_failed')
                    ]);
                }
            }else{
                return redirect()->back()->withErrors($validator)->withInput(
                    $request->except('password')
                );
            }
        }


        
        $validator = Validator::make($request->all(), [
            "name" => "required|max:15",
            "email" => "required|email",
            "password" => "required|min:8"
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput(
                $request->except('password')
            );
        }

        $check = User::where('email', $request->email)->exists();

        if (!$check) {
            
            User::insert([
                "name" => $request->name,
                "email" => $request->email,
                "password" => bcrypt($request->password),
                "role" => "member",
                "last_ip" => $request->ip()
            ]);

            $user = User::where('email', $request->email)->first();

            User::where('email', $request->email)->update([
                "access_token" => $user->createToken('Auth Token')->accessToken
            ]);

            Auth::loginUsingId($user['id']);

            return redirect('/');

        } else {
            return redirect()->back()->withErrors([
                __('auth.exists')
            ]);
        }
    }

    public function profile()
    {
        $logs = Log::where('user', Auth::user()->email)->orderBy('id', 'desc')->paginate(10);
        return view('home.account.profile', compact('logs'));
    }

    public function change_password()
    {
        return view('home.account.change_password');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login');
    }

    public function doChangePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "old" => "required|min:8",
            "new" => "required|min:8",
            "confirm" => "required|min:8|same:new",
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }

        if (Hash::check($request->old, Auth::user()->password)) {
            
            // User::where('id', Auth::user()->id)->update([
            //     "password" => bcrypt($request->new)
            // ]);
            
            $user = Auth::user();
            $user->password = $request->new;
            $user->save();

            Log::insert([
                "user" => Auth::user()->email,
                "content" => __('account.change_password_log'),
                "useragent" => $request->server('HTTP_USER_AGENT'),
                "ip" => $request->ip()
            ]);

            Auth::logout();

            return redirect()->route('account.login')->withErrors([
                __('account.re_login')
            ]);

        } else {
            return redirect()->back()->with('error', __('auth.wrong_old_password'));
        }
    }

}

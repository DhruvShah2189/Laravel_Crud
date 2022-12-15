<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function index()
    {
        return view('auth.passwords.email');
    }

    public function forgotPwd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('password.email')->withErrors($validator)->withInput(); // send back all errors to the login form
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {

            $passwordreset = new PasswordReset;
            $token = Str::random(30);
            $passwordreset->email = $request->email;
            $passwordreset->token = $token;
            $passwordreset->created_at = Carbon::now()->addMinutes(2);
            $passwordreset->save();

            Mail::send('auth.passwords.resetpassword', ['token' => $token, 'name' => $user->name], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password');
            });

            return redirect()->route('login')->with('success', 'Reset Link Sent Successfully');
        } else {
            return redirect()->route('forgotpassword')
                ->withErrors("Email does Not Exists") // send back all errors to the login form
                ->withInput();
        }
    }

    public function resetPasswordPage($token)
    {
        $check_token = PasswordReset::where('token', $token)->where('created_at', '>', Carbon::now())->first();

        if ($check_token) {
            return view('auth.passwords.reset', compact('token'));
        } else {
            return view('auth.passwords.expired_reset_password');
        }
    }

    public function resetPassword(Request $request)
    {

        $request->validate([
            'password' => 'required|confirmed',
        ]);

        $changed_password = $request->password;
        $check_token = PasswordReset::where('token', $request->token)->where('created_at', '>', Carbon::now())->first()->toArray();
        if ($check_token) {
            $user = User::where('email', $check_token['email'])->first();
            if (!Hash::check($changed_password, $user->password)) {
                $user->fill([
                    'password' => Hash::make($changed_password),
                ])->save();

                $data = PasswordReset::where('token', $check_token['token'])->delete();
                return redirect()->route('login');
            } else {
                return redirect()->route('forgotpassword')->withErrors("Old and New passwords are same")->withInput();
            }
        } else {
            return redirect()->route('forgotpassword');
        }
    }
}

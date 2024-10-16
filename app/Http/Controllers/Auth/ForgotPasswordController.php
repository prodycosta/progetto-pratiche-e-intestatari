<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Utente;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('pages.forgot-password');
    }

    function showLinkRequestFormPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:utenti',
        ]);
        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send("emails.forget-password", ["token" => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject("Reset Password");
        });
        return redirect()->to(route("pages.forgot-password"))->with("success");
    }

    function resetPassword($token)
    {
        return view("pages.reset-password", compact('token'));
    }

    function resetPasswordPost(Request $request)
    {
        try {
            $request->validate([
                "email" => "required|email|exists:utenti",
                "password" => "required|string|min:6|confirmed",
                "password_confirmation" => "required"
            ], [
                'password.confirmed' => 'La conferma della password non corrisponde.'
            ]);
            if ($request->password !== $request->password_confirmation) {
                return redirect()->back()->withInput()->withErrors(['password' => 'La conferma della password non corrisponde.']);
            }

            $updatePassword = DB::table('password_resets')
                ->where([
                    "email" => $request->input('email'),
                    "token" => $request->input('token'),
                ])->first();

            if (!$updatePassword) {
                return redirect()->to(route("pages.reset-password"))->with("error", "Invalid token");
            }

            Utente::where("email", $request->email)->update(["password" => Hash::make($request->password)]);

            DB::table("password_resets")->where(["email" => $request->email])->delete();

            return redirect()->to(route("pages.login"))->with("success", "Password reset success");
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['password' => 'Si è verificato un errore durante il reset della password.']);
        }
    }
}

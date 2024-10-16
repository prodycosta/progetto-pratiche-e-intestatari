<?php

namespace App\Http\Controllers;

use App\Models\Utente;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    use RegistersUsers;

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nome' => 'required|string',
            'cognome' => 'required|string',
            'username' => 'required|string|unique:utenti',
            'email' => 'required|email|unique:utenti',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return Utente::create([
            'nome' => $data['nome'],
            'cognome' => $data['cognome'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'data_creazione' => now(),
            'attivo' => true,
            'ruolo' => 2,
        ]);
    }

    public function showRegistrationForm()
    {
        return view('pages.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        $this->guard()->login($user);
        return redirect($this->redirectPath())->with('success', 'Registration successful! Please login.');
    }

    public function showLoginForm()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');
        if ($remember) {
            $request->session()->put('remembered_password', $credentials['password']);
        }
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->forget('remembered_password');
            return redirect()->route('pages.index');
        }

        return redirect()->route('pages.login')
            ->withInput($request->except('password'))
            ->with('error', 'Invalid credentials. Please try again.');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('pages.login');
    }
    public function showForgotPasswordForm()
    {
        return view('pages.forgot-password');
    }
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetPasswordForm($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('pages.login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    protected function sendResetLinkResponse($response)
    {
        return back()->with('status', trans($response));
    }
}

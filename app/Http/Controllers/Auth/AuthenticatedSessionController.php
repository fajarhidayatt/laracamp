<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\RegisterSuccess;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view for admin.
     */
    public function loginAdmin(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request for admin.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended('/admin');
    }

    /**
     * Display the login view for user.
     */
    public function create(): View
    {
        return view('pages.login');
    }

    /**
     * Display google account page for login user.
     */
    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Callback to handle google auth
     */
    public function googleCallback()
    {
        $callback = Socialite::driver('google')->user();

        $data = [
            'name' => $callback->getName(),
            'email' => $callback->getEmail(),
            'avatar' => $callback->getAvatar(),
            'email_verified_at' => date('Y-m-d H:i:s', time()),
        ];

        /// cari user berdasarkan email, apakah sudah pernah mendaftar sebelumnya
        $user = User::whereEmail($data['email'])->first();

        /// jika belum, maka kirimkan email register success
        if (!$user) {
            $user = User::create($data);

            Mail::to($user->email)->send(new RegisterSuccess($user));
        }

        Auth::login($user, true);

        return redirect()->route('home');
    }

    /**
     * Destroy an authenticated session for user and admin.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

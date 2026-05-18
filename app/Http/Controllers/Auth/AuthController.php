<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

final class AuthController extends Controller
{
    public function __construct(private readonly UserService $userService)
    {
    }

    /**
     * Show login form
     */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * Handle login
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $user = $this->userService->authenticate(
            $request->validated('email'),
            $request->validated('password')
        );

        if (! $user) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Invalid credentials'])
                ->withInput($request->only('email'));
        }

        Auth::login($user, $request->boolean('remember'));

        return redirect()->intended('/dashboard');
    }

    /**
     * Show registration form
     */
    public function showRegisterForm(): View
    {
        return view('auth.register');
    }

    /**
     * Handle registration
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $user = $this->userService->register(
            $request->validated('email'),
            $request->validated('password')
        );

        Auth::login($user);

        return redirect('/dashboard');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

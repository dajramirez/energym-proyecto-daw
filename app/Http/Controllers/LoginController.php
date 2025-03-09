<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginType => $request->login,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            return response()->json([
                'redirect' => $this.getDashboardRoute($user->role),
                'user' => $user,
            ]);
        }

        return response()->json([
            'error' => 'Invalid credentials',
        ], 401);
    }

    private function getDashboardRoute($role)
    {
        return match($role) {
            'admin' => '/admin/dashboard',
            'trainer' => '/trainer/dashboard',
            'clerk' => '/clerk/dashboard',
            'user' => '/user/dashboard',
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\LoginInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('logged_in')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'userName' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $user = LoginInfo::where('userName', $data['userName'])->first();

        if ($user && (Hash::check($data['password'], $user->password) || hash_equals($user->password, $data['password']))) {
            $request->session()->regenerate();
            $request->session()->put(['logged_in' => true, 'username' => $user->userName]);
            return redirect()->route('dashboard')->with('success', 'Login successful.');
        }

        return back()->withErrors(['userName' => 'Invalid username or password.'])->onlyInput('userName');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}

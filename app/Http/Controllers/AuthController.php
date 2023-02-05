<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\confirmPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('pages.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credential = [
            'email' => $request->all()['email'],
            'password' => $request->all()['password'],
        ];

        if (Auth::attempt($credential)) {
            toast('you logged in!', 'success')->timerProgressBar();
            return redirect()->route('home');
        }

        toast('Invalid data!', 'error')->timerProgressBar();
        return redirect()->back();
    }

    public function registerPage()
    {
        return view('pages.auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $inputs = $request->all();
        $inputs['password'] = Hash::make($inputs['password']);
        $user = User::create($inputs);
        Auth::login($user, true);

        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();
        toast('you logged out!', 'success')->timerProgressBar();

        return redirect()->route('login');
    }

    public function confirmPassword(confirmPasswordRequest $request)
    {
        $credential = [
            'email' => $request->all()['email'],
            'password' => $request->all()['password'],
        ];

        if (Auth::attempt($credential)) {
            return response()->json(['status' => 'ok', 'message' => 'Password Confirmed.']);
        }
        return response()->json(['status' => 'failed', 'message' => 'Invalid Password']);
    }
}

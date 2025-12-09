<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request)
    {
        $request->validated($request->all());

        $initUser = User::where('email', $request->email)
            ->orWhere('username', $request->email)
            ->first();

        if (!$initUser || !Auth::attempt([
            'email' => $initUser->email,
            'password' => $request->password
        ])) {
            return $this->error('Credentials do not match', 401, []);
        }


        return $this->success([
            'email' => $initUser->email,
            'username' => $initUser->username,
            'verified' => $initUser->email_verified_at,
            'token' => $initUser->createToken('API Token User ' . $initUser->username)->plainTextToken,
        ], "User logged in successfully");
    }

    public function register(StoreUserRequest $request)
    {
        $request->validated($request->all());

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token User ' . $user->username)->plainTextToken,
        ], "User created successfully");
    }

    public function logout(Request $request)
    {
        //
    }
}

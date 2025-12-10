<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Models\UserInfo;
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

        $userInfo = UserInfo::where('user_id', $initUser->id)->first();


        return $this->success([
            'email' => $initUser->email,
            'username' => $initUser->username,
            'verified' => $initUser->email_verified_at,
            'storyProgressId' => $userInfo ? $userInfo->story_progress_id : null,
            'token' => $initUser->createToken($initUser->email)->plainTextToken,
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

        $userInfo = UserInfo::create([
            'user_id' => $user->id,
            'story_progress_id' => 1, // Initial story progress
        ]);

        return $this->success([
            'email' => $user->email,
            'username' => $user->username,
            'verified' => $user->email_verified_at,
            'story_progress_id' => $userInfo ? $userInfo->story_progress_id : null,
            'token' => $user->createToken($user->email)->plainTextToken,
        ], "User created successfully");
    }

    public function logout(Request $request)
    {
        //
    }
}

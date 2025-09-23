<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthControlller extends Controller
{
    public function register(RegisterRequest $request){

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = auth('user')->login($user);
        $user->token = $token;

        return api_success( new UserResource($user) , 'register successfully');


    }


    public function login(LoginRequest $request){

        $credentials = $request->only(['email', 'password']);
        if(! $token = auth('user')->attempt($credentials)){
            return api_error('email or password incorrect');
        }

        $user = auth('user')->user();
        $user->token = $token ;

        return api_success(new UserResource($user), 'register successfully');

    }

    public function logout()
{
    auth('user')->logout();

    return api_success(null, 'Logout successfully');
}
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login(LoginRequest $request){

        $credentials = $request->only(['email', 'password']);
        if(! $token = auth('admin')->attempt($credentials)){
            return api_error('email or password incorrect');
        }

        $admin = auth('admin')->user();
        $admin->token = $token ;

        return api_success($admin , 'register successfully');

    }
}

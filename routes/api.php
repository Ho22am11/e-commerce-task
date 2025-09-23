<?php

use App\Http\Controllers\User\AuthControlller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register' , [AuthControlller::class , 'register']);
Route::post('login', [AuthControlller::class , 'login']);
Route::post('logout', [AuthControlller::class , 'logout']);







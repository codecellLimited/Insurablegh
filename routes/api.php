<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomePageController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




//public Route

Route:: post('/login', [AuthController::class,'login']);
Route:: post('/register', [AuthController::class,'register']);
Route::post('/check-otp', [AuthController::class, 'checkOtp']);
Route::post('/resetPassword', [AuthController::class, 'resetPassword']);
Route::post('/forgetPassword', [AuthController::class, 'forgetPassword']);

//protected Route

Route::group(['middleware' => ['auth:sanctum']], function (){
    Route:: resource('/tasks', TaskController::class);  
    Route:: post('/logout',[AuthController::class,'logout']);
    Route:: get('/profile',[ProfileController::class,'profile']);
    Route:: post('/EditProfile',[ProfileController::class,'EditProfile']);
    Route:: post('/ChangePassword',[ProfileController::class,'ChangePassword']);


    //
    Route:: get('/homepage',[HomePageController::class,'homepage']);
});
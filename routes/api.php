<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post("/auth/login",[AuthController::class,"Login"]);

Route::post("/auth/register",[AuthController::class,"Register"]);


Route::group(["middleware"=>"auth:sanctum"],function(){
    Route::post("/auth/logout",[AuthController::class,"Logout"]);


});
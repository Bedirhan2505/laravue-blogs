<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoriesController;
use App\Http\Controllers\API\BlogsController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function(){
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('resetpassword', 'resetpassword');
    Route::post('respasstwostep', 'respasstwostep');
});

Route::controller(CategoriesController::class)->group(function(){

    Route::post('listencategory','listencategory');
});

Route::controller(BlogsController::class)->group(function(){

    Route::post('addblog','addblog');
    Route::post('blogslist','blogslist');
    Route::post('blogsdetails','blogsdetails');
    Route::post('blogdelete','blogdelete');
});
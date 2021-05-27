<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// use App\Http\Controllers\AuthController;

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
Route::group(['prefix' => 'auth'], function ($router) { 
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/userprofile', [AuthController::class, 'userProfile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/update-profile',  [AuthController::class, 'updateProfile']);
});

// Route::group(['middleware' => 'auth.jwt'], function () {
//     Route::post('logout', [AuthController::class, 'logout']);
// });


// Route::group(['middleware' => 'auth.jwt'], function () {
 
   
  
// });

// Route::post('me', [AuthController::class, 'me']);
// Route::prefix('jwt.auth')->group(function () {
//     Route::post('register', 'App\Http\Controllers\AuthController@register');
//     Route::post('login', 'App\Http\Controllers\AuthController@login');
// });

// Route::group(['middleware' => [ 'jwt', 'jwt.auth']], function () {
//     Route::post('register', [AuthController::class, 'register']);
//     Route::post('login', [AuthController::class, 'login']);

// });

// Route::group(['prefix' => 'auth'], function ($router) {
//     Route::post('register', [AuthController::class, 'register']);
//     Route::post('login', [AuthController::class, 'login']);
//  });

// Route::post('register', [AuthController::class, 'register']);

//basic route
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


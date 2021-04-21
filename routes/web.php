<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;


Auth::routes();

Route::get('/', function () {return view('welcome');});

// Route::get('/dashboard', [DashboardController::class, 'getDashboard'])->name('dashboard');
// Route::group(['prefix' => 'auth'], function () {

    
// });

// Route::get('{any}', function () {
//     return view('index');
// })->where('any', '.*');



Route::put('/update-profile',  [AuthController::class, 'updateProfile']);



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('{slug}',function(){
//     return view('welcome');
// });

// Route::group(['middleware' => 'https'], function() { 
//     Route::group(['middleware' => 'set.db.connection'], function() {
//         Route::group(['middleware' => 'auth'], function () {
//             Route::put('/update-profile',  [AuthController::class, 'updateProfile']);
//         });
//     });
// });
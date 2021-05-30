<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



// Auth::routes();

Route::get('/', function () {return view('welcome');});



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::group(['middleware' => 'https'], function() { 
//     Route::group(['middleware' => 'set.db.connection'], function() {
//         Route::group(['middleware' => 'auth'], function () {
//             Route::put('/update-profile',  [AuthController::class, 'updateProfile']);
//         });
//     });
// });
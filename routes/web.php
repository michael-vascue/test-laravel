<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IllustrationGalleryController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MyIllustrationController;


Auth::routes();

Route::get('/', function () {return view('welcome');});
Route::post('/new-illustration',  [MyIllustrationController::class, 'saveIllus']);
Route::get('/illustration', [IllustrationGalleryController::class, 'getIllustrationGallery']);



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::group(['middleware' => 'https'], function() { 
//     Route::group(['middleware' => 'set.db.connection'], function() {
//         Route::group(['middleware' => 'auth'], function () {
//             Route::put('/update-profile',  [AuthController::class, 'updateProfile']);
//         });
//     });
// });
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {return view('welcome');});

Route::get('/dashboard', [DashboardController::class, 'getDashboard'])->name('dashboard');



// Route::get('/signup', function () {return view('register');});
// Route::get('/new', [DashboardController::class, 'getNew'])->name('new');

// Route::get('/dashboard/{vue_capture?}', function () {
//     return view('index');
//    })->where('vue_capture', '[\/\w\.-]*');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('{slug}',function(){
//     return view('welcome');
// });

// Route::group(['middleware' => 'https'], function() {
    
//     Route::get('/dashboard', 'App\Http\Controllers\DashboardController@getDashboard');
// });
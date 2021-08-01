<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'namespace' => 'App\Http\Controllers',
    // 'middleware' => [
    //     'auth',
    //     'checkRole:user'
    //     ]
    ], function () {
    Route::resource('pets', 'PetController')->names('pet')->parameters([
        'pets' => 'pet'
        ]);
});

Route::group([
    'prefix' => 'admin',
    // 'middleware' => [
    //     'auth',
    //     'checkRole:admin'
    //     ]
    ], function () {
        Route::resource('user', UserController::class)->names('user')->parameters([
            'users' => 'user'
        ]);
    // Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');
});
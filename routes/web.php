<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PetController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () { // Redirect admin/users to admin/users
    return redirect()->route('users.index');
});

Route::group([
    // 'middleware' => [
    //     'auth',
    //     'checkRole:user'
    //     ]
], function () {
    Route::resource('pet', PetController::class)->names('pet')->parameters([
        'pets' => 'pet'
    ])->except([
        'index',
    ]);
    Route::get('/pet', function () { // Redirect /pet to /pets
        return redirect()->route('pets.index');
    });
    Route::get('/pets', [PetController::class, 'index'])->name('pets.index');
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
    ])->except([
        'index',
    ]);
    Route::get('/user', function () { // Redirect admin/users to admin/users
        return redirect()->route('users.index');
    });
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});

    // Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');

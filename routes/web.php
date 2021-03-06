<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\AuthController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () { // Redirect admin/users to admin/users
    return redirect()->route('pets.index');
})->name('home');

Route::get('/pet', function () { // Redirect /pet to /pets
    return redirect()->route('pets.index');
});
Route::get('/pets', [PetController::class, 'index'])->name('pets.index'); // main page

Route::group([
    'middleware' => [
        'guest',
    ]
], function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login/do', [AuthController::class, 'login'])->name('login.do');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register/do', [AuthController::class, 'register'])->name('register.do');
});

Route::group([
    'middleware' => [
        'auth',
    ]
], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group([
    'middleware' => [
        'auth',
        'checkRole:user'
    ]
], function () {
    Route::resource('pet', PetController::class)->names('pet')->parameters([
        'pets' => 'pet'
    ])->except([
        'index',
    ]);
    

    Route::post('/add-pet/do', [PetController::class, 'store'])->name('pet.do');
});

Route::group([
    'middleware' => [
        'auth',
        'checkRole:user'
    ]
], function () {
    Route::resource('user', UserController::class)->names('user')->parameters([
        'users' => 'user'
    ])->except([
        'index',
    ]);
    Route::get('/profile', function () { // Redirect admin/users to admin/users
        return redirect()->route('user.show', ['user' => Auth::user()->id]);
    })->name('profile');
});

Route::group([
    'prefix' => 'admin',
    'middleware' => [
        'auth',
        'checkRole:admin'
    ]
], function () {
    Route::get('/user', function () { // Redirect admin/users to admin/users
        return redirect()->route('users.index');
    });
    Route::get('/users', [AuthController::class, 'index'])->name('users.index');
});

Route::view('/crop', 'crop-avatar')->name('sexo');
// Route::POST('/crop_avatar', [AuthController::class, 'crop_avatar'])->name('imageupload');
Route::POST('/crop_avatar', [UserController::class, 'upload_profile_picture'])->name('imageupload');
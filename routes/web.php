<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;

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

// all user routes...........
Route::controller(UserController::class)->prefix('user')->group(function (){
    Route::get('logout','logOut')->name('user.logout');
    Route::get('profile','userProfile')->name('user.profile');
    Route::get('profile/edit','userProfileEdit')->name('user_profile_edit');
    Route::post('profile/update','userProfileUpdate')->name('update_user_profile');
});


//all admin routes........
Route::controller(AdminController::class)
    ->prefix('admin')->middleware('admin:admin')
    ->group(function (){
   Route::get('login','adminLogin');
   Route::post('login','store')->name('admin.login');

});

Route::middleware([
    'auth:sanctum,admin',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('admin/dashboard', function () {
        return view('admin.admin_home');
    })->name('dashboard');
});

Route::middleware([
    'auth:sanctum,web',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.home');
    })->name('dashboard');
});
Route::get('admin/logout',[AdminController::class,'destroy'])->name('admin.logout');

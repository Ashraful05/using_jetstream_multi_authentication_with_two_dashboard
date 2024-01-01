<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MainAdminController;
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
    Route::get('profile','userProfile')->name('user.profile')->middleware('auth:sanctum,web');
    Route::get('profile/edit','userProfileEdit')->name('user_profile_edit')->middleware('auth:sanctum,web');
    Route::post('profile/update','userProfileUpdate')->name('update_user_profile')->middleware('auth:sanctum,web');
    Route::get('password/change','userPasswordChange')->name('user.password.change')->middleware('auth:sanctum,web');
    Route::post('password/update','userPasswordUpdate')->name('update_user_password');
});


//all admin routes........
Route::controller(AdminController::class)
    ->prefix('admin')->group(function (){
   Route::get('login','adminLogin');
   Route::post('login','store')->name('admin.login');

});
Route::controller(MainAdminController::class)->prefix('admin')
    ->group(function (){
       Route::get('profile','viewProfile')->name('view_profile')->middleware('auth:sanctum,admin');
       Route::get('profile/edit','editProfile')->name('admin_profile_edit')->middleware('auth:sanctum,admin');
       Route::post('profile/update','updateAdminProfile')->name('update_admin_profile');
       Route::get('password/change','passwordChange')->name('admin_password_change')->middleware('auth:sanctum,admin');
       Route::post('password/update','updatePassword')->name('update_admin_password');
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

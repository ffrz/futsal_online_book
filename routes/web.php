<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FieldController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserGroupController;
use App\Http\Controllers\Public\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $user = Auth::user();
    if (!$user)
        return redirect(route('login'));
    if ($user->group_id == 1 || $user->group_id == 2)
        return redirect(route('admin.dashboard'));
    return view('public.home');
})->name('home');

Route::middleware(['guest'])->controller(AuthController::class)->prefix('auth')->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('process-login', 'processLogin')->name('process-login');

    Route::get('register', 'register')->name('register');
    Route::post('process-registration', 'processRegistration')->name('process-registration');
    Route::get('registration-success', 'registrationSuccess')->name('registration-success');

    Route::get('forgot-password', 'forgotPassword')->name('forgot-password');
    Route::post('recover-password', 'recoverPassword')->name('recover-password');
    Route::get('reset-password-request-sent', 'resetPasswordRequestSent')->name('password.reset');
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('ajax/users', [UserController::class, 'userlist'])->name('ajax.users');

    Route::controller(DashboardController::class)->prefix('dashboard')->group(function () {
        Route::get('', 'index')->name('admin.dashboard');
    });

    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::get('', 'index')->name('admin.users.index');
        Route::get('add', 'add')->name('admin.users.add');
        Route::get('edit/{id}', 'edit')->name('admin.users.edit');
        Route::post('save', 'save')->name('admin.users.save');
    });
    Route::controller(UserGroupController::class)->prefix('user-groups')->group(function () {
        Route::get('', 'index')->name('admin.user-groups.index');
        Route::get('edit/{id}', 'edit')->name('admin.user-groups.edit');
        Route::post('save', 'save')->name('admin.user-groups.save');
    });
    Route::controller(FieldController::class)->prefix('fields')->group(function () {
        Route::get('', 'index')->name('admin.fields.index');
        Route::get('add', 'add')->name('admin.fields.add');
        Route::get('edit/{id}', 'edit')->name('admin.fields.edit');
        Route::post('save', 'save')->name('admin.fields.save');
    });
});

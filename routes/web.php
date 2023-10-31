<?php

use App\Http\Controllers\Admin\DashboardController;
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
    if (!$user) {
        return redirect(route('login'));
    }

    if ($user->group_id == 1 || $user->group_id == 2) {
        return redirect(route('admin.dashboard'));
    }
    return view('welcome');
})->name('home');

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('process-login', 'processLogin')->name('process-login');
    
    Route::get('register', 'register')->name('register');
    Route::post('process-registration', 'processRegistration')->name('process-registration');
    Route::get('registration-success', 'registrationSuccess')->name('registration-success');

    Route::get('forgot-password', 'forgotPassword')->name('forgot-password');
    Route::post('recover-password', 'recoverPassword')->name('recover-password');    
    Route::get('reset-password-request-sent', 'resetPasswordRequestSent')->name('password.reset');

    Route::get('logout', 'logout')->name('logout');
});

Route::prefix('admin')->group(function(){
    Route::controller(DashboardController::class)->prefix('dashboard')->group(function() {
        Route::get('', 'index')->name('admin.dashboard');
    });
});
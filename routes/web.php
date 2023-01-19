<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

/*
Route::get('/', function () {
    return 'ello';
});
*/

//Route::get('/', 'HomeController@index')->name('index');

Route::get('/login', [HomeController::class, 'login_page'])->name('login_page');
Route::get('/registration', [HomeController::class, 'registration_page'])->name('registration_page');
Route::post('/register', [HomeController::class, 'register'])->name('register');
Route::post('/signin', [HomeController::class, 'login'])->name('login');


Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');



Route::post('payment', [DashboardController::class, 'payment'])->name('payment');
Route::get('cancel', [DashboardController::class, 'cancel'])->name('payment.cancel');
Route::get('payment/success', [DashboardController::class, 'success'])->name('payment.success');

Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');

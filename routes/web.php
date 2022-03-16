<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\DashboardController;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/', [DashboardController::class, 'index'])->name('user.frontend');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

// Route::get('migrate', function () {
//     Artisan::call('migrate');
// });
// Route::get('migrate-fresh', function () {
//     Artisan::call('migrate:fresh');
// });
// Route::get('seed', function () {
//     Artisan::call('db:seed');
// });

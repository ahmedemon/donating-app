<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\DonationController;
use App\Http\Controllers\User\SponsoredShopController;
/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| Here is where you can register user routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "user" middleware group. Now create something great!
|
*/

Route::group(['prefix'=>'user','middleware' => 'auth'], function () {
	Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');
	Route::resource('donations', DonationController::class);
	Route::get('donations/activate/{id}', [DonationController::class, 'active'])->name('donations.active');
	Route::get('donations/deactivate/{id}', [DonationController::class, 'deactive'])->name('donations.deactive');

	Route::group(['prefix'=>'sponsored-shop', 'as'=>'sponsored-shop.'], function(){
		Route::get('/', [SponsoredShopController::class, 'index'])->name('index');
	});
});
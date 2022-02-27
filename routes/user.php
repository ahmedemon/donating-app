<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\DonationController;
use App\Http\Controllers\User\PurchaseController;
use App\Http\Controllers\User\SponsoredShopController;
use App\Http\Controllers\User\ShelfController;
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
	Route::group(['prefix'=>'donations', 'as'=>'donation.'], function(){
		Route::resource('/', DonationController::class);
		Route::get('pending', [DonationController::class, 'pending'])->name('pending');
		Route::get('approved', [DonationController::class, 'approved'])->name('approved');
		Route::get('rejected', [DonationController::class, 'rejected'])->name('rejected');
		Route::get('pause/{id}', [DonationController::class, 'pause'])->name('pause');
		Route::get('relese/{id}', [DonationController::class, 'relese'])->name('relese');
	});

	Route::group(['prefix'=>'my-order', 'as'=>'my-order.'], function(){
		Route::get('{id}/buy', [PurchaseController::class, 'purchaseRequest'])->name('buy.request');
		Route::get('pending', [PurchaseController::class, 'pending'])->name('pending.request');
		Route::get('approved', [PurchaseController::class, 'approved'])->name('approved.request');
		Route::get('rejected', [PurchaseController::class, 'rejected'])->name('rejected.request');
	});

	Route::group(['prefix'=>'sponsored-shop', 'as'=>'sponsored-shop.'], function(){
		Route::get('/', [SponsoredShopController::class, 'index'])->name('index');
	});

	Route::group(['prefix'=>'category', 'as'=>'category.'], function(){
		Route::get('/{id}', [ShelfController::class, 'index'])->name('index');
	});
});

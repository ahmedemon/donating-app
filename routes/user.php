<?php

use App\Http\Controllers\User\BuyerRequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\DonationController;
use App\Http\Controllers\User\ProfileController;
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

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');

    Route::prefix('profile')->as('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('edit/{id}', [ProfileController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [ProfileController::class, 'update'])->name('update');
        Route::put('image/{id}', [ProfileController::class, 'image'])->name('image');
    });

    Route::group(['prefix' => 'donations', 'as' => 'donation.'], function () {
        Route::get('/', [DonationController::class, 'index'])->name('index');
        Route::get('create', [DonationController::class, 'create'])->name('create');
        Route::post('store', [DonationController::class, 'store'])->name('store');
        Route::put('update/{id}', [DonationController::class, 'update'])->name('update');
        Route::get('pending', [DonationController::class, 'pending'])->name('pending');
        Route::get('approved', [DonationController::class, 'approved'])->name('approved');
        Route::get('rejected', [DonationController::class, 'rejected'])->name('rejected');
        Route::get('pause/{id}', [DonationController::class, 'pause'])->name('pause');
        Route::get('relese/{id}', [DonationController::class, 'relese'])->name('relese');
        Route::get('edit/{id}', [DonationController::class, 'edit'])->name('edit');
        Route::delete('destroy/{id}', [DonationController::class, 'destroy'])->name('destroy');
    });
    Route::group(['prefix' => 'my-order', 'as' => 'my-order.'], function () {
        Route::get('{id}/buy', [PurchaseController::class, 'purchaseRequest'])->name('buy.request');
        Route::get('pending', [PurchaseController::class, 'pending'])->name('pending.request');
        Route::get('approved', [PurchaseController::class, 'approved'])->name('approved.request');
        Route::get('rejected', [PurchaseController::class, 'rejected'])->name('rejected.request');
        Route::delete('cancel/{id}', [PurchaseController::class, 'cancel'])->name('cancel.request');
    });

    Route::group(['prefix' => 'buyer-request', 'as' => 'buyer-request.'], function () {
        Route::get('pending', [BuyerRequestController::class, 'pending'])->name('pending.request');
        Route::get('completed', [BuyerRequestController::class, 'completed'])->name('completed.request');
        Route::get('rejected', [BuyerRequestController::class, 'rejected'])->name('rejected.request');
        Route::get('approve/{id}', [BuyerRequestController::class, 'approve'])->name('approve.request');
        Route::get('reject/{id}', [BuyerRequestController::class, 'reject'])->name('reject.request');
        Route::get('recall/{id}', [BuyerRequestController::class, 'recall'])->name('recall.request');
    });

    Route::group(['prefix' => 'sponsored-shop', 'as' => 'sponsored-shop.'], function () {
        Route::get('/', [SponsoredShopController::class, 'index'])->name('index');
    });

    Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        Route::get('/categories', [ShelfController::class, 'categories'])->name('categories');
        Route::get('/{id}', [ShelfController::class, 'index'])->name('index');
    });
});

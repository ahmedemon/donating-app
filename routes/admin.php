<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\SponsorItemController;
use App\Http\Controllers\Admin\DonationRequestController;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/
Route::get('login', [LoginController::class, 'viewLogin'])->name('login.index');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'admin'], function () {
	Route::get('/', [AdminController::class, 'index'])->name('index');
	Route::group(['prefix'=>'category', 'as'=>'category.'], function(){
		Route::get('/', [CategoryController::class, 'index'])->name('index');
		Route::get('/create', [CategoryController::class, 'create'])->name('create');
		Route::post('store', [CategoryController::class, 'store'])->name('store');
		Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
		Route::put('update/{id}', [CategoryController::class, 'update'])->name('update');
		Route::get('active/{id}', [CategoryController::class, 'active'])->name('active');
		Route::get('deactive/{id}', [CategoryController::class, 'deactive'])->name('deactive');
		Route::delete('destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy');
	});
	Route::group(['prefix'=>'sponsor', 'as'=>'sponsor.'], function(){
		Route::get('/', [SponsorController::class, 'index'])->name('index');
		Route::get('/create', [SponsorController::class, 'create'])->name('create');
		Route::post('store', [SponsorController::class, 'store'])->name('store');
		Route::get('edit/{id}', [SponsorController::class, 'edit'])->name('edit');
		Route::put('update/{id}', [SponsorController::class, 'update'])->name('update');
		Route::get('active/{id}', [SponsorController::class, 'active'])->name('active');
		Route::get('deactive/{id}', [SponsorController::class, 'deactive'])->name('deactive');
		Route::delete('destroy/{id}', [SponsorController::class, 'destroy'])->name('destroy');
	});
	Route::group(['prefix'=>'sponsor-item', 'as'=>'sponsor-item.'], function(){
		Route::get('/', [SponsorItemController::class, 'index'])->name('index');
		Route::get('paused/item', [SponsorItemController::class, 'paused'])->name('paused');
		Route::get('create', [SponsorItemController::class, 'create'])->name('create');
		Route::post('store', [SponsorItemController::class, 'store'])->name('store');
		Route::get('edit/{id}', [SponsorItemController::class, 'edit'])->name('edit');
		Route::put('update/{id}', [SponsorItemController::class, 'update'])->name('update');
		Route::get('active/{id}', [SponsorItemController::class, 'active'])->name('active');
		Route::get('deactive/{id}', [SponsorItemController::class, 'deactive'])->name('deactive');
		Route::delete('destroy/{id}', [SponsorItemController::class, 'destroy'])->name('destroy');
	});
	Route::group(['prefix'=>'donation-request', 'as'=>'donation.requests.'], function(){
		Route::get('pending/items', [DonationRequestController::class, 'pending'])->name('pending');
		Route::get('approved/items', [DonationRequestController::class, 'approved'])->name('approved');
		Route::get('rejected/items', [DonationRequestController::class, 'rejected'])->name('rejected');
		Route::get('edit/{id}', [DonationRequestController::class, 'edit'])->name('edit');
		Route::put('update/{id}', [DonationRequestController::class, 'update'])->name('update');

		Route::get('{id}/approve', [DonationRequestController::class, 'approve'])->name('approve');
		Route::get('{id}/reject', [DonationRequestController::class, 'reject'])->name('reject');
		Route::get('{id}/recall', [DonationRequestController::class, 'recall'])->name('recall');

		Route::delete('destroy/{id}', [DonationRequestController::class, 'destroy'])->name('destroy');
	});
});
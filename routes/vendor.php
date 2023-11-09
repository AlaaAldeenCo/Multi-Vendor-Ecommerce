<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProductImageGalleryController;
use App\Http\Controllers\Backend\VendorProductVariantController;

/* Vendor Route  */
Route::get('dashboard',[VendorController::class,'dashboard'])->name('dashboard');
Route::get('profile',[VendorProfileController::class, 'index'])->name('profile');
Route::put('profile',[VendorProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile',[VendorProfileController::class, 'updatePassword'])->name('profile.update.password');
/* Vendor shop profile  */
Route::resource('shop-profile', VendorShopProfileController::class);

/* Product Route */
Route::put('product/change-status', [VendorProductController::class, 'changeStatus'])->name('product.change-status');
Route::get('product/get-subcategories',[VendorProductController::class, 'getSubCategories'])->name('product.get-subcategories');
Route::get('product/get-child-categories',[VendorProductController::class, 'getChildCategories'])->name('product.get-child-categories');
Route::resource('products',VendorProductController::class);

/* Product Image Gallary Route */
Route::resource('products-image-gallery', VendorProductImageGalleryController::class);

/** Products variant route */
Route::put('products-variant/change-status', [VendorProductVariantController::class, 'changeStatus'])->name('products-variant.change-status');
Route::resource('products-variant', VendorProductVariantController::class);


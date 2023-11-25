<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\SellerProductController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ShippingRuleController;
use App\Http\Controllers\Backend\PaymentSettingController;
use App\Http\Controllers\Backend\PaypalSettingController;
use App\Http\Controllers\Backend\RazorpaySettingController;
use App\Http\Controllers\Backend\OrderController;

/* Admin Route  */
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

/*     Profile Routes     */

Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile/update/password', [ProfileController::class, 'updatePassword'])->name('password.update');

/* Slider Routes */
Route::resource('slider', SliderController::class);

/* Category Route */
Route::put('change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);

/* SubCategory Route */
Route::put('subcategory/change-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
Route::resource('sub-category', SubCategoryController::class);
/* ChildCategory Route */
Route::put('child-category/change-status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
Route::get('get-subcategories', [ChildCategoryController::class, 'getSubCategories'])->name('get-subcategories');
Route::resource('child-category', ChildCategoryController::class);
/* Brand Route */
Route::put('brand/change-status', [BrandController::class, 'changeStatus'])->name('brand.change-status');
Route::resource('brand', BrandController::class);
/* Vendor Profile Route */
Route::resource('vendor-profile', AdminVendorProfileController::class);
/* Product Route */
Route::get('product/get-subcategories', [ProductController::class, 'getSubCategories'])->name('product.get-subcategories');
Route::get('product/get-child-categories', [ProductController::class, 'getChildCategories'])->name('product.get-child-categories');
Route::put('product/change-status', [ProductController::class, 'changeStatus'])->name('product.change-status');
Route::resource('products', ProductController::class);
/* Product Image Gallary Route */
Route::resource('products-image-gallery', ProductImageGalleryController::class);
/* Product Variant Route */
Route::put('products-variant/change-status', [ProductVariantController::class, 'changeStatus'])->name('products-variant.change-status');
Route::resource('products-variant', ProductVariantController::class);
/** Products variant item route */
Route::get('products-variant-item/{productId}/{variantId}', [ProductVariantItemController::class, 'index'])->name('products-variant-item.index');
Route::get('products-variant-item/create/{productId}/{variantId}', [ProductVariantItemController::class, 'create'])->name('products-variant-item.create');
Route::post('products-variant-item', [ProductVariantItemController::class, 'store'])->name('products-variant-item.store');
Route::get('products-variant-item-edit/{variantItemId}', [ProductVariantItemController::class, 'edit'])->name('products-variant-item.edit');
Route::put('products-variant-item-update/{variantItemId}', [ProductVariantItemController::class, 'update'])->name('products-variant-item.update');
Route::delete('products-variant-item/{variantItemId}', [ProductVariantItemController::class, 'destroy'])->name('products-variant-item.destroy');
Route::put('products-variant-item-status', [ProductVariantItemController::class, 'chageStatus'])->name('products-variant-item.chages-status');
/* Products Sellers Route */
Route::get('seller-products',[SellerProductController::class,'index'])->name('seller-products.index');
Route::get('seller-pending-products',[SellerProductController::class,'pendingProducts'])->name('seller-pending-products.index');
Route::put("change-approve-status",[SellerProductController::class,'changeApproveStatus'])->name('change-approve-status');
/* Flash Sale Routes */
Route::get('flash-sale',[FlashSaleController::class, 'index'])->name('flash-sale.index');
Route::put('flash-sale',[FlashSaleController::class, 'update'])->name('flash-sale.update');
Route::post('flash-sale/add-product',[FlashSaleController::class, 'addProduct'])->name('flash-sale.add-product');
Route::put('flash-sale/show-at-home/status-change', [FlashSaleController::class, 'chageShowAtHomeStatus'])->name('flash-sale.show-at-home.change-status');
Route::put('flash-sale-status',[FlashSaleController::class, 'changeStatus'])->name('flash-sale-status');
Route::delete('flash-sale/{id}', [FlashSaleController::class, 'destroy'])->name('flash-sale.destroy');
/* Coupn Routes */
Route::put('coupons/change-status',[CouponController::class, 'changeStatus'])->name('coupons.change-status');
Route::resource('coupons', CouponController::class);
/* Shipping Rule Routes */
Route::put('shipping-rule/change-status',[ShippingRuleController::class, 'changeStatus'])->name('shipping-rule.change-status');
Route::resource('shipping-rule', ShippingRuleController::class);
/* General Setting Route */
Route::get('settings',[SettingController::class,'index'])->name('settings.index');
Route::put('general-setting-update', [SettingController::class, 'generalSettingUpdate'])->name('general-setting-update');
/* Payment Routes */
Route::get('payment-settings', [PaymentSettingController::class, 'index'])->name('payment-settings.index');
Route::resource('paypal-setting', PaypalSettingController::class);
Route::put('razorpay-setting/{id}', [RazorpaySettingController::class, 'update'])->name('razorpay-setting.update');
/* Order Routes */
Route::get('payment-status', [OrderController::class, 'changePaymentStatus'])->name('payment.status');
Route::get('order-status', [OrderController::class, 'changeOrderStatus'])->name('order.status');
Route::get('pending-orders', [OrderController::class, 'pendingOrders'])->name('pending-orders');
Route::get('processed-orders', [OrderController::class, 'processedOrders'])->name('processed-orders');
Route::get('dropped-off-orders', [OrderController::class, 'droppedOfOrders'])->name('dropped-off-orders');
Route::get('shipped-orders', [OrderController::class, 'shippedOrders'])->name('shipped-orders');
Route::get('out-for-delivery-orders', [OrderController::class, 'outForDeliveryOrders'])->name('out-for-delivery-orders');
Route::get('delivered-orders', [OrderController::class, 'deliveredOrders'])->name('delivered-orders');
Route::get('canceled-orders', [OrderController::class, 'canceledOrders'])->name('canceled-orders');
Route::resource('order', OrderController::class);



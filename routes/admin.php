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
use App\Http\Controllers\Backend\AdvertisementController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\SellerProductController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\FooterGridThreeController;
use App\Http\Controllers\Backend\FooterGridTwoController;
use App\Http\Controllers\Backend\FooterInfoController;
use App\Http\Controllers\Backend\FooterSocialController;
use App\Http\Controllers\Backend\ShippingRuleController;
use App\Http\Controllers\Backend\PaymentSettingController;
use App\Http\Controllers\Backend\PaypalSettingController;
use App\Http\Controllers\Backend\RazorpaySettingController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\TransactionController;
use App\Http\Controllers\Backend\HomePageSettingController;
use App\Http\Controllers\Backend\SubscribersController;

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
Route::put('email-setting-update', [SettingController::class, 'emailConfigSettingUpdate'])->name('email-setting-update');
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
/* Transaction Route */
Route::get('transaction', [TransactionController::class, 'index'])->name('transaction');
/* Home Page Settings */
Route::get('home-page-setting',[HomePageSettingController::class, 'index'])->name('home.page.setting');
Route::put('popular-category-section', [HomePageSettingController::class, 'updatePopularCategorySection'])->name('popular-category-section');
Route::put('product-slider-section-one', [HomePageSettingController::class, 'updateProductSliderSectionOne'])->name('product-slider-section-one');
Route::put('product-slider-section-two', [HomePageSettingController::class, 'updateProductSliderSectionTwo'])->name('product-slider-section-two');
Route::put('product-slider-section-three', [HomePageSettingController::class, 'updateProductSliderSectionThree'])->name('product-slider-section-three');
/* Footer Route */
Route::resource('footer-info', FooterInfoController::class);
Route::put('footer-socials/change-status', [FooterSocialController::class, 'changeStatus'])->name('footer-socials.change-status');
Route::resource('footer-socials', FooterSocialController::class);
/* Footer Grid Two Routes */
Route::put('footer-grid-two/change-status', [FooterGridTwoController::class, 'changeStatus'])->name('footer-grid-two.change-status');
Route::put('footer-grid-two/change-title', [FooterGridTwoController::class, 'changeTitle'])->name('footer-grid-two.change-title');
Route::resource('footer-grid-two', FooterGridTwoController::class);
/* Footer Grid Three Routes */
Route::put('footer-grid-three/change-status', [FooterGridThreeController::class, 'changeStatus'])->name('footer-grid-three.change-status');
Route::put('footer-grid-three/change-title', [FooterGridThreeController::class, 'changeTitle'])->name('footer-grid-three.change-title');
Route::resource('footer-grid-three', FooterGridThreeController::class);
/* Subscribers Routes */
Route::get('subscribers', [SubscribersController::class, 'index'])->name('subscribers.index');
Route::delete('subscribers/{id}', [SubscribersController::class, 'destory'])->name('subscribers.destory');
Route::post('subscribers-send-mail',[SubscribersController::class, 'sendMail'])->name('subscribers-send-mail');
/* Advertisement Routes */
Route::get('advertisement', [AdvertisementController::class, 'index'])->name('advertisement.index');
Route::put('advertisement/homepage-banner-secion-one', [AdvertisementController::class, 'homepageBannerSecionOne'])->name('homepage-banner-secion-one');
Route::put('advertisement/homepage-banner-secion-two', [AdvertisementController::class, 'homepageBannerSecionTwo'])->name('homepage-banner-secion-two');
Route::put('advertisement/homepage-banner-secion-three', [AdvertisementController::class, 'homepageBannerSecionThree'])->name('homepage-banner-secion-three');
Route::put('advertisement/homepage-banner-secion-four', [AdvertisementController::class, 'homepageBannerSecionFour'])->name('homepage-banner-secion-four');



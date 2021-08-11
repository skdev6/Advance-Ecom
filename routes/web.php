<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\orderController;
use App\Http\Controllers\Admin\PermisionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ShippingArea;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubAdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\frontend\CardControler;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\WishlistController;
use App\Models\Permission;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [IndexController::class, 'index']);

Auth::routes();

Route::group(['as'=>'admin.', 'prefix'=>'admin', 'middleware'=>['admin', 'auth', 'permission']], function(){
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('profile', [AdminController::class, 'profile'])->name('profile');
    Route::get('image', [AdminController::class, 'image'])->name('image');
    Route::get('change-password', [AdminController::class, 'password'])->name('change.password');

    Route::post('profile', [AdminController::class, 'UpdateProfile'])->name('UpdateProfile');
    Route::post('image', [AdminController::class, 'UpdateImage'])->name('updateimage');
    Route::post('change-password', [AdminController::class, 'UpdatePassword'])->name('UpdatePassword'); 

    Route::get('brand', [BrandController::class, 'index'])->name('brand');
    Route::post('brand', [BrandController::class, 'store'])->name('brand.store');
    Route::get('brand-edite/{brand_id}', [BrandController::class, 'edite'])->name('brand.edite'); 
    Route::post('brand-update/{brand_id}', [BrandController::class, 'update'])->name('brand.update');
    Route::get('brand-delete/{brand_id}', [BrandController::class, 'delete'])->name('brand.delete');

    Route::get('category', [CategoryController::class, 'index'])->name('category');
    Route::post('category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category-edite/{id}', [CategoryController::class, 'edit'])->name('category.edite');
    Route::post('category-update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('category-delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

    Route::get('subcategory', [CategoryController::class, 'subcat_index'])->name('sub-category');
    Route::post('subcategory', [CategoryController::class, 'subcat_store'])->name('sub_category.store');
    Route::get('subcategory-edit/{id}', [CategoryController::class, 'subcat_edit'])->name('subcat.edit');
    Route::post('subcategory-update/{id}', [CategoryController::class, 'subcat_update'])->name('sub-category.update');
    Route::get('subcategory-delete/{id}', [CategoryController::class, 'subcat_delete'])->name('sub-category.delete');

    Route::get('sub-sub-category', [CategoryController::class, 'sub_sub_index'])->name('sub-sub-category');
    Route::get('get-sub-cat/{id}', [CategoryController::class, 'getSubCategory'])->name('get-sub-cat');
    Route::post('sub-sub-cat-store', [CategoryController::class, 'sub_subStore'])->name('sub-subcategory.store');
    Route::get('sub-subcategory-edit/{id}', [CategoryController::class, 'subsubcat_edit'])->name('sub-subcat.edit');
    Route::post('sub-subcategory-update/{id}', [CategoryController::class, 'subsubcat_update'])->name('sub-sub-category.update');
    Route::get('sub-subcategory-delete/{id}', [CategoryController::class, 'subsubcat_delete'])->name('sub-sub-category.delete');
    
    // PRODUCT
    Route::get('add-product', [ProductController::class, 'create'])->name('add-product');
    Route::post('store-product', [ProductController::class, 'store'])->name('product.store');
    Route::get('get-sub-sub-cat/{id}', [ProductController::class, 'get_subsubCate'])->name('get-sub-sub-cat');
    Route::get('product-list', [ProductController::class, 'index'])->name('product.index');
    Route::get('product-edite/{id}', [ProductController::class, 'edite'])->name('product.edite');
    Route::post('product-update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::post('product-single-photo-update/{id}', [ProductController::class, 'update_singlephoto'])->name('product.update.single-photo');
    Route::post('product-multi-photo-update/{id}', [ProductController::class, 'update_multiphoto'])->name('product.update.multi-photo');
    Route::post('product-add-new-photo/{id}', [ProductController::class, 'add_new_multiphoto'])->name('product.addnew.multi-photo');
    Route::post('product-delete-photo/{id}', [ProductController::class, 'delete_multiphoto'])->name('product.delete-photo');
    Route::get('product-delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
    Route::get('peoduct-active/{id}', [ProductController::class, 'product_active'])->name('product.active');
    Route::get('peoduct-inactive/{id}', [ProductController::class, 'product_inactive'])->name('product.inactive');

    // SLIDER
    Route::get('slider', [SliderController::class, 'index'])->name('slider');
    Route::post('slider-store', [SliderController::class, 'store'])->name('slide.store');
    Route::get('slider-edite/{id}', [SliderController::class, 'edit'])->name('slide.edit');
    Route::post('slider-update/{id}', [SliderController::class, 'update'])->name('slide.update');
    Route::get('slider-delete/{id}', [SliderController::class, 'destroy'])->name('slide.delete');
    Route::get('slider-inactive/{id}', [SliderController::class, 'inactive'])->name('slide.inactive');
    Route::get('slider-active/{id}', [SliderController::class, 'active'])->name('slide.active');
    
    // COUPON
    Route::get('coupon', [CouponController::class, 'index'])->name('coupon');
    Route::post('coupon', [CouponController::class, 'store'])->name('coupon.store');
    Route::get('coupon/delete/{id}', [CouponController::class, 'delete'])->name('coupon.delete');
    Route::get('coupon/edite/{id}', [CouponController::class, 'edite'])->name('coupon.edite');
    Route::post('coupon/update/{id}', [CouponController::class, 'update'])->name('coupon.update');

    // SHIPPING AREA
    Route::get('ship/division', [ShippingArea::class, 'index'])->name('ship.area');
    Route::post('ship/division/store', [ShippingArea::class, 'store'])->name('ship.store');
    Route::get('ship/division/edite/{id}', [ShippingArea::class, 'edite'])->name('ship.edite');
    Route::post('ship/division/update/{id}', [ShippingArea::class, 'update'])->name('ship.update');
    Route::get('ship/division/delete/{id}', [ShippingArea::class, 'destory'])->name('ship.delete');

    Route::get('ship/district', [ShippingArea::class, 'district_index'])->name('ship.district.area');
    Route::post('ship/district/store', [ShippingArea::class, 'district_store'])->name('ship.district.store');
    Route::get('ship/district/edite/{id}', [ShippingArea::class, 'district_edite'])->name('ship.district.edite');
    Route::post('ship/district/update/{id}', [ShippingArea::class, 'district_update'])->name('ship.district.update');
    Route::get('ship/district/delete/{id}', [ShippingArea::class, 'district_destory'])->name('ship.district.delete');

    Route::get('ship/state', [ShippingArea::class, 'state_index'])->name('ship.state.area');
    Route::post('ship/state/store', [ShippingArea::class, 'state_store'])->name('ship.state.store');
    Route::get('ship/state/edite/{id}', [ShippingArea::class, 'state_edite'])->name('ship.state.edite');
    Route::post('ship/state/update/{id}', [ShippingArea::class, 'state_update'])->name('ship.state.update');
    Route::get('ship/state/delete/{id}', [ShippingArea::class, 'state_destory'])->name('ship.state.delete');
    Route::get('get-division/{id}', [ShippingArea::class, 'get_division'])->name('get-division');

    // ORDER
    Route::get('pending/order', [orderController::class, 'pendingOrder'])->name('pending.order');
    Route::get('view/order/{id}', [orderController::class, 'vieworder'])->name('pending.order.view');
    Route::get('confirmed/order', [orderController::class, 'confirmendOrder'])->name('confirem.order');
    Route::get('processing/order', [orderController::class, 'processingOrder'])->name('processing.order');
    Route::get('picked/order', [orderController::class, 'pickedOrder'])->name('picked.order');
    Route::get('shipped/order', [orderController::class, 'shippedOrder'])->name('shipped.order');
    Route::get('delivered/order', [orderController::class, 'deliveredOrder'])->name('delivered.order');
    Route::get('cancel/order', [orderController::class, 'cancelOrder'])->name('cancel.order');

    // STATUS
    Route::get('pending-to-confirem/{id}', [orderController::class, 'pendingToConfirem'])->name('pending-to-confirem');
    Route::get('confiremed-to-processing/{id}', [orderController::class, 'ConfiremToProcessing'])->name('confiremed-to-processing');
    Route::get('processing-to-picked/{id}', [orderController::class, 'ProcessingToPicked'])->name('processing-to-picked');
    Route::get('picked-to-shiped/{id}', [orderController::class, 'pickedToShiped'])->name('picked-to-shiped');
    Route::get('shiped-to-delivered/{id}', [orderController::class, 'ShipedToDelivered'])->name('shiped-to-delivered');

    // ROLE MANEGMENT
    Route::resource('role', RoleController::class);
    Route::resource('permiession', PermisionController::class);
    Route::resource('subadmin', SubAdminController::class);
}); 

Route::group(['as'=>'user.', 'prefix'=>'user', 'middleware'=>['user', 'auth'], 'namespace'=>'User'], function(){
    Route::get('dashboard', [UserController::class, 'index'])->name('dashboard'); 
    Route::post('update/data', [UserController::class, 'updateData'])->name('updateprofile'); 
    Route::get('user-image', [UserController::class, 'userImage'])->name('image'); 
    Route::post('update-image', [UserController::class, 'updateimage'])->name('updateimage'); 
    Route::get('update-password', [UserController::class, 'updatePassword'])->name('updatePassword');
    Route::post('update-password', [UserController::class, 'StorPassword'])->name('StorPassword');
    Route::get('get-district/{id}', [CheckoutController::class, 'getDistrict'])->name('get.district');
    Route::get('get-state/{id}', [CheckoutController::class, 'getState'])->name('get.state');
    Route::post('checkout/payment', [CheckoutController::class, 'storeCheckout'])->name('store.checkout');
    Route::post('payment/stripe', [StripeController::class, 'Store'])->name('stripe.payment');
    // ORDER FRONTEND
    Route::get('order/view', [UserController::class, 'OrderView'])->name('order.view');
    Route::get('single-order/{id}', [UserController::class, 'singleOrderView'])->name('single.order.view');
    Route::get('get-order-invoice/{id}', [UserController::class, 'invoiceDownload'])->name('download.invoice');
});

Route::get('language-english', [LanguageController::class, 'english'])->name('language.english');
Route::get('language-bangla', [LanguageController::class, 'bangla'])->name('language.bangla');
Route::get('single-product/{id}/{slug}', [IndexController::class, 'single_product'])->name('single.product');

Route::get('tags-products-show/{tags}', [IndexController::class, 'tags_product'])->name('tags.pdoruct');
Route::get('product-view-ajax/{id}', [IndexController::class, 'productViewAjax'])->name('product-view-ajax');

Route::post('add-to-card/{id}', [CardControler::class, 'addToCard'])->name('add-to-card');
Route::get('mini-card-content', [CardControler::class, 'miniCard'])->name('minicard');
Route::get('remove-mini-card/{rowId}', [CardControler::class, 'removeMiniCart'])->name('remove-mini-cart');

// WISH LIST
Route::post('wish-lish/{id}', [WishlistController::class, 'store'])->name('store.wishlist');
Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist');

// CART PAGE
Route::get('my-cart', [CardControler::class, 'index'])->name('view-cart');
Route::post('apply/coupon', [CardControler::class, 'couponAplly'])->name('apply-coupon');
Route::get('coupon-calculation', [CardControler::class, 'CouponCal'])->name('coupon.calculation');
Route::get('remove-coupon', [CardControler::class, 'RemoveCoupon'])->name('remove-coupon');
Route::get('get/cart', [CardControler::class, 'getCart'])->name('get.cart');

Route::get('user/checkout', [CardControler::class, 'CkeckoutCreate'])->name('ckeckout');

// SOCAIL LOGIN //
// google
Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login-google');
Route::get('login/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::get('login/facebook', [LoginController::class, 'redirectToFacebook'])->name('login-facebook');
Route::get('login/facebook/callback', [LoginController::class, 'handleFacebookCallback']);


// SEARCH
Route::get('search/product', [SearchController::class, 'SearchProduct'])->name('search.product');
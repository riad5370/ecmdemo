<?php

use App\Http\Controllers\Admin\BrandController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CustromerRegisterController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OtherOrderController;
use App\Http\Controllers\Admin\ProductVariationController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SliderControler;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BuyButtonCheckoutController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategorySubcategoryProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerPasswordResetController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\OtherFrontendController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StripePaymentController;


Route::get('/',[FrontendController::class,'index'])->name('index');
Route::get('/product-details/{slug}',[ProductDetailController::class,'details'])->name('details');
Route::post('/getsize',[OtherFrontendController::class,'getsize']);
Route::get('/customer/signup',[OtherFrontendController::class,'signup'])->name('customer.signup');
Route::get('/customer/new-register',[OtherFrontendController::class,'newRegister'])->name('customer.newregister');
Route::get('/my/order',[OtherFrontendController::class,'myOrder'])->name('my.order');
Route::get('/sales/product',[OtherFrontendController::class,'salesProduct'])->name('sales.product');
Route::get('/cart',[CategorySubcategoryProductController::class,'cart'])->name('cart.view');
Route::get('/category/product/{category_id}',[CategorySubcategoryProductController::class,'categoryProduct'])->name('category.product');
Route::get('/subcategory/product/{subcategory_id}',[CategorySubcategoryProductController::class,'subcategoryProduct'])->name('subcategory.product');

//customer-Register-Login
Route::post('/customer/register',[CustromerRegisterController::class,'customerRegister'])->name('customer.register');
Route::post('/customer/login',[CustomerLoginController::class,'customerLogin'])->name('customer.login');
Route::get('/customer/logout',[CustomerLoginController::class,'Logout'])->name('customer.logout');

//customer-social-login
Route::get('/google/redirect',[GoogleController::class,'google_redirect'])->name('google.redirect');
Route::get('/google/callback',[GoogleController::class,'google_callback'])->name('google.callback');

//password-Reset
Route::get('/forgot-password',[CustomerPasswordResetController::class,'index'])->name('forgot.password');
Route::Post('/password-reset-request',[CustomerPasswordResetController::class,'passResetRequest'])->name('reset.request');
Route::get('/password-reset-form/{token}',[CustomerPasswordResetController::class,'passResetForm'])->name('pass.reset.form');
Route::Post('/customer-password-reset',[CustomerPasswordResetController::class,'passwordReset'])->name('customer.password.reset');

//Email-Verify
// Route::get('/verify/mail/{token}', [CustromerRegisterController::class, 'verifyMail'])->name('verify.mail');
// Route::get('/mail/verify/request',[CustromerRegisterController::class,'mailVerifyReq'])->name('verify.mail.req');
// Route::post('/mail/verify/again',[CustromerRegisterController::class,'mailVerifyAgain'])->name('mail.verify.again');

//customer-profile
Route::get('/customer/profile',[CustomerController::class,'profile'])->name('customer.profile');
Route::post('/customer/profile-update',[CustomerController::class, 'profileUpdate'])->name('profile.update');

//customer-download-invoice
Route::get('/order/download/invoice/{order_id}',[CustomerController::class,'downloadInvoice'])->name('download.invoice');

//review
Route::post('/review/store',[CustomerController::class,'reviewStore'])->name('review.store');

//cart
Route::post('/add/cart',[CartController::class,'cartStore'])->name('add.cart');
Route::get('cart/remove/{id}',[CartController::class,'remove'])->name('cart.remove');
Route::post('cart/update',[CartController::class,'cartUpdate'])->name('cart.update');

//product-checkout
Route::get('/checkout',[CheckoutController::class,'checkout'])->name('checkout');
Route::post('/checkout/store',[CheckoutController::class,'store'])->name('checkout.store');
Route::get('/order/success/{abc}',[CheckoutController::class,'orderSuccess'])->name('order.success');
//buyNow-button-checkout
Route::post('/checkout/main-button-checkout',[BuyButtonCheckoutController::class,'buyNow'])->name('buy.now');
Route::Post('/buy-now-checkout-store',[BuyButtonCheckoutController::class,'buyNowCheckoutStore'])->name('buynowcheckout.store');

//searching..................
Route::get('/search',[SearchController::class,'search'])->name('search');
//stripe-payment-method
Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});


Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])
    ->group(function() {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');


    Route::resource('products',ProductController::class);
    Route::resource('categories',CategoryController::class);
    Route::resource('subcategories',SubcategoryController::class);
    Route::resource('brands',BrandController::class);
    Route::resource('sliders',SliderControler::class);
    Route::post('/getsubcategory',[ProductController::class,'getsubcategory']);
    Route::get('/products/inventory/{id}',[InventoryController::class,'inventory'])->name('products.inventory');
    Route::post('/products/store',[InventoryController::class,'inventoryStore'])->name('inventory.store');
    Route::get('/products/inventory-delete/{id}',[InventoryController::class,'inventoryDelete'])->name('inventory.delete');

    //product-variation
    Route::get('/product/variation',[ProductVariationController::class,'productVariation'])->name('products.variation');
    Route::post('/product/variation/store',[ProductVariationController::class,'variationStore'])->name('variation.store');
    Route::post('/product/variation/delete',[ProductVariationController::class,'variationDelete'])->name('variation.delete');

     //order
     Route::get('/orders',[OrderController::class,'orders'])->name('orders');
     Route::get('/orders/details/{id}',[OrderController::class,'ordersDetails'])->name('order.details');
     Route::post('/order/status',[OrderController::class,'orderStatus'])->name('order.status');
     Route::get('/order-delete/{id}',[OrderController::class,'orderDelete'])->name('delete.orders');

     //order-invoice-download
     Route::get('/customerbill/invoice/{id}',[OrderController::class,'customerbillInvoice'])->name('customerbill.invoice');

     //pendingOrder--Other Order
     Route::get('/orders/pending-order',[OtherOrderController::class,'pendingOrders'])->name('pending.orders');
     Route::get('/orders/complete-order',[OtherOrderController::class,'completeOrders'])->name('complete.orders');
     Route::get('/cutomer-list',[OtherOrderController::class,'customerList'])->name('customers.list');
     Route::get('/billing-customer',[OtherOrderController::class,'billingCustomer'])->name('billing.customers');
     Route::get('/customer-delete/{id}',[OtherOrderController::class,'customerDelete'])->name('delete.customers');



    // coupon
    Route::resource('/coupons',CouponController::class);

    //role-manager-permission
    Route::get('/role',[RoleController::class,'role'])->name('role');
        //permission
    Route::post('/permission/store',[RoleController::class,'storePermission'])->name('permission.store');
        //Role-as-permission
    Route::post('/role/store',[RoleController::class,'storeRole'])->name('role.store');
    Route::get('/role/delete/permission/{role_id}',[RoleController::class,'delete_permission'])->name('delete.permission');

    //user-asign-role-permission
    Route::post('/assign/role',[RoleController::class,'assignRole'])->name('assign.role');
    Route::get('/remove/role/{id}',[RoleController::class,'removeRole'])->name('remove.role');
    Route::get('/role/permission/edit/{id}',[RoleController::class,'user_role_permission_edit'])->name('edit.user.permission');
    Route::post('/permission/update',[RoleController::class,'permissionUpdate'])->name('permission.update');

    //user
    Route::resource('users',UserController::class);
    //profile-setting
    Route::get('/profile',[ProfileController::class,'profile'])->name('profile');
    Route::post('/profile-baicInfo-change', [ProfileController::class, 'infoUpdate'])->name('info.update');
    Route::post('/profile-password-update', [ProfileController::class, 'passwordUpdate'])->name('profile.password.update');
});

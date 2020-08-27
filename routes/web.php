<?php



Route::get('/','FrontController@index');
//auth & user
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/password-change', 'HomeController@changePassword')->name('password.change');
Route::post('/password-update', 'HomeController@updatePassword')->name('password.update');
Route::get('/user/logout', 'HomeController@Logout')->name('user.logout');

//admin=======
Route::get('admin/home', 'AdminController@index');
Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login');
        // Password Reset Routes...
Route::get('admin/password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin/reset/password/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin/update/reset', 'Admin\ResetPasswordController@reset')->name('admin.reset.update');
Route::get('/admin/Change/Password','AdminController@ChangePassword')->name('admin.password.change');
Route::post('/admin/password/update','AdminController@Update_pass')->name('admin.password.update'); 
Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');

   /// Admin Section
// Categories
Route::resource('admin/category', 'Admin\Category\CategoryController');

// Brand
Route::resource('admin/brand', 'Admin\Category\BrandController');

// Subcategory
Route::resource('admin/subcategory', 'Admin\Category\SubcategoryController');

// Coupon
Route::resource('admin/coupon', 'Admin\Coupon\CouponController');

// News-letter
Route::get('admin/news-letter', 'Admin\Coupon\CouponController@newsLetter')->name('admin.newsletter');
Route::delete('admin/news-letter/{id}', 'Admin\Coupon\CouponController@deleteNewsLetter')->name('admin.newsletter.delete');

 // For show subcategories by Ajax
 Route::get('get/subcategory/{category_id}','Admin\Product\ProductController@getSubcategories');
// Products
Route::resource('admin/product', 'Admin\Product\ProductController');
Route::get('admin/product/active-deactive/{product_id}', 'Admin\Product\ProductController@activateDeactivateProduct')->name('product.activeDeactive');
Route::post('admin/product/file-update','Admin\Product\ProductController@fileUpdate')->name('product.file.update');

// All orders handling by Admin
Route::get('admin/get/orders/{status}','Admin\OrderController@newOrder')->name('admin.neworder');
Route::get('admin/view/order-details/{orderId}','Admin\OrderController@orderDetails')->name('admin.orderDetails');
Route::get('admin/order/action/{orderId}/{action}','Admin\OrderController@orderAction')->name('adminOrder.action');

// All Order related Reports fetching from Admin
Route::get('admin/today/order','Admin\ReportController@todayOrder')->name('today.order');
Route::get('admin/today/delivery','Admin\ReportController@todayDelivery')->name('today.delivery');
Route::get('admin/this/month','Admin\ReportController@thisMonth')->name('this.month');
Route::get('admin/report/search','Admin\ReportController@search')->name('search.report');
Route::post('admin/report/search/month-year','Admin\ReportController@monthYear')->name('search.monthYear');
Route::post('admin/report/search/date','Admin\ReportController@date')->name('search.date');

//Site Setting
Route::resource('admin/site/settings','Admin\SettingController')->except(['create','show','destroy']);

  /// Frontend-All-Routes
// Subscribing Save
Route::post('store/news-letter', 'FrontController@saveNewsLetter')->name('store.newsletter');

// Product Wishlist
Route::resource('product/wishlist','User\WishlistController');

// Add-to-Cart
Route::post('add/to/cart','User\CartController@addToCart')->name('cart.add');
Route::get('cart/check','User\CartController@check');

Route::get('cart/products','User\CartController@showCart')->name('show.cart');
Route::get('cart/product/delete/{id}','User\CartController@deleteCartItem')->name('cartItem.delete');
Route::post('cart/product/update','User\CartController@updateCartItem')->name('update.cartItem');
Route::get('user/checkout','User\CartController@checkout')->name('user.checkout');
Route::post('user/apply/coupon','User\CartController@coupon')->name('apply.coupon');
Route::get('user/coupon/remove','User\CartController@removeCoupon')->name('coupon.remove');

Route::post('/product/add/cart','User\ProductController@addToCart')->name('product.cart');

//Payment Steps
Route::get('payment/page','User\CartController@paymentPage')->name('payment.step');
Route::post('user/payment/process','User\PaymentController@payment')->name('payment.process');
Route::post('user/stripe/payment','User\PaymentController@stripePayment')->name('stripe.payment');

//Product details
Route::get('/product/details/{id}/{product_name}','User\ProductController@productDetails');

//Subcategory wise products
Route::get('/subcat/products/{subcat_id}','User\ProductController@subcatProducts')->name('subcat.products');

//Category wise products
Route::get('/category/products/{category_id}','User\ProductController@categoryProducts')->name('category.products');

// --- For getting the product details by Ajax from index-page for quick view of product
Route::get('/product/quick/details/{id}','User\ProductController@productQuickDetails');

Route::post('/order/tracking','FrontController@trackOrder')->name('order.tracking');


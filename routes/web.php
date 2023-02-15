<?php

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

/*
 * Auth (Login - Register) routes
 */
Auth::routes();
Route::controller(App\Http\Controllers\Auth\ForgotPasswordController::class)->prefix('password')->name('password.')->group(function () {
    Route::post('phone', 'sendResetCodePhone')->name('phone');
});
Route::controller(App\Http\Controllers\Auth\ConfirmPasswordController::class)->prefix('password')->name('password.')->group(function () {
    Route::post('confirm', 'confirm')->name('confirm');
});


Route::controller(App\Http\Controllers\Auth\TwoFAController::class)->prefix('2fa')->name('2fa.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'check');
    Route::get('/resend', 'resend')->name('resend');
});

/*
 * Routes of main pages
 */
Route::controller(App\Http\Controllers\HomeController::class)->name('home.')->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/menu', 'menu')->name('menu');
    Route::get('/product/{product:slug}', 'product')->name('product');
    Route::get('/posts', 'posts')->name('posts');
    Route::get('/post/{post:slug}', 'post')->name('post');
    Route::get('/about-us', 'about')->name('about');
    Route::get('/contact-us', 'contact')->name('contact');
    Route::get('/company-food', 'company')->name('company');

    Route::middleware('auth')->group(function () {
        Route::get('/cart', 'cart')->name('cart');
        Route::get('/checkout', 'checkout')->name('checkout');
        Route::get('/profile', 'profile')->name('profile');
    });
});

/*
 * Routes of cart actions
 */
Route::controller(App\Http\Controllers\CartController::class)->prefix('cart')->name('cart.')->group(function () {
    Route::post('add/{product}', 'add')->name('add');
    Route::post('remove/{product}', 'remove')->name('remove');
    Route::post('clear', 'clear')->name('clear');
});

/*
 * Routes of order actions and invoice view
 */
Route::controller(App\Http\Controllers\OrderController::class)->prefix('order')->name('order.')->group(function () {
    Route::post('store', 'store')->name('store');
    Route::post('checkout', 'checkout')->name('checkout');
    Route::get('invoice/{order}', 'invoice')->name('invoice');
});

/*
 * Routes of map actions
 */
Route::middleware('auth')->controller(App\Http\Controllers\MapController::class)->prefix('map')->name('map.')->group(function () {
    Route::post('/update/{user}', 'update')->name('update');
    Route::post('/store/{user}', 'store')->name('store');
});

/*
 * Routes of profile actions
 */
Route::middleware('auth')->controller(App\Http\Controllers\ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
    Route::post('/update', 'update')->name('update');
});


/*
 * --------------------------------- Api section ---------------------------------
 */
Route::middleware('auth')->controller(App\Http\Controllers\ApiController::class)->prefix('api')->name('api.')->group(function () {
    Route::post('get-map', 'get_map')->name('get-map');
    Route::post('search-address', 'search_address')->name('search-address');
    Route::post('get-product', 'get_product')->name('search-get-product');

    Route::prefix('cart')->name('cart.')->group(function () {
        Route::post('add/{product:slug}', 'cart_add')->name('add');
        Route::post('remove/{product:slug}', 'cart_remove')->name('remove');
    });
});


/*
 * For Test Only --------------------------------------------------
 */

Route::get('/fake_it', function () {
    $product = \App\Models\Product::create([
        'name' => 'چلو کباب لقمه ۲۰۰ گرم',
        'price' => 166000,
        'image' => 'product.jpg',
        'description' => '200 گرم مخلوط گوشت گوسفندی و گوساله، 350 گرم برنج ایرانی، کره 20 گرمی، گوجه کبابی، فلفل کبابی، لیمو یا نارنج، ته دیگ ته چینی'
    ]);

    dd($product);
});


Route::get('/test', function () {
    $created_categories = [];

    $category = \App\Models\Category::create([
        'name' => 'salam',
        'image' => 'sala'
    ]);
    $created_categories[] = [$category => $category->id];

    dd($category->id);
});


/*
 * Force Login As Admin
 */
Route::get('/fl', function () {
    auth()->loginUsingId(1, true);

    return redirect()->route('admin.index');
});


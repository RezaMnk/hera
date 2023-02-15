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

Route::get('/', 'DashboardController@index')->name('index');


/*
 * Users routes
 */
Route::prefix('users')->name('users.')->controller('UserController')->group(function () {
    Route::post('/destroy', 'destroy')->name('destroy');
});
Route::resource('users', 'UserController')->except(['show', 'destroy']);


/*
 * Products routes
 */
Route::prefix('products')->name('products.')->controller('ProductController')->group(function () {
    Route::post('/destroy', 'destroy')->name('destroy');
});

Route::resource('products', 'ProductController')->except(['show', 'destroy']);


/*
 * Categories routes
 */
Route::prefix('categories')->name('categories.')->controller('CategoryController')->group(function () {
    Route::post('/destroy', 'destroy')->name('destroy');
});

Route::resource('categories', 'CategoryController')->except(['create', 'destroy', 'show']);

/*
 * Discounts routes
 */
Route::prefix('discounts')->name('discounts.')->controller('DiscountController')->group(function () {
    Route::post('/destroy', 'destroy')->name('destroy');
});

Route::resource('discounts', 'DiscountController')->except(['create', 'destroy', 'show']);

/*
 * Orders routes
 */
Route::resource('orders', 'OrderController')->except(['edit', 'show', 'destroy', 'update']);

/*
 * Orders routes
 */
Route::prefix('posts')->name('posts.')->controller('PostController')->group(function () {
    Route::post('/destroy', 'destroy')->name('destroy');
});

Route::resource('posts', 'PostController')->except(['show', 'destroy']);

/*
 * Settings routes
 */
Route::middleware('auth.owner')->prefix('settings')->name('settings.')->controller('SettingController')->group(function () {
    Route::get('/index', 'index')->name('index');
    Route::post('/update', 'update')->name('update');
});

//Route::resource('settings', 'SettingController')->except(['show', 'destroy']);

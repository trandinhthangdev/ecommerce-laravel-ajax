<?php

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

// Route::get('/', function () {
//     return view('client.pages.new-product');
// });

Route::post('register','RegisterController@register')->name('register');
Route::post('login','LoginController@login')->name('login');
Route::get('logout','LogoutController@logout')->name('logout');

Route::get('admin/login', 'LoginController@admin_login')->name('admin_login');
Route::post('admin/login_post', 'LoginController@admin_login_post')->name('admin_login_post');
Route::get('admin/logout', 'LoginController@admin_logout')->name('admin_logout');

Route::group(['as' => '', 'prefix' => ''], function(){
	Route::get('index.html', 'ClientController@home')->name('home');

	Route::get('product.html', 'ClientController@product')->name('product');
	Route::get('product.html/{category_slug}-{category_id}', 'ClientController@category_product');
	Route::get('product.html/{category_slug}-{category_id}/{brand_slug}-{brand_id}', 'ClientController@brand_product');
	Route::get('product/{product_id}-{product_slug}', 'ClientController@product_detail');
	Route::post('send_comment_product.html', 'ClientController@send_comment_product');
	Route::post('send_review_product.html', 'ClientController@send_review_product');



	Route::get('news.html', 'ClientController@news')->name('news');
	Route::get('news.html/{news_id}-{news_slug}', 'ClientController@news_detail');
	Route::post('send_comment_news.html', 'ClientController@send_comment_news');

	Route::get('contact.html', 'ClientController@contact')->name('contact');
	Route::post('contact_post.html', 'ClientController@contact_post');
	Route::get('about.html', 'ClientController@about')->name('about');

	Route::post('product_info.html', 'ClientController@product_info');
	Route::get('show_cart.html', 'ClientController@show_cart');
	Route::post('add_to_cart.html', 'ClientController@add_to_cart');
	Route::post('delete_product_cart.html', 'ClientController@delete_product_cart');
	Route::post('update_quantity_order_detail.html', 'ClientController@update_quantity_order_detail');
	Route::get('checkout.html', 'ClientController@checkout');
	Route::post('check_out_post.html', 'ClientController@check_out_post');
	Route::get('check_out_confirm.html/{token_check_out}', 'ClientController@check_out_confirm');

});



Route::group(['as'=> 'admin.','prefix' => 'admin', 'middleware' => 'admin'], function(){

	/* Dashboard */
	Route::get('dashboard', 'DashboardController@index')->name('dashboard');

	/* Category */
	Route::resource('category','CategoryController');
	Route::post('category/update/{id}','CategoryController@update');

	/* Brand */
	Route::get('{category_slug}-{category_id}/brand', 'BrandController@index');
	Route::post('{category_id}/brand', 'BrandController@store');
	Route::get('brand/{id}/edit', 'BrandController@edit');
	Route::post('{category_id}/brand/update/{id}', 'BrandController@update');
	Route::delete('brand/{id}', 'BrandController@destroy');

	/* Product */
	Route::get('{category_slug}-{category_id}/{brand_slug}-{brand_id}/product','ProductController@index');
	Route::post('{category_id}/{brand_id}/product', 'ProductController@store');
	Route::get('product/{id}', 'ProductController@show');
	Route::get('product/{id}/edit', 'ProductController@edit');
	Route::post('product/update/{id}', 'ProductController@update');
	Route::delete('product/{id}', 'ProductController@destroy');

	/* News */
	Route::resource('news','NewsController');
	Route::post('news/update/{id}','NewsController@update');

	/* HomeSlider */
	Route::resource('slider','HomeSliderController');
	Route::post('slider/update/{id}','HomeSliderController@update');

	/* ProductComment */
	Route::get('product-comment', 'ProductCommentController@index')->name('product-comment');

	/* NewsComment */
	Route::get('news-comment', 'NewsCommentController@index')->name('news-comment');

	/* CheckOut */
	Route::get('check-out', 'CheckOutController@index')->name('check-out');

	/* Contact */
	Route::get('contact', 'ContactController@index')->name('contact');

	/* Customer */
	Route::get('customer', 'CustomerController@index')->name('customer');

	/* Admin */
	Route::get('admin', 'AdminController@index')->name('admin');
});


















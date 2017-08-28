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
Route::get('/', function () {
    return view('login');
});

Route::get('errors', 'ErrorsController@index');
Route::get('admin', 'AdminController@index');

Route::group(['prefix' => 'login'], function () {
    Route::post('/', 'LoginController@login');
    Route::any('/logout', 'LoginController@logout');
});

Route::group(['prefix' => 'home'], function () {
    Route::any('/home_banner', 'HomeController@home_banner');
    Route::any('/home_seo', 'HomeController@home_seo');
    Route::any('/home_banner_add', 'HomeController@home_banner_add');
    Route::any('/home_banner_edit/{id}', 'HomeController@home_banner_edit');
    Route::any('/home_banner_delete/{id}', 'HomeController@home_banner_delete');
});

Route::group(['prefix' => 'about'], function () {
    Route::any('/about_research_category', 'AboutController@about_research_category');
    Route::any('/about_research_category_edit/{id}', 'AboutController@about_research_category_edit');
    Route::any('/about_research/{id}', 'AboutController@about_research');
    Route::any('/about_research_add/{id}', 'AboutController@about_research_add');
    Route::any('/about_research_edit/{id}/{previd}', 'AboutController@about_research_edit');
    Route::any('/about_research_delete/{id}/{previd}', 'AboutController@about_research_delete');
    Route::any('/about_research_seo', 'AboutController@about_research_seo');
});

Route::group(['prefix' => 'product'], function () {
    Route::any('/product_star', 'ProductController@product_star');
    Route::any('/product_star_edit/{id}', 'ProductController@product_star_edit');
    Route::get('/product_star_delete/{id}', 'ProductController@product_star_delete');
    Route::any('/product_star_seo', 'ProductController@product_star_seo');
    Route::any('/product_application', 'ProductController@product_application');
    Route::any('/product_application_seo', 'ProductController@product_application_seo');
    Route::any('/product_application_product/{id}', 'ProductController@product_application_product');
    Route::any('/product_application_product_add/{id}', 'ProductController@product_application_product_add');
    Route::any('/product_application_product_delete/{id}/{previd}', 'ProductController@product_application_product_delete');
    Route::any('/product_application_product_edit/{id}/{previd}', 'ProductController@product_application_product_edit');
    Route::any('/', 'ProductController@index');
    Route::any('/product_category_add', 'ProductController@product_category_add');
    Route::any('/product_category_edit/{id}', 'ProductController@product_category_edit');
    Route::get('/product_category_delete/{id}', 'ProductController@product_category_delete');
    Route::any('/product_sub_category/{id}', 'ProductController@product_sub_category');
    Route::any('/product_sub_category_add/{id}', 'ProductController@product_sub_category_add');
    Route::any('/product_sub_category_edit/{id}/{previd}', 'ProductController@product_sub_category_edit');
    Route::any('/product_sub_category_delete/{id}/{previd}', 'ProductController@product_sub_category_delete');
    Route::any('/product_list/{subid}/{previd}', 'ProductController@product_list');
    Route::any('/product_delete/{id}/{subid}/{previd}', 'ProductController@product_delete');
    Route::any('/product_edit/{id}/{subid}/{previd}', 'ProductController@product_edit');
    Route::any('/product_seo', 'ProductController@product_seo');
});

Route::group(['prefix' => 'news'], function () {
    Route::get('/', 'NewsController@index');
    Route::get('/add', 'NewsController@add');
    Route::post('/insert', 'NewsController@insert');
    Route::get('/edit/{id}', 'NewsController@edit');
    Route::post('/update/{id}', 'NewsController@update');
    Route::get('/delete/{id}', 'NewsController@delete');
    Route::any('/news_seo', 'NewsController@news_seo');
});

Route::group(['middleware' => 'cors','prefix' => 'kcc-api'], function () {
    Route::any('/get-home-data', 'KccApiController@getHomeData');
    Route::any('/get-about-research-data', 'KccApiController@getAboutResearchData');
    Route::any('/get-product', 'KccApiController@getProduct');
    Route::any('/get-product-application', 'KccApiController@getProductApplication');
    Route::any('/get-product-star', 'KccApiController@getProductStar');
    Route::any('/get-news', 'KccApiController@getNews');
});
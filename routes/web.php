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

Route::get('/', 'UserHomeController@index')->name('blog');
Route::get('/category/getCat','CategoryController@getCat');
Route::get('/tag/getTag','UserHomeController@getTag');
Route::get('/subcategory/getSubCategory','UserHomeController@getSubCategory');
Route::get('/blog/popular','UserHomeController@popular');
Route::get('/blog/recent','UserHomeController@recent');
Route::get('/blog/allBloglist','UserHomeController@allBloglist');
Route::get('/blog/searchList','UserHomeController@searchList');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function (){

    //category Routes
    Route::get('/category/getData','CategoryController@getCategory');
    Route::get('/category/getTotalCategory','CategoryController@getTotalCategory');
    Route::get('/category/getCategoryDash','CategoryController@getCategoryDash');
    Route::post('/category/store','CategoryController@store');
    Route::get('/category/edit/{id}','CategoryController@edit');
    Route::post('/category/update/{id}','CategoryController@update');
    Route::delete('/category/destroy/{id}','CategoryController@destroy');

    //Sub cate Routes
    Route::get('/sub_cat/getData','SubcategoryController@getData');
    Route::get('/sub_cat/getCatData','SubcategoryController@getCatData');
    Route::post('/sub_cat/store','SubcategoryController@store');
    Route::get('/sub_cat/edit/{id}','SubcategoryController@edit');
    Route::post('/sub_cat/update/{id}','SubcategoryController@update');
    Route::delete('/sub_cat/destroy/{id}','SubcategoryController@destroy');

    //Tag Routes
    Route::get('/tag/getData','TagController@getData');
    Route::get('/tag/getTotalTag','TagController@getTotalTag');
    Route::get('/tag/getTagDash','TagController@getTagDash');
    Route::post('/tag/store','TagController@store');
    Route::get('/tag/edit/{id}','TagController@edit');
    Route::post('/tag/update/{id}','TagController@update');
    Route::delete('/tag/destroy/{id}','TagController@destroy');

    //Blog Routes
    Route::get('/blog/getAllBlog','BlogPostController@getBlog');
    Route::get('/blog/getBlogCount','BlogPostController@getBlogCount');
    Route::get('/blog/getBlogDash','BlogPostController@getBlogDash');
    Route::get('/blog/get_category','BlogPostController@getCategory');
    Route::get('/blog/get_sub_category','BlogPostController@getAllSubCategory');
    Route::get('/blog/get_subCategory/{category_id}','BlogPostController@getSubCategory');
    Route::get('/blog/get_tag','BlogPostController@getTag');
    Route::post('/blog/store','BlogPostController@store');
    Route::get('/blog/edit/{id}','BlogPostController@edit');
    Route::post('/blog/update/{id}','BlogPostController@update');
    Route::delete('/blog/destroy/{id}','BlogPostController@destroy');
    Route::post('/blog/approve/{id}','BlogPostController@approve');
    Route::post('/blog/unapprove/{id}','BlogPostController@unapprove');
    Route::post('/blog/publish/{id}','BlogPostController@publish');
    Route::post('/blog/unpublish/{id}','BlogPostController@unpublish');
    Route::post('/blog/feature/{id}','BlogPostController@feature');
    Route::post('/blog/unfeature/{id}','BlogPostController@unfeature');

    //User Routes
    Route::get('/user/get_role','UserController@getRole');
    Route::get('/user/get_user','UserController@getUser');
    Route::get('/user/get_user_count','UserController@getUserCount');
    Route::post('/user/store','UserController@store');
    Route::get('/user/edit/{id}','UserController@edit');
    Route::post('/user/update/{id}','UserController@update');
    Route::delete('/user/destroy/{id}','UserController@destroy');

    //Roles Routes
    Route::post('/roles/store','RolesController@store');
    Route::get('/roles/getPermission','RolesController@getPermission');
    Route::get('/roles/getData','RolesController@getData');
    Route::get('/roles/edit/{id}','RolesController@edit');
    Route::post('/roles/update/{id}','RolesController@update');
    Route::delete('/role/destroy/{id}','RolesController@destroy');

    //Permission Routes
    Route::get('/permission/getData','PermissionsController@getPermission');
    Route::post('/permission/store','PermissionsController@store');
    Route::get('/permission/edit/{id}','PermissionsController@edit');
    Route::post('/permission/update/{id}','PermissionsController@update');
    Route::delete('/permission/destroy/{id}','PermissionsController@destroy');

});

Route::get('/{any}', 'UserHomeController@index')->name('blog')->where('any','.*');

Route::get('/{any}', 'HomeController@index')->name('home')->where('any','.*');

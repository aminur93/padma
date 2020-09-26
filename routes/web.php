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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function (){

    //category Routes
    Route::get('/category/getData','CategoryController@getCategory');
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
    Route::post('/tag/store','TagController@store');
    Route::get('/tag/edit/{id}','TagController@edit');
    Route::post('/tag/update/{id}','TagController@update');
    Route::delete('/tag/destroy/{id}','TagController@destroy');

    //User Routes
    Route::get('/user/get_role','UserController@getRole');
    Route::get('/user/get_user','UserController@getUser');
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

Route::get('/{any}', 'HomeController@index')->name('home')->where('any','.*');

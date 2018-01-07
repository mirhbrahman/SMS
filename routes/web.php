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
    return view('layouts.admin');
});


// just for example
Route::get('/icons', function () {
    return view('unnecessary.icons.icons');
})->name('icons');

Route::get('/design/create', function () {
    return view('unnecessary.page_design.create');
})->name('design.create');

Route::get('/design/index', function () {
    return view('unnecessary.page_design.index');
})->name('design.index');

Route::get('/design/view', function () {
    return view('unnecessary.page_design.view');
})->name('design.view');

// just for example


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//.........ADMIN AREA..........

Route::group(['prefix'=>'admin'],function(){
    Route::resource('user-role','Admin\Role\UserRolesController',['except'=>['create','show']]);
    Route::resource('users','Admin\User\AdminUsersController');
    Route::put('users/password/{id}','Admin\User\AdminUsersController@changePassword')->name('user.changePassword');
    Route::get('users/verify/{token}','Admin\User\AdminUsersController@verifyByAdmin')->name('user.verifyByAdmin');
    Route::get('users/admin/{id}','Admin\User\AdminUsersController@makeAdmin')->name('user.makeAdmin');
    Route::get('users/regular/{id}','Admin\User\AdminUsersController@makeRegular')->name('user.makeRegular');
});

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('/users', 'UserController');
Route::resource('/navs', 'NavController');

Route::resource('/pages', 'PageController');

Route::group(['prefix', 'pages'], function() {
    Route::get('/show/{id}', 'PageController@show')
        ->name('view-page')
        ->middleware('can:view-page');

    Route::get('/create', 'PageController@create')
        ->name('create-page')
        ->middleware('can:create-page');

    Route::post('/create', 'PageController@store')
        ->name('store-page')
        ->middleware('can:create-page');

    Route::get('/edit/{page}', 'PageController@edit')
        ->name('edit-page')
        ->middleware('can:update-page, page');

    Route::post('/edit/{page}', 'PageController@update')    
        ->name('update-page')
        ->middleware('can:update-page, page');
});

Route::get('/search_users', 'UserController@search')->name('search_users');
Route::get('/search_roles', 'RoleController@search')->name('search_roles');
Route::get('/search_pages', 'PageController@search')->name('search_pages');
Route::get('/search_navs', 'NavController@search')->name('search_navs');


Route::get('/users_to_pdf', 'UserController@createPDF')->name('users_to_pdf');
Route::get('/users_to_excel', 'UsersExportController@export_excel')->name('users_to_excel');
Route::get('/users_to_csv', 'UsersExportController@export_csv')->name('users_to_csv');

Route::get('/pages_to_pdf', 'PageController@createPDF')->name('pages_to_pdf');
Route::get('/pages_to_excel', 'PagesExportController@export_excel')->name('pages_to_excel');
Route::get('/pages_to_csv', 'PagesExportController@export_csv')->name('pages_to_csv');

Route::get('/nav_to_pdf', 'NavController@createPDF')->name('nav_to_pdf');
Route::get('/nav_to_excel', 'NavsExportController@export_excel')->name('nav_to_excel');
Route::get('/nav_to_csv', 'NavsExportController@export_csv')->name('nav_to_csv');

Route::get('/role_to_pdf', 'RoleController@createPDF')->name('role_to_pdf');
Route::get('/role_to_excel', 'RolesExportController@export_excel')->name('role_to_excel');
Route::get('/role_to_csv', 'RolesExportController@export_csv')->name('role_to_csv');

Route::resource('/roles', 'RoleController');

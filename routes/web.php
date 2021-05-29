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

Route::resource('/roles', 'RoleController');
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

Route::group(['middleware' => ['get.menu']], function () {
    Route::get('/','Auth\LoginController@showLoginForm');
    Route::get('/home','Auth\LoginController@showLoginForm');

    Route::group(['middleware' => ['role:user']], function () {
        Route::resource('campaigns', 'CampaignController');
        Route::resource('creatives', 'CreativeController');
        Route::resource('dashboard', 'HomeController');
    });
    Auth::routes();

    Route::group(['middleware' => ['role:admin']], function () {
        Route::post('/creatives/live_update', 'CreativeController@live_update')->name('creatives.live_update');
        Route::put('/campaigns/edit_status/{id}/{status}', 'CampaignController@edit_status')->name('campaigns.edit_status');
        Route::put('/creatives/edit_status/{id}/{status}', 'CreativeController@edit_status')->name('creatives.edit_status');
        Route::get('/campaigns/download/{path}', 'CampaignController@download')->name('campaigns.download');
        Route::resource('users', 'UsersController');
        Route::resource('roles', 'RolesController');
        Route::get('/roles/move/move-up', 'RolesController@moveUp')->name('roles.up');
        Route::get('/roles/move/move-down', 'RolesController@moveDown')->name('roles.down');
        Route::prefix('menu/element')->group(function () {
            Route::get('/', 'MenuElementController@index')->name('menu.index');
            Route::get('/move-up', 'MenuElementController@moveUp')->name('menu.up');
            Route::get('/move-down', 'MenuElementController@moveDown')->name('menu.down');
            Route::get('/create', 'MenuElementController@create')->name('menu.create');
            Route::post('/store', 'MenuElementController@store')->name('menu.store');
            Route::get('/get-parents', 'MenuElementController@getParents');
            Route::get('/edit', 'MenuElementController@edit')->name('menu.edit');
            Route::post('/update', 'MenuElementController@update')->name('menu.update');
            Route::get('/show', 'MenuElementController@show')->name('menu.show');
            Route::get('/delete', 'MenuElementController@delete')->name('menu.delete');
        });
        Route::prefix('menu/menu')->group(function () {
            Route::get('/', 'MenuController@index')->name('menu.menu.index');
            Route::get('/create', 'MenuController@create')->name('menu.menu.create');
            Route::post('/store', 'MenuController@store')->name('menu.menu.store');
            Route::get('/edit', 'MenuController@edit')->name('menu.menu.edit');
            Route::post('/update', 'MenuController@update')->name('menu.menu.update');
            Route::get('/delete', 'MenuController@delete')->name('menu.menu.delete');
        });

    });
});

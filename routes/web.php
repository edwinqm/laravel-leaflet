<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);

Route::get('maps', 'MapController@index');

Route::get('blade', function () {
    return view('child');
});

//======
// MAP
//======

Route::group(['prefix' => 'maps'], function () {

    Route::group(['prefix' => 'leaflet'], function () {
        Route::get('/', [
            'uses' => 'LeafletController@index',
            'as' => 'maps.leaflet.index',
        ]);
        Route::get('basic', [
            'uses' => 'LeafletController@basic',
            'as' => 'maps.leaflet.basic',
        ]);
        Route::get('categories', [
            'uses' => 'LeafletController@pruneCategories',
            'as' => 'maps.leaflet.prune-categories',
        ]);
        Route::get('cluster', [
            'uses' => 'LeafletController@pruneCluster',
            'as' => 'maps.leaflet.prune-cluster',
        ]);
        Route::get('control', [
            'uses' => 'LeafletController@pruneControl',
            'as' => 'maps.leaflet.prune-control',
        ]);

    });

    Route::group(['prefix' => 'mapbox'], function () {
        Route::get('index', function () {
            echo 'hi mapbox index';
        });
    });

    // only map controller
    Route::get('tracking', [
        'uses' => 'MapController@tracking',
        'as' => 'maps.tracking',
    ]);
    Route::get('tracking2', [
        'uses' => 'MapController@tracking2',
        'as' => 'maps.tracking2',
    ]);
    Route::get('tracking3', [
        'uses' => 'MapController@tracking3',
        'as' => 'maps.tracking3',
    ]);

});
Route::post('/maps/ajax', 'MapController@ajax');

Route::get('/gsusers', 'GSUserController@index');

Route::get('/gsusers/adv', 'GSUserController@adv');

/**
 * DATATABLES
 */


Route::group(['prefix' => 'datatable'], function () {
    Route::get('/', function () {
        return view('datatables.index');
    });

});
Route::group(['prefix' => 'nayjest'], function () {

    Route::get('/index', function(){
        return view('nayjest.index');
    });
    
    Route::get('example1', ['as' => 'nayjest.example1', 'uses' => 'NayjestController@example1']);
    Route::get('example2', ['as' => 'nayjest.example2', 'uses' => 'NayjestController@example2']);
    Route::get('example3', ['as' => 'nayjest.example3', 'uses' => 'NayjestController@example3']);
    Route::get('example4', ['as' => 'nayjest.example4', 'uses' => 'NayjestController@example4']);
    
});

/**
 * Users CRUD
 */
Route::resource('users', 'UserController');
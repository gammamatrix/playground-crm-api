<?php
/**
 * Playground
 */

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CRM API Routes: Location
|--------------------------------------------------------------------------
|
|
*/

Route::group([
    'prefix' => 'api/crm/location',
    'middleware' => config('playground-crm-api.middleware.default'),
    'namespace' => '\Playground\Crm\Api\Http\Controllers',
], function () {

    Route::get('/{location:slug}', [
        'as' => 'playground.crm.api.locations.slug',
        'uses' => 'LocationController@show',
    ])->where('slug', '[a-zA-Z0-9\-]+');
});

Route::group([
    'prefix' => 'api/crm/locations',
    'middleware' => config('playground-crm-api.middleware.default'),
    'namespace' => '\Playground\Crm\Api\Http\Controllers',
], function () {
    Route::get('/', [
        'as' => 'playground.crm.api.locations',
        'uses' => 'LocationController@index',
    ])->can('index', Playground\Crm\Models\Location::class);

    Route::post('/index', [
        'as' => 'playground.crm.api.locations.index',
        'uses' => 'LocationController@index',
    ])->can('index', Playground\Crm\Models\Location::class);

    // UI

    Route::get('/create', [
        'as' => 'playground.crm.api.locations.create',
        'uses' => 'LocationController@create',
    ])->can('create', Playground\Crm\Models\Location::class);

    Route::get('/edit/{location}', [
        'as' => 'playground.crm.api.locations.edit',
        'uses' => 'LocationController@edit',
    ])->whereUuid('location')->can('edit', 'location');

    // Route::get('/go/{id}', [
    //     'as' => 'playground.crm.api.locations.go',
    //     'uses' => 'LocationController@go',
    // ]);

    Route::get('/{location}', [
        'as' => 'playground.crm.api.locations.show',
        'uses' => 'LocationController@show',
    ])->whereUuid('location')->can('detail', 'location');

    // API

    Route::put('/lock/{location}', [
        'as' => 'playground.crm.api.locations.lock',
        'uses' => 'LocationController@lock',
    ])->whereUuid('location')->can('lock', 'location');

    Route::delete('/lock/{location}', [
        'as' => 'playground.crm.api.locations.unlock',
        'uses' => 'LocationController@unlock',
    ])->whereUuid('location')->can('unlock', 'location');

    Route::delete('/{location}', [
        'as' => 'playground.crm.api.locations.destroy',
        'uses' => 'LocationController@destroy',
    ])->whereUuid('location')->can('delete', 'location')->withTrashed();

    Route::put('/restore/{location}', [
        'as' => 'playground.crm.api.locations.restore',
        'uses' => 'LocationController@restore',
    ])->whereUuid('location')->can('restore', 'location')->withTrashed();

    Route::post('/', [
        'as' => 'playground.crm.api.locations.post',
        'uses' => 'LocationController@store',
    ])->can('store', Playground\Crm\Models\Location::class);

    // Route::put('/', [
    //     'as' => 'playground.crm.api.locations.put',
    //     'uses' => 'LocationController@store',
    // ])->can('store', Playground\Crm\Models\Location::class);
    //
    // Route::put('/{location}', [
    //     'as' => 'playground.crm.api.locations.put.id',
    //     'uses' => 'LocationController@store',
    // ])->whereUuid('location')->can('update', 'location');

    Route::patch('/{location}', [
        'as' => 'playground.crm.api.locations.patch',
        'uses' => 'LocationController@update',
    ])->whereUuid('location')->can('update', 'location');
});

<?php
/**
 * Playground
 */

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CRM API Routes: Client
|--------------------------------------------------------------------------
|
|
*/

Route::group([
    'prefix' => 'api/crm/client',
    'middleware' => config('playground-crm-api.middleware.default'),
    'namespace' => '\Playground\Crm\Api\Http\Controllers',
], function () {

    Route::get('/{client:slug}', [
        'as' => 'playground.crm.api.clients.slug',
        'uses' => 'ClientController@show',
    ])->where('slug', '[a-zA-Z0-9\-]+');
});

Route::group([
    'prefix' => 'api/crm/clients',
    'middleware' => config('playground-crm-api.middleware.default'),
    'namespace' => '\Playground\Crm\Api\Http\Controllers',
], function () {
    Route::get('/', [
        'as' => 'playground.crm.api.clients',
        'uses' => 'ClientController@index',
    ])->can('index', Playground\Crm\Models\Client::class);

    Route::post('/index', [
        'as' => 'playground.crm.api.clients.index',
        'uses' => 'ClientController@index',
    ])->can('index', Playground\Crm\Models\Client::class);

    // UI

    Route::get('/create', [
        'as' => 'playground.crm.api.clients.create',
        'uses' => 'ClientController@create',
    ])->can('create', Playground\Crm\Models\Client::class);

    Route::get('/edit/{client}', [
        'as' => 'playground.crm.api.clients.edit',
        'uses' => 'ClientController@edit',
    ])->whereUuid('client')->can('edit', 'client');

    // Route::get('/go/{id}', [
    //     'as' => 'playground.crm.api.clients.go',
    //     'uses' => 'ClientController@go',
    // ]);

    Route::get('/{client}', [
        'as' => 'playground.crm.api.clients.show',
        'uses' => 'ClientController@show',
    ])->whereUuid('client')->can('detail', 'client');

    // API

    Route::put('/lock/{client}', [
        'as' => 'playground.crm.api.clients.lock',
        'uses' => 'ClientController@lock',
    ])->whereUuid('client')->can('lock', 'client');

    Route::delete('/lock/{client}', [
        'as' => 'playground.crm.api.clients.unlock',
        'uses' => 'ClientController@unlock',
    ])->whereUuid('client')->can('unlock', 'client');

    Route::delete('/{client}', [
        'as' => 'playground.crm.api.clients.destroy',
        'uses' => 'ClientController@destroy',
    ])->whereUuid('client')->can('delete', 'client')->withTrashed();

    Route::put('/restore/{client}', [
        'as' => 'playground.crm.api.clients.restore',
        'uses' => 'ClientController@restore',
    ])->whereUuid('client')->can('restore', 'client')->withTrashed();

    Route::post('/', [
        'as' => 'playground.crm.api.clients.post',
        'uses' => 'ClientController@store',
    ])->can('store', Playground\Crm\Models\Client::class);

    // Route::put('/', [
    //     'as' => 'playground.crm.api.clients.put',
    //     'uses' => 'ClientController@store',
    // ])->can('store', Playground\Crm\Models\Client::class);
    //
    // Route::put('/{client}', [
    //     'as' => 'playground.crm.api.clients.put.id',
    //     'uses' => 'ClientController@store',
    // ])->whereUuid('client')->can('update', 'client');

    Route::patch('/{client}', [
        'as' => 'playground.crm.api.clients.patch',
        'uses' => 'ClientController@update',
    ])->whereUuid('client')->can('update', 'client');
});

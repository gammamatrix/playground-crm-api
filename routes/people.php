<?php
/**
 * Playground
 */

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CRM API Routes: People
|--------------------------------------------------------------------------
|
|
*/

Route::group([
    'prefix' => 'api/crm/people',
    'middleware' => config('playground-crm-api.middleware.default'),
    'namespace' => '\Playground\Crm\Api\Http\Controllers',
], function () {

    Route::get('/{people:slug}', [
        'as' => 'playground.crm.api.people.slug',
        'uses' => 'PeopleController@show',
    ])->where('slug', '[a-zA-Z0-9\-]+');
});

Route::group([
    'prefix' => 'api/crm/people',
    'middleware' => config('playground-crm-api.middleware.default'),
    'namespace' => '\Playground\Crm\Api\Http\Controllers',
], function () {
    Route::get('/', [
        'as' => 'playground.crm.api.people',
        'uses' => 'PeopleController@index',
    ])->can('index', Playground\Crm\Models\People::class);

    Route::post('/index', [
        'as' => 'playground.crm.api.people.index',
        'uses' => 'PeopleController@index',
    ])->can('index', Playground\Crm\Models\People::class);

    // UI

    Route::get('/create', [
        'as' => 'playground.crm.api.people.create',
        'uses' => 'PeopleController@create',
    ])->can('create', Playground\Crm\Models\People::class);

    Route::get('/edit/{people}', [
        'as' => 'playground.crm.api.people.edit',
        'uses' => 'PeopleController@edit',
    ])->whereUuid('people')->can('edit', 'people');

    // Route::get('/go/{id}', [
    //     'as' => 'playground.crm.api.people.go',
    //     'uses' => 'PeopleController@go',
    // ]);

    Route::get('/{people}', [
        'as' => 'playground.crm.api.people.show',
        'uses' => 'PeopleController@show',
    ])->whereUuid('people')->can('detail', 'people');

    // API

    Route::put('/lock/{people}', [
        'as' => 'playground.crm.api.people.lock',
        'uses' => 'PeopleController@lock',
    ])->whereUuid('people')->can('lock', 'people');

    Route::delete('/lock/{people}', [
        'as' => 'playground.crm.api.people.unlock',
        'uses' => 'PeopleController@unlock',
    ])->whereUuid('people')->can('unlock', 'people');

    Route::delete('/{people}', [
        'as' => 'playground.crm.api.people.destroy',
        'uses' => 'PeopleController@destroy',
    ])->whereUuid('people')->can('delete', 'people')->withTrashed();

    Route::put('/restore/{people}', [
        'as' => 'playground.crm.api.people.restore',
        'uses' => 'PeopleController@restore',
    ])->whereUuid('people')->can('restore', 'people')->withTrashed();

    Route::post('/', [
        'as' => 'playground.crm.api.people.post',
        'uses' => 'PeopleController@store',
    ])->can('store', Playground\Crm\Models\People::class);

    // Route::put('/', [
    //     'as' => 'playground.crm.api.people.put',
    //     'uses' => 'PeopleController@store',
    // ])->can('store', Playground\Crm\Models\People::class);
    //
    // Route::put('/{people}', [
    //     'as' => 'playground.crm.api.people.put.id',
    //     'uses' => 'PeopleController@store',
    // ])->whereUuid('people')->can('update', 'people');

    Route::patch('/{people}', [
        'as' => 'playground.crm.api.people.patch',
        'uses' => 'PeopleController@update',
    ])->whereUuid('people')->can('update', 'people');
});

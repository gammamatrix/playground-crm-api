<?php
/**
 * Playground
 */

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CRM API Routes: Contact
|--------------------------------------------------------------------------
|
|
*/

Route::group([
    'prefix' => 'api/crm/contact',
    'middleware' => config('playground-crm-api.middleware.default'),
    'namespace' => '\Playground\Crm\Api\Http\Controllers',
], function () {

    Route::get('/{contact:slug}', [
        'as' => 'playground.crm.api.contacts.slug',
        'uses' => 'ContactController@show',
    ])->where('slug', '[a-zA-Z0-9\-]+');
});

Route::group([
    'prefix' => 'api/crm/contacts',
    'middleware' => config('playground-crm-api.middleware.default'),
    'namespace' => '\Playground\Crm\Api\Http\Controllers',
], function () {
    Route::get('/', [
        'as' => 'playground.crm.api.contacts',
        'uses' => 'ContactController@index',
    ])->can('index', Playground\Crm\Models\Contact::class);

    Route::post('/index', [
        'as' => 'playground.crm.api.contacts.index',
        'uses' => 'ContactController@index',
    ])->can('index', Playground\Crm\Models\Contact::class);

    // UI

    Route::get('/create', [
        'as' => 'playground.crm.api.contacts.create',
        'uses' => 'ContactController@create',
    ])->can('create', Playground\Crm\Models\Contact::class);

    Route::get('/edit/{contact}', [
        'as' => 'playground.crm.api.contacts.edit',
        'uses' => 'ContactController@edit',
    ])->whereUuid('contact')->can('edit', 'contact');

    // Route::get('/go/{id}', [
    //     'as' => 'playground.crm.api.contacts.go',
    //     'uses' => 'ContactController@go',
    // ]);

    Route::get('/{contact}', [
        'as' => 'playground.crm.api.contacts.show',
        'uses' => 'ContactController@show',
    ])->whereUuid('contact')->can('detail', 'contact');

    // API

    Route::put('/lock/{contact}', [
        'as' => 'playground.crm.api.contacts.lock',
        'uses' => 'ContactController@lock',
    ])->whereUuid('contact')->can('lock', 'contact');

    Route::delete('/lock/{contact}', [
        'as' => 'playground.crm.api.contacts.unlock',
        'uses' => 'ContactController@unlock',
    ])->whereUuid('contact')->can('unlock', 'contact');

    Route::delete('/{contact}', [
        'as' => 'playground.crm.api.contacts.destroy',
        'uses' => 'ContactController@destroy',
    ])->whereUuid('contact')->can('delete', 'contact')->withTrashed();

    Route::put('/restore/{contact}', [
        'as' => 'playground.crm.api.contacts.restore',
        'uses' => 'ContactController@restore',
    ])->whereUuid('contact')->can('restore', 'contact')->withTrashed();

    Route::post('/', [
        'as' => 'playground.crm.api.contacts.post',
        'uses' => 'ContactController@store',
    ])->can('store', Playground\Crm\Models\Contact::class);

    // Route::put('/', [
    //     'as' => 'playground.crm.api.contacts.put',
    //     'uses' => 'ContactController@store',
    // ])->can('store', Playground\Crm\Models\Contact::class);
    //
    // Route::put('/{contact}', [
    //     'as' => 'playground.crm.api.contacts.put.id',
    //     'uses' => 'ContactController@store',
    // ])->whereUuid('contact')->can('update', 'contact');

    Route::patch('/{contact}', [
        'as' => 'playground.crm.api.contacts.patch',
        'uses' => 'ContactController@update',
    ])->whereUuid('contact')->can('update', 'contact');
});

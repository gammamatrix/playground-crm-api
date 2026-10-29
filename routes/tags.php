<?php

/**
 * Playground
 */

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Playground\Crm\Models\Tag;

/*
|--------------------------------------------------------------------------
| CRM API Routes: Tag
|--------------------------------------------------------------------------
|
|
*/

Route::group([
    'prefix' => 'api/crm/tag',
    'middleware' => config('playground-crm-api.middleware.default'),
    'namespace' => '\Playground\Crm\Api\Http\Controllers',
], function () {

    Route::get('/{tag:slug}', [
        'as' => 'playground.crm.api.tags.slug',
        'uses' => 'TagController@show',
    ])->where('slug', '[a-zA-Z0-9\-]+');
});

Route::group([
    'prefix' => 'api/crm/tags',
    'middleware' => config('playground-crm-api.middleware.default'),
    'namespace' => '\Playground\Crm\Api\Http\Controllers',
], function () {
    Route::get('/', [
        'as' => 'playground.crm.api.tags',
        'uses' => 'TagController@index',
    ])->can('index', Tag::class);

    Route::post('/index', [
        'as' => 'playground.crm.api.tags.index',
        'uses' => 'TagController@index',
    ])->can('index', Tag::class);

    // UI

    Route::get('/create', [
        'as' => 'playground.crm.api.tags.create',
        'uses' => 'TagController@create',
    ])->can('create', Tag::class);

    Route::get('/edit/{tag}', [
        'as' => 'playground.crm.api.tags.edit',
        'uses' => 'TagController@edit',
    ])->whereUuid('tag')->can('edit', 'tag');

    // Route::get('/go/{id}', [
    //     'as' => 'playground.crm.api.tags.go',
    //     'uses' => 'TagController@go',
    // ]);

    Route::get('/{tag}', [
        'as' => 'playground.crm.api.tags.show',
        'uses' => 'TagController@show',
    ])->whereUuid('tag')->can('detail', 'tag')->withTrashed();

    // API

    Route::put('/lock/{tag}', [
        'as' => 'playground.crm.api.tags.lock',
        'uses' => 'TagController@lock',
    ])->whereUuid('tag')->can('lock', 'tag');

    Route::delete('/lock/{tag}', [
        'as' => 'playground.crm.api.tags.unlock',
        'uses' => 'TagController@unlock',
    ])->whereUuid('tag')->can('unlock', 'tag');

    Route::delete('/{tag}', [
        'as' => 'playground.crm.api.tags.destroy',
        'uses' => 'TagController@destroy',
    ])->whereUuid('tag')->can('delete', 'tag')->withTrashed();

    Route::put('/restore/{tag}', [
        'as' => 'playground.crm.api.tags.restore',
        'uses' => 'TagController@restore',
    ])->whereUuid('tag')->can('restore', 'tag')->withTrashed();

    Route::post('/', [
        'as' => 'playground.crm.api.tags.post',
        'uses' => 'TagController@store',
    ])->can('store', Tag::class);

    // Route::put('/', [
    //     'as' => 'playground.crm.api.tags.put',
    //     'uses' => 'TagController@store',
    // ])->can('store', Playground\Crm\Models\Tag::class);
    //
    // Route::put('/{tag}', [
    //     'as' => 'playground.crm.api.tags.put.id',
    //     'uses' => 'TagController@store',
    // ])->whereUuid('tag')->can('update', 'tag');

    Route::patch('/{tag}', [
        'as' => 'playground.crm.api.tags.patch',
        'uses' => 'TagController@update',
    ])->whereUuid('tag')->can('update', 'tag');
});

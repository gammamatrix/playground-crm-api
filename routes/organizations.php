<?php
/**
 * Playground
 */

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CRM API Routes: Organization
|--------------------------------------------------------------------------
|
|
*/

Route::group([
    'prefix' => 'api/crm/organization',
    'middleware' => config('playground-crm-api.middleware.default'),
    'namespace' => '\Playground\Crm\Api\Http\Controllers',
], function () {

    Route::get('/{organization:slug}', [
        'as' => 'playground.crm.api.organizations.slug',
        'uses' => 'OrganizationController@show',
    ])->where('slug', '[a-zA-Z0-9\-]+');
});

Route::group([
    'prefix' => 'api/crm/organizations',
    'middleware' => config('playground-crm-api.middleware.default'),
    'namespace' => '\Playground\Crm\Api\Http\Controllers',
], function () {
    Route::get('/', [
        'as' => 'playground.crm.api.organizations',
        'uses' => 'OrganizationController@index',
    ])->can('index', Playground\Crm\Models\Organization::class);

    Route::post('/index', [
        'as' => 'playground.crm.api.organizations.index',
        'uses' => 'OrganizationController@index',
    ])->can('index', Playground\Crm\Models\Organization::class);

    // UI

    Route::get('/create', [
        'as' => 'playground.crm.api.organizations.create',
        'uses' => 'OrganizationController@create',
    ])->can('create', Playground\Crm\Models\Organization::class);

    Route::get('/edit/{organization}', [
        'as' => 'playground.crm.api.organizations.edit',
        'uses' => 'OrganizationController@edit',
    ])->whereUuid('organization')->can('edit', 'organization');

    // Route::get('/go/{id}', [
    //     'as' => 'playground.crm.api.organizations.go',
    //     'uses' => 'OrganizationController@go',
    // ]);

    Route::get('/{organization}', [
        'as' => 'playground.crm.api.organizations.show',
        'uses' => 'OrganizationController@show',
    ])->whereUuid('organization')->can('detail', 'organization');

    // API

    Route::put('/lock/{organization}', [
        'as' => 'playground.crm.api.organizations.lock',
        'uses' => 'OrganizationController@lock',
    ])->whereUuid('organization')->can('lock', 'organization');

    Route::delete('/lock/{organization}', [
        'as' => 'playground.crm.api.organizations.unlock',
        'uses' => 'OrganizationController@unlock',
    ])->whereUuid('organization')->can('unlock', 'organization');

    Route::delete('/{organization}', [
        'as' => 'playground.crm.api.organizations.destroy',
        'uses' => 'OrganizationController@destroy',
    ])->whereUuid('organization')->can('delete', 'organization')->withTrashed();

    Route::put('/restore/{organization}', [
        'as' => 'playground.crm.api.organizations.restore',
        'uses' => 'OrganizationController@restore',
    ])->whereUuid('organization')->can('restore', 'organization')->withTrashed();

    Route::post('/', [
        'as' => 'playground.crm.api.organizations.post',
        'uses' => 'OrganizationController@store',
    ])->can('store', Playground\Crm\Models\Organization::class);

    // Route::put('/', [
    //     'as' => 'playground.crm.api.organizations.put',
    //     'uses' => 'OrganizationController@store',
    // ])->can('store', Playground\Crm\Models\Organization::class);
    //
    // Route::put('/{organization}', [
    //     'as' => 'playground.crm.api.organizations.put.id',
    //     'uses' => 'OrganizationController@store',
    // ])->whereUuid('organization')->can('update', 'organization');

    Route::patch('/{organization}', [
        'as' => 'playground.crm.api.organizations.patch',
        'uses' => 'OrganizationController@update',
    ])->whereUuid('organization')->can('update', 'organization');
});

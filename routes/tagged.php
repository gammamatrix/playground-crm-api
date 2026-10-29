<?php

/**
 * Playground
 */

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Playground\Crm\Models\Tagged;

/*
|--------------------------------------------------------------------------
| CRM API Routes: Tagged
|--------------------------------------------------------------------------
|
|
*/

Route::group([
    'prefix' => 'api/crm/tagged',
    'middleware' => config('playground-crm-api.middleware.default'),
    'namespace' => '\Playground\Crm\Api\Http\Controllers',
], function () {

    // API

    Route::delete('/{tagged}', [
        'as' => 'playground.crm.api.tagged.destroy',
        'uses' => 'TaggedController@destroy',
    ])->whereUuid('tagged')->can('delete', 'tagged')->withTrashed();

    Route::post('/', [
        'as' => 'playground.crm.api.tagged.post',
        'uses' => 'TaggedController@store',
    ])->can('store', Tagged::class);
});

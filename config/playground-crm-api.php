<?php
/**
 * Playground
 */

declare(strict_types=1);

/**
 * Playground: CRM API Configuration and Environment Variables
 */
return [

    /*
    |--------------------------------------------------------------------------
    | About Information
    |--------------------------------------------------------------------------
    |
    | By default, information will be displayed about this package when using:
    |
    | `artisan about`
    |
    */

    'about' => (bool) env('PLAYGROUND_CRM_API_ABOUT', true),

    /*
    |--------------------------------------------------------------------------
    | Loading
    |--------------------------------------------------------------------------
    |
    | By default, translations and views are loaded.
    |
    */

    'load' => [
        'policies' => (bool) env('PLAYGROUND_CRM_API_LOAD_POLICIES', true),
        'routes' => (bool) env('PLAYGROUND_CRM_API_LOAD_ROUTES', true),
        'translations' => (bool) env('PLAYGROUND_CRM_API_LOAD_TRANSLATIONS', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    |
    */

    'middleware' => [
        'default' => env('PLAYGROUND_CRM_API_MIDDLEWARE_DEFAULT', [
            'web',
            Illuminate\Routing\Middleware\SubstituteBindings::class,
            'auth:sanctum',
            Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]),
        'auth' => env('PLAYGROUND_CRM_API_MIDDLEWARE_AUTH', [
            'web',
            Illuminate\Routing\Middleware\SubstituteBindings::class,
            'auth:sanctum',
            Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]),
        'guest' => env('PLAYGROUND_CRM_API_MIDDLEWARE_GUEST', [
            'web',
            Illuminate\Routing\Middleware\SubstituteBindings::class,
            Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]),
    ],

    /*
    |--------------------------------------------------------------------------
    | Policies
    |--------------------------------------------------------------------------
    |
    |
    */

    'policies' => [
        Playground\Crm\Models\Client::class => Playground\Crm\Api\Policies\ClientPolicy::class,
        Playground\Crm\Models\Contact::class => Playground\Crm\Api\Policies\ContactPolicy::class,
        Playground\Crm\Models\Location::class => Playground\Crm\Api\Policies\LocationPolicy::class,
        Playground\Crm\Models\Organization::class => Playground\Crm\Api\Policies\OrganizationPolicy::class,
        Playground\Crm\Models\People::class => Playground\Crm\Api\Policies\PeoplePolicy::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Routes
    |--------------------------------------------------------------------------
    |
    |
    */

    'routes' => [
        'clients' => (bool) env('PLAYGROUND_CRM_API_CLIENTS', true),
        'contacts' => (bool) env('PLAYGROUND_CRM_API_CONTACTS', true),
        'locations' => (bool) env('PLAYGROUND_CRM_API_LOCATIONS', true),
        'organizations' => (bool) env('PLAYGROUND_CRM_API_ORGANIZATIONS', true),
        'people' => (bool) env('PLAYGROUND_CRM_API_PEOPLE', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Abilities
    |--------------------------------------------------------------------------
    |
    |
    */

    'abilities' => [
        'admin' => [
            'playground-crm-api:*',
        ],
        'manager' => [
            'playground-crm-api:client:*',
            'playground-crm-api:contact:*',
            'playground-crm-api:location:*',
            'playground-crm-api:organization:*',
            'playground-crm-api:people:*',
        ],
        'user' => [
            'playground-crm-api:client:view',
            'playground-crm-api:client:viewAny',
            'playground-crm-api:contact:view',
            'playground-crm-api:contact:viewAny',
            'playground-crm-api:location:view',
            'playground-crm-api:location:viewAny',
            'playground-crm-api:organization:view',
            'playground-crm-api:organization:viewAny',
            'playground-crm-api:people:view',
            'playground-crm-api:people:viewAny',
        ],
    ],
];

<?php

/**
 * Playground
 */

declare(strict_types=1);
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use Playground\Auth\Policies\Policy;
use Playground\Crm\Api\Policies\ClientPolicy;
use Playground\Crm\Api\Policies\ContactPolicy;
use Playground\Crm\Api\Policies\LocationPolicy;
use Playground\Crm\Api\Policies\OrganizationPolicy;
use Playground\Crm\Api\Policies\PeoplePolicy;
use Playground\Crm\Models\Client;
use Playground\Crm\Models\Contact;
use Playground\Crm\Models\Location;
use Playground\Crm\Models\Organization;
use Playground\Crm\Models\People;

/**
 * Playground: CRM API Configuration and Environment Variables
 *
 * @return array{
 *       about: bool,
 *       load: array{
 *           policies: bool,
 *           routes: bool,
 *           translations: bool
 *       },
 *       matrix: array{
 *           enabled: bool,
 *       },
 *       middleware: array{
 *           default: string|string[],
 *           auth: string|string[],
 *           guest: string|string[]
 *       },
 *       policies: array<
 *           class-string<Model>,
 *           class-string<Policy>
 *       >,
 *       routes: array{
 *           clients: bool,
 *           contacts: bool,
 *           locations: bool,
 *           organizations: bool,
 *           peoples: bool,
 *       },
 *       abilities: array<string, string[]>,
 *       sitemap: array{
 *            enable: bool,
 *            guest: bool,
 *            user: bool,
 *            view: string
 *       }
 *   }
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
    | Matrix
    |--------------------------------------------------------------------------
    |
    |
    */

    'matrix' => [
        'enabled' => (bool) env('PLAYGROUND_CRM_API_MATRIX_ENABLED', false),
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
            SubstituteBindings::class,
            'auth:sanctum',
            EnsureFrontendRequestsAreStateful::class,
        ]),
        'auth' => env('PLAYGROUND_CRM_API_MIDDLEWARE_AUTH', [
            'web',
            SubstituteBindings::class,
            'auth:sanctum',
            EnsureFrontendRequestsAreStateful::class,
        ]),
        'guest' => env('PLAYGROUND_CRM_API_MIDDLEWARE_GUEST', [
            'web',
            SubstituteBindings::class,
            EnsureFrontendRequestsAreStateful::class,
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
        Client::class => ClientPolicy::class,
        Contact::class => ContactPolicy::class,
        Location::class => LocationPolicy::class,
        Organization::class => OrganizationPolicy::class,
        People::class => PeoplePolicy::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Routes
    |--------------------------------------------------------------------------
    |
    |
    */

    'routes' => [
        'clients' => (bool) env('PLAYGROUND_CRM_API_ROUTES_CLIENTS', true),
        'contacts' => (bool) env('PLAYGROUND_CRM_API_ROUTES_CONTACTS', true),
        'locations' => (bool) env('PLAYGROUND_CRM_API_ROUTES_LOCATIONS', true),
        'organizations' => (bool) env('PLAYGROUND_CRM_API_ROUTES_ORGANIZATIONS', true),
        'peoples' => (bool) env('PLAYGROUND_CRM_API_ROUTES_PEOPLES', true),
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

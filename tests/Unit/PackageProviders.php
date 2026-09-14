<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Unit\Playground\Crm\Api;

use Laravel\Sanctum\SanctumServiceProvider;
use Playground\ServiceProvider;

/**
 * \Tests\Unit\Playground\Crm\Api\PackageProviders
 */
trait PackageProviders
{
    protected function getPackageProviders($app)
    {
        return [
            \Playground\Test\ServiceProvider::class,
            ServiceProvider::class,
            \Playground\Auth\ServiceProvider::class,
            \Playground\Http\ServiceProvider::class,
            \Playground\Crm\ServiceProvider::class,
            \Playground\Crm\Api\ServiceProvider::class,
            SanctumServiceProvider::class,
        ];
    }
}

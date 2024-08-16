<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Feature\Playground\Crm\Api;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Playground\Test\OrchestraTestCase;
use Tests\Unit\Playground\Crm\Api\PackageProviders;

/**
 * \Tests\Feature\Playground\Crm\Api\TestCase
 */
class TestCase extends OrchestraTestCase
{
    use DatabaseTransactions;
    use PackageProviders;

    /**
     * @var array<string, array<string, array<int, string>>>
     */
    protected array $load_migrations = [
        'gammamatrix' => [
            'playground-crm' => [
                // 'migrations',
            ],
        ],
    ];

    protected bool $hasMigrations = true;

    protected bool $load_migrations_laravel = false;

    protected bool $load_migrations_package = false;

    protected bool $load_migrations_playground = true;

    protected bool $setUpUserForPlayground = false;
}

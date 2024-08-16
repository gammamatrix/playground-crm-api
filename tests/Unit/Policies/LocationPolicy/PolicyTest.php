<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Unit\Playground\Crm\Api\Policies\LocationPolicy;

use PHPUnit\Framework\Attributes\CoversClass;
use Playground\Crm\Api\Policies\LocationPolicy;
use Tests\Unit\Playground\Crm\Api\TestCase;

/**
 * \Tests\Unit\Playground\Crm\Api\Policies\LocationPolicy\PolicyTest
 */
#[CoversClass(LocationPolicy::class)]
class PolicyTest extends TestCase
{
    public function test_policy_instance(): void
    {
        $instance = new LocationPolicy;

        $this->assertInstanceOf(LocationPolicy::class, $instance);
    }
}

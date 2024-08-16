<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Unit\Playground\Crm\Api\Policies\OrganizationPolicy;

use PHPUnit\Framework\Attributes\CoversClass;
use Playground\Crm\Api\Policies\OrganizationPolicy;
use Tests\Unit\Playground\Crm\Api\TestCase;

/**
 * \Tests\Unit\Playground\Crm\Api\Policies\OrganizationPolicy\PolicyTest
 */
#[CoversClass(OrganizationPolicy::class)]
class PolicyTest extends TestCase
{
    public function test_policy_instance(): void
    {
        $instance = new OrganizationPolicy;

        $this->assertInstanceOf(OrganizationPolicy::class, $instance);
    }
}

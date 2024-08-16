<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Unit\Playground\Crm\Api\Policies\ClientPolicy;

use PHPUnit\Framework\Attributes\CoversClass;
use Playground\Crm\Api\Policies\ClientPolicy;
use Tests\Unit\Playground\Crm\Api\TestCase;

/**
 * \Tests\Unit\Playground\Crm\Api\Policies\ClientPolicy\PolicyTest
 */
#[CoversClass(ClientPolicy::class)]
class PolicyTest extends TestCase
{
    public function test_policy_instance(): void
    {
        $instance = new ClientPolicy;

        $this->assertInstanceOf(ClientPolicy::class, $instance);
    }
}

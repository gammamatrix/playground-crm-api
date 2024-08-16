<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Unit\Playground\Crm\Api\Policies\ContactPolicy;

use PHPUnit\Framework\Attributes\CoversClass;
use Playground\Crm\Api\Policies\ContactPolicy;
use Tests\Unit\Playground\Crm\Api\TestCase;

/**
 * \Tests\Unit\Playground\Crm\Api\Policies\ContactPolicy\PolicyTest
 */
#[CoversClass(ContactPolicy::class)]
class PolicyTest extends TestCase
{
    public function test_policy_instance(): void
    {
        $instance = new ContactPolicy;

        $this->assertInstanceOf(ContactPolicy::class, $instance);
    }
}

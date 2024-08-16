<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Feature\Playground\Crm\Api\Http\Requests\FormRequest;

use Illuminate\Support\Facades\Auth;
use Playground\Crm\Api\Http\Requests\FormRequest;
use Playground\Models\User;
use Tests\Feature\Playground\Crm\Api\TestCase;

/**
 * \Tests\Feature\Playground\Crm\Api\Http\Requests\FormRequest\InstanceTest
 */
class InstanceTest extends TestCase
{
    protected bool $load_migrations_playground = true;

    public function test_FormRequest_authorize_with_admin(): void
    {
        /**
         * @var User $user
         */
        $user = User::factory()->admin()->create();

        Auth::setUser($user);

        $instance = new FormRequest;
        $instance->setUserResolver(function () use ($user) {
            return $user;
        });
        $this->assertTrue($instance->authorize());
    }
}

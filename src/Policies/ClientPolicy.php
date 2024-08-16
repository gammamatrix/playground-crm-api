<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Crm\Api\Policies;

use Playground\Auth\Policies\ModelPolicy;

/**
 * \Playground\Crm\Api\Policies\ClientPolicy
 */
class ClientPolicy extends ModelPolicy
{
    protected string $package = 'playground-crm-api';

    /**
     * @var array<int, string> The roles allowed to view the MVC.
     */
    protected $rolesToView = [
        'user',
        'staff',
        'publisher',
        'manager',
        'admin',
        'root',
    ];

    /**
     * @var array<int, string> The roles allowed for actions in the MVC.
     */
    protected $rolesForAction = [
        'publisher',
        'manager',
        'admin',
        'root',
    ];
}

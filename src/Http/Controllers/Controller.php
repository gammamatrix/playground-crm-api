<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Crm\Api\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Playground\PackageInfo;

/**
 * \Playground\Crm\Api\Http\Controllers\Controller
 */
abstract class Controller extends BaseController
{
    use AuthorizesRequests;
    use ValidatesRequests;
    // use DispatchesJobs;

    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'module_label' => 'CRM',
        'module_label_plural' => 'CRMS',
        'module_route' => 'playground.crm.api',
        'module_slug' => 'crm',
        'privilege' => 'playground-crm-api',
    ];

    public function packageInfo(): PackageInfo
    {
        return new PackageInfo()->setOptions($this->packageInfo);
    }
}

<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Crm\Api\Http\Requests\Location;

use Playground\Crm\Api\Http\Requests\FormRequest;

/**
 * \Playground\Crm\Api\Http\Requests\Location\LockRequest
 */
class LockRequest extends FormRequest
{
    /**
     * @var array<string, string|array<mixed>>
     */
    public const RULES = [
        '_return_url' => ['nullable', 'url'],
    ];
}

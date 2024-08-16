<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Crm\Api\Http\Requests\Contact;

use Playground\Crm\Api\Http\Requests\FormRequest;

/**
 * \Playground\Crm\Api\Http\Requests\Contact\UnlockRequest
 */
class UnlockRequest extends FormRequest
{
    /**
     * @var array<string, string|array<mixed>>
     */
    public const RULES = [
        '_return_url' => ['nullable', 'url'],
    ];
}

<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Unit\Playground\Crm\Api\Http\Requests\Contact;

use Tests\Unit\Playground\Crm\Api\Http\Requests\RequestTestCase;

/**
 * \Tests\Unit\Playground\Crm\Api\Http\Requests\Contact\LockRequestTest
 */
class LockRequestTest extends RequestTestCase
{
    protected string $requestClass = \Playground\Crm\Api\Http\Requests\Contact\LockRequest::class;
}

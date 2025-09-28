<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Unit\Playground\Crm\Api\Http\Requests\Organization;

use Playground\Crm\Api\Http\Requests\Organization\StoreRequest;
use Tests\Unit\Playground\Crm\Api\Http\Requests\RequestTestCase;

/**
 * \Tests\Unit\Playground\Crm\Api\Http\Requests\Organization\StoreRequestTest
 */
class StoreRequestTest extends RequestTestCase
{
    protected string $requestClass = StoreRequest::class;
}

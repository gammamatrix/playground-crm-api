<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Unit\Playground\Crm\Api\Http\Requests\Client;

use Playground\Crm\Api\Http\Requests\Client\StoreRequest;
use Tests\Unit\Playground\Crm\Api\Http\Requests\RequestTestCase;

/**
 * \Tests\Unit\Playground\Crm\Api\Http\Requests\Client\StoreRequestTest
 */
class StoreRequestTest extends RequestTestCase
{
    protected string $requestClass = StoreRequest::class;
}

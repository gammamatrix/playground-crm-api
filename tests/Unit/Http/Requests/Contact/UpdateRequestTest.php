<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Unit\Playground\Crm\Api\Http\Requests\Contact;

use Playground\Crm\Api\Http\Requests\Contact\UpdateRequest;
use Tests\Unit\Playground\Crm\Api\Http\Requests\RequestTestCase;

/**
 * \Tests\Unit\Playground\Crm\Api\Http\Requests\Contact\UpdateRequestTest
 */
class UpdateRequestTest extends RequestTestCase
{
    protected string $requestClass = UpdateRequest::class;
}

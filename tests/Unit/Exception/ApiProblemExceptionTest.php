<?php
declare(strict_types=1);

/**
 * ApiProblemExceptionTest
 *
 * @copyright   Copyright (c) 2020 Mike Soule
 * @license     All Rights Reserved
 * @filesource
 */

namespace ApiProblem\Test\Unit\Exception;

use ApiProblem\Exception\ApiProblemException;
use PHPUnit\Framework\TestCase;

class ApiProblemExceptionTest extends TestCase
{
    public function testCanCreateAnApiProblemException(): void
    {
        $expected = [
            'type' => 'http://example.com/not-found',
            'title' => 'Not Found',
            'status' => 404,
            'detail' => 'The resource was not found',
            'instance' => 'http://example.com/errors/1234',
        ];

        list($type, $title, $status, $detail, $instance) = array_values($expected);
        $problem = new ApiProblemException($detail, $status, [], $title, $type, $instance);
        $this->assertSame($expected, $problem->toArray());
    }
}
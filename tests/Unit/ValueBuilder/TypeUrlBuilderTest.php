<?php
declare(strict_types=1);

/**
 * TypeUrlBuilderTest
 *
 * @copyright   Copyright (c) 2020 Mike Soule
 * @license     All Rights Reserved
 * @filesource
 */

namespace ApiProblem\Test\Unit\ValueBuilder;

use ApiProblem\Exception\ApiProblemException;
use ApiProblem\ValueBuilder\TypeUrlBuilder;
use PHPUnit\Framework\TestCase;

class TypeUrlBuilderTest extends TestCase
{
    private $baseTypeUrl = 'https://apiproblem.io/problem/';

    public function setUp(): void
    {
        $builder = new TypeUrlBuilder($this->baseTypeUrl);
        ApiProblemException::setValueBuilder($builder);
    }

    /**
     * @param array $expected
     * @param int $status
     * @param string $detail
     * @dataProvider provideStatusDetail
     */
    public function testCanBuildTypeUrls(array $expected, int $status, string $detail): void
    {
        $problem = new ApiProblemException($detail, $status);
        $this->assertSame($expected, $problem->toArray());
    }

    public function provideStatusDetail(): \Generator
    {
        yield 'bad-request' => [
            [
                'type' => $this->baseTypeUrl . '400',
                'title' => 'Bad Request',
                'status' => 400,
                'detail' => 'Invalid request data',
            ],
            400,
            'Invalid request data',
        ];

        yield 'not-found' => [
            [
                'type' => $this->baseTypeUrl . '404',
                'title' => 'Not Found',
                'status' => 404,
                'detail' => 'The resource was not found',
            ],
            404,
            'The resource was not found',
        ];

        yield 'server-error' => [
            [
                'type' => $this->baseTypeUrl . '500',
                'title' => 'Internal Server Error',
                'status' => 500,
                'detail' => 'The server failed to process the request',
            ],
            500,
            'The server failed to process the request',
        ];
    }
}

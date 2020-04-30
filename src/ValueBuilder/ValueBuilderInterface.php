<?php
declare(strict_types=1);

/**
 * An interface for internally setting ApiProblemException values.
 *
 * @copyright   Copyright (c) 2020 Mike Soule
 * @license     All Rights Reserved
 * @filesource
 */

namespace ApiProblem\ValueBuilder;

use ApiProblem\Exception\ApiProblemException;

interface ValueBuilderInterface
{
    public function build(ApiProblemException $problem): void;
}
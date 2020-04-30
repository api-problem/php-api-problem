<?php
declare(strict_types=1);

/**
 * Sets the problem type as a URL to the corresponding HTTP status code in Wikipedia
 *
 * @copyright   Copyright (c) 2020 Mike Soule
 * @license     All Rights Reserved
 * @filesource
 */

namespace ApiProblem\ValueBuilder;


use ApiProblem\Exception\ApiProblemException;

class TypeUrlBuilder extends BasicValueBuilder implements ValueBuilderInterface
{
    protected $baseTypeUrl = 'https://en.wikipedia.org/wiki/List_of_HTTP_status_codes#';

    public function __construct(string $baseTypeUrl = 'https://en.wikipedia.org/wiki/List_of_HTTP_status_codes#')
    {
        $this->baseTypeUrl = $baseTypeUrl;
    }

    public function build(ApiProblemException $problem): void
    {
        parent::build($problem);

        if (!$type = $problem->getType() and $status = $problem->getStatus()) {
            $type = $this->baseTypeUrl . $status;
            $problem->setType($type);
        }
    }

}
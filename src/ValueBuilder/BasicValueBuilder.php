<?php
declare(strict_types=1);

/**
 * Ensures minimal problem values are set.
 *
 * @copyright   Copyright (c) 2020 Mike Soule
 * @license     All Rights Reserved
 * @filesource
 */

namespace ApiProblem\ValueBuilder;

use ApiProblem\ApiProblemStatus;
use ApiProblem\Exception\ApiProblemException;

class BasicValueBuilder implements ValueBuilderInterface
{
    protected $statusTitles = [
        ApiProblemStatus::BAD_REQUEST => 'Bad Request',
        ApiProblemStatus::UNAUTHORIZED => 'Unauthorized',
        ApiProblemStatus::PAYMENT_REQUIRED => 'Payment Required',
        ApiProblemStatus::FORBIDDEN => 'Forbidden',
        ApiProblemStatus::NOT_FOUND => 'Not Found',
        ApiProblemStatus::METHOD_NOT_ALLOWED => 'Method Not Allowed',
        ApiProblemStatus::NOT_ACCEPTABLE => 'Not Acceptable',
        ApiProblemStatus::PROXY_AUTHENTICATION_REQUIRED => 'Proxy Authentication Required',
        ApiProblemStatus::REQUEST_TIMEOUT => 'Request Timeout',
        ApiProblemStatus::CONFLICT => 'Conflict',
        ApiProblemStatus::GONE => 'Gone',
        ApiProblemStatus::LENGTH_REQUIRED => 'Length Required',
        ApiProblemStatus::PRECONDITION_FAILED => 'Precondition Failed',
        ApiProblemStatus::PAYLOAD_TOO_LARGE => 'Payload Too Large',
        ApiProblemStatus::URI_TOO_LONG => 'URI Too Long',
        ApiProblemStatus::UNSUPPORTED_MEDIA_TYPE => 'Unsupported Media Type',
        ApiProblemStatus::RANGE_NOT_SATISFIABLE => 'Range Not Satisfiable',
        ApiProblemStatus::EXPECTATION_FAILED => 'Expectation Failed',
        ApiProblemStatus::IM_A_TEAPOT => 'I\'m a Teapot',
        ApiProblemStatus::MISDIRECTED_REQUEST => 'Misdirected Request',
        ApiProblemStatus::UNPROCESSABLE_ENTITY => 'Unprocessable Entity',
        ApiProblemStatus::LOCKED => 'Locked',
        ApiProblemStatus::FAILED_DEPENDENCY => 'Failed Dependency',
        ApiProblemStatus::TOO_EARLY => 'Too Early',
        ApiProblemStatus::UPGRADE_REQUIRED => 'Upgrade Required',
        ApiProblemStatus::UNASSIGNED	 => 'Unassigned	',
        ApiProblemStatus::PRECONDITION_REQUIRED => 'Precondition Required',
        ApiProblemStatus::TOO_MANY_REQUESTS => 'Too Many Requests',
        ApiProblemStatus::REQUEST_HEADER_FIELDS_TOO_LARGE => 'Request Header Fields Too Large',
        ApiProblemStatus::UNAVAILABLE_FOR_LEGAL_REASONS => 'Unavailable For Legal Reasons',
        ApiProblemStatus::INTERNAL_SERVER_ERROR => 'Internal Server Error',
        ApiProblemStatus::NOT_IMPLEMENTED => 'Not Implemented',
        ApiProblemStatus::BAD_GATEWAY => 'Bad Gateway',
        ApiProblemStatus::SERVICE_UNAVAILABLE => 'Service Unavailable',
        ApiProblemStatus::GATEWAY_TIMEOUT => 'Gateway Timeout',
        ApiProblemStatus::HTTP_VERSION_NOT_SUPPORTED => 'HTTP Version Not Supported',
        ApiProblemStatus::VARIANT_ALSO_NEGOTIATES => 'Variant Also Negotiates',
        ApiProblemStatus::INSUFFICIENT_STORAGE => 'Insufficient Storage',
        ApiProblemStatus::LOOP_DETECTED => 'Loop Detected',
        ApiProblemStatus::NETWORK_AUTHENTICATION_REQUIRED => 'Network Authentication Required',
    ];

    public function build(ApiProblemException $problem): void
    {
        if (!$title = $problem->getTitle()) {
            $title = $this->statusTitles[$problem->getStatus()] ?? '';
            $problem->setTitle($title);
        }
    }
}

<?php
declare(strict_types=1);

/**
 * ApiProblemException
 *
 * @copyright   Copyright (c) 2020 Mike Soule
 * @license     All Rights Reserved
 * @filesource
 */

namespace ApiProblem\Exception;

use ApiProblem\ValueBuilder\BasicValueBuilder;
use ApiProblem\ValueBuilder\ValueBuilderInterface;

class ApiProblemException extends \Exception implements \JsonSerializable
{
    private $type = '';
    private $title = '';
    private $status = 0;
    private $detail = '';
    private $instance = '';
    private $extensions = [];
    private static $valueBuilder;

    public function __construct(
        string $detail,
        int $status = 0,
        array $extensions = [],
        string $title = '',
        string $type = '',
        string $instance = ''
    ) {
        $this->detail = $detail;
        $this->status = $status;
        $this->type = $type;
        $this->instance = $instance;
        $this->title = $title;
        $this->setExtensions($extensions);
        $builder = $this->getValueBuilder();
        $builder->build($this);

        $message = $this->detail ?? $this->title;
        parent::__construct($message, $status);
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setDetail(string $detail): self
    {
        $this->detail = $detail;
        return $this;
    }

    public function getDetail(): string
    {
        return $this->detail;
    }

    public function setInstance(string $instance): self
    {
        $this->instance = $instance;
        return $this;
    }

    public function getInstance(): string
    {
        return $this->instance;
    }

    final public function setExtensions(array $extensions): self
    {
        $disallowed = ['type', 'title', 'status', 'detail', 'instance', 'extensions'];

        foreach ($extensions as $key => $val) {
            if ($key and is_string($key) and !in_array(strtolower($key), $disallowed)) {
                $this->extensions[$key] = $val;
            }
        }

        return $this;
    }

    public function getExtensions(): array
    {
        return $this->extensions;
    }

    public function toArray(): array
    {
        $data = [
            'type' => $this->type,
            'title' => $this->title,
            'status' => $this->status,
        ];

        $this->detail and $data['detail'] = $this->detail;
        $this->instance and $data['instance'] = $this->instance;

        foreach ($this->extensions as $key => $val) {
            $data[$key] = $val;
        }

        return $data;
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    final public static function setValueBuilder(ValueBuilderInterface $valueBuilder): void
    {
        self::$valueBuilder = $valueBuilder;
    }

    private function getValueBuilder(): ValueBuilderInterface
    {
        if (!self::$valueBuilder) {
            self::$valueBuilder = new BasicValueBuilder();
        }

        return self::$valueBuilder;
    }
}

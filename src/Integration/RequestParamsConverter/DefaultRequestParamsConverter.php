<?php

namespace src\Integration\RequestParamsConverter;

class DefaultRequestParamsConverter implements RequestParamsConverterInterface
{
    /** @var int */
    protected $limit;
    /** @var int */
    protected $offset;

    public function __construct(int $limit, int $offset)
    {
        $this->limit = $limit;
        $this->offset = $offset;
    }

    public function getParams(): array
    {
        return [
            'limit' => $this->limit,
            'offset' => $this->offset,
        ];
    }
}
<?php

namespace src\Integration\RequestParamsConverter;

/**
 * Holds and returns service-specific conditions (infrastructure level)
 *
 * Interface RequestParamsConverterInterface
 */
interface RequestParamsConverterInterface
{

    /**
     * @return array
     */
    public function getParams(): array;
}
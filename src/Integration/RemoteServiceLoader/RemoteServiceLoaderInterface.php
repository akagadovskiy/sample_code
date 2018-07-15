<?php

namespace src\Integration\RemoteServiceLoader;

use src\Integration\RequestParamsConverter\RequestParamsConverterInterface;

interface RemoteServiceLoaderInterface
{
    /**
     * Gets data from remote service
     *
     * @param RequestParamsConverterInterface $rp
     * @return array
     */
    public function loadData(RequestParamsConverterInterface $rp): array;

}
<?php

namespace src\Integration\Test;

use Cache\Adapter\PHPArray\ArrayCachePool;
use src\Integration\DataProviderWithCache;
use src\Integration\RemoteServiceLoader\CandyLoader;
use src\Integration\DataProvider;
use src\Integration\DataTransformer\CandyDataTransformer;
use src\Integration\RemoteServiceLoader\CandyLoaderMutable;
use src\Integration\RequestParamsConverter\DefaultRequestParamsConverter;

class BasicTest
{

    public function candyDataProviderTest()
    {

        $candyLoader = new CandyLoader('http://yourlocalcandydealer.com/api/v1', 'CandyFairy', 'GIVEMEMYCHOCOLATE!!!11');

        $dataProvider = new DataProvider($candyLoader, new CandyDataTransformer());

        $params = new DefaultRequestParamsConverter(3, 1);
        $data = $dataProvider->get($params);

        var_dump($data);
    }

    public function candyDataProviderWithCacheTest()
    {

        $candyLoader = new CandyLoaderMutable('http://yourlocalcandydealer.com/api/v1', 'CandyFairy', '***');

        $cache = new ArrayCachePool();
        $dataProviderWithCache = new DataProviderWithCache($candyLoader, new CandyDataTransformer(), $cache);

        $params = new DefaultRequestParamsConverter(3, 1);
        $originalData = $dataProviderWithCache->get($params);
        $dataFromCache = $dataProviderWithCache->get($params);

        $this->assertEqual($originalData, $dataFromCache);
    }


    private function assertEqual($a, $b)
    {
        if ($a !== $b) {
            throw new \Exception("Values expected to be equal");
        }
    }
}
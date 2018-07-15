<?php

namespace src\Integration;

use Exception;
use DateTime;
use Cache\Adapter\Common\Exception\CacheException;
use Psr\Cache\InvalidArgumentException;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LogLevel;
use src\Integration\DataTransformer\DataTransformerInterface;
use src\Integration\RemoteServiceLoader\RemoteServiceLoaderInterface;
use src\Integration\RequestParamsConverter\RequestParamsConverterInterface;

class DataProviderWithCache extends DataProvider
{
    /** @var CacheItemPoolInterface */
    protected $cache;
    /** @var DateTime */
    protected $expiresAt;


    public function __construct(RemoteServiceLoaderInterface $loader, DataTransformerInterface $transformer, CacheItemPoolInterface $cache)
    {
        parent::__construct($loader, $transformer);
        $this->expiresAt = (new DateTime())->modify('+1 day');
        $this->cache = $cache;
    }

    /**
     * Optional dependency
     *
     * @param DateTime $expiresAt
     */
    public function setExpiresAt(DateTime $expiresAt)
    {
        $this->expiresAt = $expiresAt;
    }

    /**
     * @param RequestParamsConverterInterface $params
     * @return array
     */
    public function get(RequestParamsConverterInterface $params): array
    {
        $data = [];
        try {
            $cacheKey = $this->getCacheKey($params);
            $cacheItem = $this->cache->getItem($cacheKey);

            if ($cacheItem->isHit()) {
                return $cacheItem->get();
            }

            $data = parent::get($params);
            $cacheItem
                ->set($data)
                ->expiresAt($this->expiresAt);
            $this->cache->save($cacheItem);
            return $data;

        } catch (InvalidArgumentException $e) {
            $this->log(LogLevel::WARNING, $e->getMessage());
            return parent::get($params);
        } catch (CacheException $e) {
            $this->log(LogLevel::WARNING, $e->getMessage());
            return parent::get($params);
        } catch (Exception $e) {
            $this->log(LogLevel::CRITICAL, $e->getMessage());
            return $data;
        }
    }

    protected function getCacheKey(RequestParamsConverterInterface $params)
    {
        return md5(serialize($params));
    }
}
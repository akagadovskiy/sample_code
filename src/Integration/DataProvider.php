<?php

namespace src\Integration;

use Exception;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use src\Integration\DataItem\DataItemInterface;
use src\Integration\DataTransformer\DataTransformerInterface;
use src\Integration\RemoteServiceLoader\RemoteServiceLoaderInterface;
use src\Integration\RequestParamsConverter\RequestParamsConverterInterface;

class DataProvider
{
    /** @var RemoteServiceLoaderInterface */
    protected $loader;
    /** @var RequestParamsConverterInterface */
    protected $transformer;
    /** @var LoggerInterface */
    protected $logger;


    public function __construct(RemoteServiceLoaderInterface $loader, DataTransformerInterface $transformer)
    {
        $this->loader = $loader;
        $this->transformer = $transformer;
    }

    /**
     * Optional dependency
     *
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param RequestParamsConverterInterface $params
     * @return DataItemInterface[]
     */
    public function get(RequestParamsConverterInterface $params): array
    {
        try {
            $rawData = $this->loader->loadData($params);

            return $this->transformer->transform($rawData);
        } catch (Exception $e) {
            $this->log(LogLevel::CRITICAL, $e->getMessage());
        }
    }

    protected function log($level, $message)
    {
        if ($this->logger) {
            $this->logger->log($level, $message);
        }
    }
}

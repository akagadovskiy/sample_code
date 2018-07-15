<?php

namespace src\Integration\RemoteServiceLoader;

use src\Integration\RequestParamsConverter\RequestParamsConverterInterface;

class CandyLoaderMutable implements RemoteServiceLoaderInterface
{
    private $host;
    private $user;
    private $password;

    private $isCalledPreviously = false;

    /**
     * @param $host
     * @param $user
     * @param $password
     */
    public function __construct(string $host, string $user, string $password)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
    }

    public function loadData(RequestParamsConverterInterface $rp): array
    {
        // mocking a remote service

        if ($this->isCalledPreviously) {
            return [
                ['0', 'There are no candies ', '0'],
            ];
        }

        $params = $rp->getParams();

        $data = [
            ['1', 'Snickers', '0.241'],
            ['2', 'Twix', '0.88'],
            ['3', 'Kit Kat', '0.22'],
            ['4', 'Korovka', '0.73'],
            ['5', 'Alpen Gold', '0.73'],
        ];

        $this->isCalledPreviously = true;

        return array_slice($data, $params['offset'], $params['limit']);
    }
}

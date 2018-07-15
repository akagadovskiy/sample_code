<?php

require_once './vendor/autoload.php';


$a = new \src\Integration\Test\BasicTest();

$a->candyDataProviderTest();

$a->candyDataProviderWithCacheTest();
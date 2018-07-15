<?php

namespace src\Integration\DataTransformer;

use src\Integration\DataItem\DataItemInterface;

interface DataTransformerInterface
{

    /**
     * Transform data from remote service into
     * data object
     * TODO: implement collection class to have an ability to set a specific return type instead of array
     *
     * @param array $data
     * @return DataItemInterface[]
     */
    public function transform(array $data): array;

}
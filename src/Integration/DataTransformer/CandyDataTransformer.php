<?php

namespace src\Integration\DataTransformer;

use src\Integration\DataItem\CandyItem;

class CandyDataTransformer implements DataTransformerInterface
{
    /**
     * @param CandyItem[] $data
     * @return array
     */
    public function transform(array $data): array
    {
        $result = [];

        foreach ($data as $item) {
            $result[] = new CandyItem($item[0], $item[1], $item[2]);
        }

        return $result;
    }
}
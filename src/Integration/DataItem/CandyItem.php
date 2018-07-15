<?php

namespace src\Integration\DataItem;

class CandyItem implements DataItemInterface
{
    /** @var int */
    private $id;
    /** @var string */
    private $name;
    /** @var float */
    private $sugarAmount;


    /**
     * CandyItem constructor.
     * @param int $id
     * @param string $name
     * @param float $sugarAmount
     */
    public function __construct($id, $name, $sugarAmount)
    {
        $this->id = (int) $id;
        $this->name = (string) $name;
        $this->sugarAmount = (float) $sugarAmount;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getSugarAmount()
    {
        return $this->sugarAmount;
    }

}
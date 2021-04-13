<?php

namespace App\Items;
require_once 'App/Items/AbstractItem.php';

class UnitItem extends AbstractItem{
    protected $qnt;
    protected $unitPrice;
    protected $netCost;

    public function __construct(float $qnt,float $unitPrice, float $netCost) {
        parent::__construct($qnt, $unitPrice, $netCost);
    }
    public function calcItemCost(float $qnt, float $unitPrice): float {
       return ($qnt * $unitPrice);
    }
}

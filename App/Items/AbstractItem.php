<?php

namespace App\Items;

abstract class AbstractItem {
    protected $qnt;
    protected $unitPrice;
    protected $netCost;

    function __construct(float $qnt,float $unitPrice, $netCost){
        $this->qnt = $qnt;
        $this->unitPrice = $unitPrice;
        $this->netCost = $netCost;
    }
    /* данный метод должен быть переопределен в дочернем классе */
    abstract protected function calcItemCost(float $qnt, float $unitPrice): float;
    /* общий метод */
    public function calcProfit(float $qnt, float $unitPrice, float $netCost) {
        return ($this->calcItemCost($qnt, $unitPrice) - $netCost*$qnt);
    }
}
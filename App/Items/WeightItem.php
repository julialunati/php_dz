<?php

namespace App\Items;
require_once 'App/Items/AbstractItem.php';

class WeightItem extends AbstractItem{
    protected $qnt;
    protected $unitPrice;
    protected $netCost;

    public function __construct(float $qnt, float $unitPrice, float $netCost) {
        parent::__construct($qnt, $unitPrice, $netCost);
    }

    public function calcItemCost(float $qnt, float $unitPrice): float {
        // например при заказе до 2.5 килограмм - обычная цена, при заказе от 2.5 до 20 - небольшая скидка, при заказе от 20 килограмм - оптовая цена
        if($qnt < 2.5){
            return $unitPrice*1 * $qnt;
        }elseif($qnt >= 2.5 && $qnt <= 20){
            return ($unitPrice * 0.9 * $qnt);
        }else{
            return ($unitPrice * 0.8 * $qnt);
        } 
    }
}

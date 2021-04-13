<?php

namespace App\Items;
require_once 'App/Items/AbstractItem.php';

class DigitalItem extends AbstractItem{
    protected $qnt;
    protected $unitPrice;
    protected $netCost;

    public function __construct(float $qnt,float $unitPrice, float $netCost) {
        parent::__construct($qnt, $unitPrice, $netCost);
    }

    public function calcItemCost(float $qnt, float $unitPrice): float {
        // так как в задание указано "у цифрового товара стоимость постоянная – дешевле единицы штучного товара в два раза"
        //то изменим цену 
        return ($qnt * $unitPrice/2);
     }
  
}
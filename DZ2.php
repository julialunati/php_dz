<?php

//namespace App\Items;

/* 1. Создать структуру классов ведения товарной номенклатуры.
а) Есть абстрактный товар (абстрактный класс, который вы будете наследовать для всех видов товаров)
б) Есть цифровой товар, штучный физический товар и товар на вес (еще три класса)
в) У каждого есть метод подсчета финальной стоимости в зависимости от количества.
г) У цифрового товара стоимость постоянная – дешевле единицы штучного товара в два раза. 
У штучного товара обычная стоимость (стоимость единицы умножить на количество), 
у весового – в зависимости от продаваемого количества в килограммах 
(например при заказе до 2.5 килограмм - обычная цена, при заказе от 2.5 до 20 - небольшая скидка, при заказе от 20 килограмм - оптовая цена). 
У всех товаров присутствует также метод (function) расчета прибыли 
- прибыль считается как разница от финальной цены и себестоимости товара (себестоимость единицы товара - постоянная величина).
д) Что можно вынести в абстрактный класс, наследование?
*/

require_once "App/Items/UnitItem.php";
require_once "App/Items/DigitalItem.php";
require_once "App/Items/WeightItem.php";

use App\Items as AppItem;

$p = new AppItem\UnitItem(5, 120.10, 40);
echo $p->calcItemCost(5, 120.10);
echo $p->calcProfit(5, 120.10, 40);
echo "<br>";

$p2 = new AppItem\DigitalItem(5, 120.10, 40);
echo $p2->calcItemCost(5, 120.10);
echo $p2->calcProfit(5, 120.10, 40);
echo "<br>";

$p3 = new AppItem\WeightItem(5, 120.10, 40);
echo $p3->calcItemCost(5, 120.10);
echo $p3->calcProfit(5, 120.10, 40);
echo "<br>";

// 2. *Реализовать паттерн Singleton при помощи traits.

//создаем SingletonTrait c помощью trait

trait SingletonTrait{
	private static $instance;

	public static function getInstance(){
		if (empty(self::$instance)) self::$instance = new static();
		return self::$instance;
	}
	private function __construct(){/* ... @return Singleton */ }
	private function __clone(){/* ... @return Singleton */ }
	private function __wakeup(){/* ... @return Singleton */ }
}

//создаем новый класс 
class MyClass{
    use SingletonTrait;
    private $var = [];

	public function addVar($v){
		$this->var[] = $v;
	}

	public function getVar(){
		return $this->var;
	}    
}

// получаем единственный экземпляр класса 
 
$obj = MyClass::getInstance();

 /* если попытаться создать MyClass с помощью new 
  $io = new MyClass();
  выскочить php-ошибка (Error: Call to private MyClass::__construct()) 
  — так создавать класс синглтона запрещено (потому что приватный конструктор). 
  Также не получится его клонировать.
  */

$obj->addVar('first');
$obj->addVar('second');

var_dump($obj->getVar());

// эксперементируем со вторым объектом 
$obj2 = MyClass::getInstance();
var_dump($obj2->getVar());
$obj2->addVar('new value');
// убеждаемся что объекты идентичны 
var_dump($obj->getVar());
var_dump($obj2->getVar());
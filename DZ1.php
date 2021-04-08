<?php

// для вывода ошибок 
declare(strict_types=1);

ini_set('error_reporting', (string)E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

//  1. Придумать класс, который описывает любую сущность из предметной области интернет-магазинов
// 2. Описать свойства класса из п.1 (состояние).
// 3. Описать поведение класса из п.1 (методы).

class Product 
{
    // свойства класса 
    protected $itemCode;
    protected $itemName;
    protected $itemColor;

    // методы класса 
    public function __construct(string $code, string $name, string $color)
    {
        $this->itemCode = $code;
        $this->itemName = $name;
        $this->itemColor = $color;
    } 

    public function getItemCode() : string
    {
        return $this->itemCode;
    }
    public function getItemName() : string
    {
        return $this->itemName;
    }
    public function getItemColor() : string
    {
        return $this->itemColor;
    }
}

$p = new Product("M9121C4Z2-Q11", "Dress", "black");
echo $p->getItemCode() . "<br>";
echo $p->getItemName() . "<br>";
echo $p->getItemColor() . "<br>";

// 4. Придумать наследников класса из п.1. Чем они будут отличаться?
// создадим класс косметики у которой есть четкий срок годности (у одежды его нет)

class Cosmetics extends Product {

    private $expirationDate;

    public function __construct(string $code, string $name, string $color, string $date)
    {
        // вызов конструктора родительского класа
        parent::__construct($code, $name, $color);
        $this->expirationDate = $date;
    } 

    public function getItemExpirationDate() : string
    {
        return $this->expirationDate;
    }
}

$c = new Cosmetics("AV931H00J-S11", "Shampoo", "white", "12/12/2022");
echo $c->getItemCode() . "<br>";
echo $c->getItemName() . "<br>";
echo $c->getItemColor() . "<br>";
echo $c->getItemExpirationDate() . "<br>";

// создадим класс ювелирного изделия у которой есть проба металла (у одежды и у косметики его нет)

class Jewelry extends Product {

    private $metalHallmark;

    public function __construct(string $code, string $name, string $color, string $hallmark)
    {
        // вызов конструктора родительского класа
        parent::__construct($code, $name, $color);
        $this->metalHallmark = $hallmark;
    } 

    public function getMetallHallmark() : string
    {
        return $this->metalHallmark;
    }
}

$c = new Jewelry("EL051L0CA-D11", "Necklace", "silver", "925");
echo $c->getItemCode() . "<br>";
echo $c->getItemName() . "<br>";
echo $c->getItemColor() . "<br>";
echo $c->getMetallHallmark() . "<br>";



// Ключевое слово static, написанное перед присваиванием значения локальной переменной, приводит к следующим эффектам:
// - Присваивание выполняется только один раз, при первом вызове функции
// - Значение помеченной таким образом переменной сохраняется после окончания работы функции
// - При последующих вызовах функции вместо присваивания переменная получает сохраненное ранее значение


//5. Дан код: Что он выведет на каждом шаге? Почему?
// данный код выводит 1234 
// метод будет существовать лишь в одном экземпляре, 
// просто при каждом вызове в него будет пробрасываться разный $this.

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A();
$a2 = new A();
$a1->foo(); //1
$a2->foo(); //2
$a1->foo(); //3
$a2->foo(); //4


//6. Объясните результаты в этом случае.
// данный код выводит 1122 
// наследование класса приводит к тому, что всё-таки создается новый метод соответсвенно отрабатывает два раза

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A();
$b1 = new B();
$a1->foo(); //1
$b1->foo(); //1
$a1->foo(); //2
$b1->foo(); //2

// ВЫВОД динамические методы в PHP существуют в контексте классов, а не объектов


//7. *Дан код: Что он выведет на каждом шаге? Почему?
// Код отработатет также, но по правилам хорошего тона важно указыать скобки при создании нового объекта 
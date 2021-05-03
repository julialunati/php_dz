<?php

namespace Project\Product\Controller;

require_once 'config.php';

use PHPUnit\Framework\TestCase;
use Project\Product\Controller\Product;

class ProductTest extends TestCase
{

    private $object;

    protected function setUp(): void
    {
        $this->object = new Product([]);
    }

    public function testIndexAction()
    {
        $this->expectOutputString("hello!");
        $this->object->indexAction();
    }

    public function testNoIdProductAction()
    {

        unset($_GET['id']);
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('No id!');
        $this->object->productAction();
    }

    public function testIdEmptyProductAction()
    {
        $_GET['id'] = 0;
        $this->expectOutputRegex('*Product id cannot be zero*');
        $this->object->ProductAction();
    }

    public function testNoSuchProductAction()
    {
        $_GET['id'] = 123456789123456789;
        $this->expectOutputRegex('*Product not found*');
        $this->object->productAction();
    }

}

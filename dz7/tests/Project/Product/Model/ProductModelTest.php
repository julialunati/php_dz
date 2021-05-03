<?php

namespace Project\Product\Model;

require_once 'config.php';

use PHPUnit\Framework\TestCase;
use Project\Product\Model\ProductModel;


class ProductModelTest extends TestCase
{
    private $object;

    protected function setUp(): void
    {
        $this->object = new ProductModel();
    }

    public function testIsObject()
    {
        $this->assertIsObject($this->object);
    }

    private function mockDatabase($returnFetch)
    {
        $query = $this->getMockBuilder(\PDOStatement::class)->getMock();
        $query->method('bindValue')->willReturn(true);
        $query->method('execute')->willReturn(true);
        $query->method('fetch')->willReturn($returnFetch);

        $pdoMock = $this->getMockBuilder(\PDO::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['prepare'])
            ->getMock();
        $pdoMock->method('prepare')->willReturn($query);
        $reflection = new \ReflectionClass($this->object);
        $reflectionProperty = $reflection->getProperty('db');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->object, $pdoMock);
    }

    public function testDirectoryExists(): void
    {
        $this->assertDirectoryExists('./foto/');
    }

    /**
     * @dataProvider providerProduct
     */

    public function testProductPictureExists($productData): void
    {
        $path = $productData['path'];
        $this->assertFileExists("./$path");
    }

    /**
     * @dataProvider providerProduct
     */
    public function testNonExistingGetProductExists(): void
    {
        $this->mockDatabase(null);
        $this->assertFalse(
            $this->object->getProductExists(0)
        );
    }

    /**
     * @dataProvider providerProduct
     */
    public function testGetProductExists($productData): void
    {
        $this->mockDatabase($productData);
        $this->assertTrue(
            $this->object->getProductExists($productData['id'])
        );
    }

    /**
     * @dataProvider providerProduct
     */
    public function testGetProductData($productData): void
    {
        $this->mockDatabase($productData);
        $this->assertEquals(
            $productData,
            $this->object->getById($productData['id'])->getData()
        );
        $this->assertGreaterThan(
            0,
            $this->object->getById($productData['id'])->getData('price')
        );

        $this->assertIsString($this->object->getById($productData['id'])->getData('name'));

    }

    public function providerProduct()
    {
        return [
            [
                ['id' => 1, 'path' => 'foto/ring1.jpg', 'name' => 'Pearl', 'price' => 287.45],
            ],
            [
                ['id' => 2, 'path' => 'foto/ring2.jpg', 'name' => 'Mosca', 'price' => 210.23],
            ]
        ];
    }
}

<?php

namespace Project\Product\Model;

use Project\Core\Model\AbstractModel;

use function PHPUnit\Framework\throwException;

class ProductModel extends AbstractModel
{
    public $tableName = 'products';

    public function getProductData(array $arr) : array
    {
      return $this->getByAttribute($arr)->getData();
    }

    public function getProductExists(int $id) : bool
    {
        return !empty($this->getById($id)->getData('id'));
    }

}

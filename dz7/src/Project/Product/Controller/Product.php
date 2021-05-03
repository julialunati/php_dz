<?php

namespace Project\Product\Controller;

use Project\Core\Controller\AbstractController;
use Project\Product\Model\ProductModel;
use Project\Product\View\ProductView;

class Product extends AbstractController
{
    public function indexAction()
    {
        echo "hello!";
    }

    public function productAction()
    {
        if (!isset($_GET['id'])) {
            throw new \Exception("No id!");
        }
        $prodId['id'] = $_GET['id'];
        $view = new ProductView();
        if (!$prodId['id']) {
            $view->setData(['message' => 'Product id cannot be zero'])->show();
            return;
        }
        $prodObj = new ProductModel();
        $prodData = $prodObj->getProductExists($prodId['id']) ? $prodObj->getProductData($prodId) : null;
        $view
            ->setData(
                [
                    'product' => $prodData,
                    'message' => 'Product not found'
                ]
            )
            ->show();
    }
}

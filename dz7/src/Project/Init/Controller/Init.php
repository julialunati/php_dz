<?php

namespace Project\Init\Controller;

use Project\Core\Controller\AbstractController;
use Project\Init\Model\ProductCollection;
use Project\Init\View\InitView;


class Init extends AbstractController
{
    public function indexAction()
    {
        //отображение начальной страницы
        $view = new InitView();
        $allProducts = new ProductCollection();
        $view
            ->setData(
                [
                    'products' => $allProducts->getAll()->getArray()
                ]
            )
            ->show();
    }

}

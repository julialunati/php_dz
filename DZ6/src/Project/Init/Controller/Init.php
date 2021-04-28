<?php

namespace Project\Init\Controller;

use Project\Core\Controller\AbstractController;
use Project\Init\View\InitView;


class Init extends AbstractController
{
    public function indexAction()
    {
        //отображение начальной страницы
        $view = new InitView();
        $view->show();
    }

    //дальнейшая логика отображения товаров на начальной странице 
}

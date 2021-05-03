<?php

namespace Project\Product\View;

use Project\Core\View\AbstractView;

class ProductView extends AbstractView
{
    protected $template = 'product.phtml';

    /**
     * Get the value of template
     */ 
    public function getTemplate()
    {
        return $this->template;
    }
}
<?php

namespace Application\Controller;

class Error extends \Application\Core\Controller
{
    public function error404() : void
    {
        echo $this->render('404');
    }
}
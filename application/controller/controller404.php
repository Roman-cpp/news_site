<?php

namespace Application\Controller;

class Controller404
{
    public function Draw() : void
    {
        include 'application/views/404.php';
    }
}
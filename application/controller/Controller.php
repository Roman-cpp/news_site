<?php
namespace Application\Controller;

class Controller
{
    public static function UrlProcessing($url, $path): void
    {
        if(array_key_exists($url, $path))
            (new $path[$url])->Draw();
        else
            (new Controller404())->Draw();
    }
}
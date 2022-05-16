<?php

namespace Application\Core;

class Controller
{
    protected function render(string $tmpl, array $params = []): string
    {
        ob_start();
        extract($params);
        require 'application/views/' . $tmpl . '.php';
        return ob_get_clean();
    }
}
<?php
use Application\Core\Routes;
spl_autoload_register();
require 'config.php';
require 'routing.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$segments = explode('/', trim($uri, '/'));

(new Routes)->routeProcessing(ROUTES, $segments);

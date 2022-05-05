<?php
namespace Application\Controller;
include 'application/models/path.php';
spl_autoload_register();

Controller::UrlProcessing(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), $paths);

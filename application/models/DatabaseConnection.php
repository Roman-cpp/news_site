<?php

namespace Application\Models;
use mysqli;

class DatabaseConnection
{
    private static string $server_name = "localhost";
    private static string $user_name = "root";
    private static string $password = "";
    private static string $database_name = "news_site";
    private static int $port = 3306;

    protected static mysqli $db_connect;


    protected static function DbConnect(): void
    {
        self::$db_connect = new mysqli(self::$server_name, self::$user_name, self::$password, self::$database_name, self::$port);
        if (self::$db_connect->connect_error)
            die("Connection failed: " . self::$db_connect->connect_error);
    }
}
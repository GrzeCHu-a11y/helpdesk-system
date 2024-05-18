<?php
class Config
{
    public static $host = "localhost";
    public static $user = "admin";
    public static $pass = "admin";
    public static $db = "helpdesk_system";

    public static $charset = 'utf8mb4';
    public static $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    public static $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
}

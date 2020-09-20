<?php
namespace framework;

/**
 * Class PDOSingleton
 * @package framework
 */
class PDOSingleton
{

    /**
     * @var \PDO|null $instance
     */
    private static ?\PDO $instance = null;

    /**
     * PDOSingleton constructor.
     */
    private function __construct()
    {
        self::$instance = new \PDO(
            'mysql:dbname=' . Config::get('DB_NAME') . ';host=' . Config::get('DB_HOST') . ';port=' . Config::get('DB_PORT'),
            Config::get('DB_USER'),
            Config::get('DB_PASS')
        );
        self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @return \PDO
     */
    public static function getInstance(): \PDO
    {
        if (!self::$instance) {
            new PDOSingleton();
        }

        return self::$instance;
    }
}

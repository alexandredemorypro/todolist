<?php
namespace framework;

/**
 * Class Config
 * @package framework
 */
class Config
{
    const CONFIG = [
        'DB_HOST' => '127.0.0.1',
        'DB_USER' => 'medialis',
        'DB_PASS' => 'medialis0password0!',
        'DB_NAME' => 'todolist',
        'DB_PORT' => '3307',
    ];

    /**
     * @param string $name
     * @return string
     */
    public static function get(string $name): string
    {
        return self::CONFIG[$name];
    }
}

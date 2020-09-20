<?php
namespace framework;

/**
 * Class AutoLoader
 * @package framework
 */
class AutoLoader
{

    /**
     * AutoLoader constructor.
     */
    public function __construct()
    {
        spl_autoload_register(['framework\Autoloader', 'loader']);
    }

    /**
     * @param string $className
     */
    public static function loader(string $className): void
    {
        $root = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR;
        if (file_exists($root . $className . '.php')) {
            require_once $root . $className . '.php';
        }
    }
}

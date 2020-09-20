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
        $filePath = str_replace("\\", "/", $root . $className . '.php');
        if (file_exists($filePath)) {
            require_once $filePath;
        }
    }
}

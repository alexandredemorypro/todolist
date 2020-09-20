<?php
namespace framework;

/**
 * Class Api
 * @package framework
 */
class Api
{
    public function __construct() { }

    public function run(): void {
        $request = new \framework\Request();
        $router = \framework\Router::getInstance();
        $router->resolve($request);
    }
}

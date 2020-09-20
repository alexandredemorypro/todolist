<?php
namespace framework;


/**
 * Class Router
 * @package framework
 */
class Router
{

    /** @var string[] */
    private const METHODS_AVAILABLE = ['get', 'post', 'put', 'delete'];

    /** @var Router|null $instance */
    private static ?Router $instance = null;

    private function __construct()
    {
        // user
        $this->post('#^\/user\/auth#', 'UserController@auth');

        // Category
        $this->get('#^\/categories$#', 'CategoryController@getAll');
        $this->get('#^\/category\/\d+$#', 'CategoryController@get');
        $this->post('#^\/category$#', 'CategoryController@create');
        $this->put('#^\/category\/\d+$#', 'CategoryController@update');
        $this->delete('#^\/category\/\d+$#', 'CategoryController@delete');

        //item
        $this->get('#^\/items$#', 'ItemController@getAll');
        $this->get('#^\/item\/\d+$#', 'ItemController@get');
        $this->get('#^\/category\/\d+\/items$#', 'ItemController@getByCategoryId');
        $this->post('#^\/category\/\d+\/item$#', 'ItemController@create');
        $this->put('#^\/item\/\d+$#', 'ItemController@update');
        $this->delete('#^\/item\/\d+$#', 'ItemController@delete');

        // Subitem
        $this->get('#^\/subitems$#', 'SubitemController@getAll');
        $this->get('#^\/subitem\/\d+$#', 'SubitemController@get');
        $this->get('#^\/item\/\d+\/subitems$#', 'SubitemController@getByItemId');
        $this->post('#^\/item\/\d+\/subitem$#', 'SubitemController@create');
        $this->put('#^\/subitem\/\d+$#', 'SubitemController@update');
        $this->delete('#^\/subitem\/\d+$#', 'SubitemController@delete');
    }

    /**
     * @return Router
     */
    public static function getInstance(): Router
    {
        if (self::$instance === null) {
            self::$instance = new Router();
        }

        return self::$instance;
    }

    /**
     * @param string $httpMethod
     * @param array $args
     * @throws \Exception
     */
    function __call(string $httpMethod, array $args): void
    {
        if (in_array($httpMethod, self::METHODS_AVAILABLE)) {
            $this->addRoute($httpMethod, $args[0], $args[1]);
            return;
        }

        throw new \Exception('In class: ' . __CLASS__ . ' Method ' . $httpMethod . ' is forbidden');
    }

    /**
     * @param Request $request
     */
    public function resolve(Request $request)
    {
        $requestMethod = strtolower($request->server['REQUEST_METHOD']);
        $requestRoute = $request->server['PATH_INFO'];
        if (in_array($requestMethod, self::METHODS_AVAILABLE)) {
            foreach ($this->{"routes_available_$requestMethod"} as $pattern => $controllerAction) {
                if (preg_match($pattern, $requestRoute)) {
                    $controllerData = explode('@', $controllerAction);
                    $controllerData[0] = "api\\controller\\$controllerData[0]";
                    $controller = new $controllerData[0];
                    if (method_exists($controllerData[0], $controllerData[1])) {
                        call_user_func_array([$controller, $controllerData[1]], [$request]);
                        break;
                    }
                }
            }
        } else if ($requestMethod === 'options') {
            new Response('OK', 200);
            return;
        }
    }

    /**
     * @param string $httpMethod
     * @param string $route
     * @param string $classMethod
     */
    private function addRoute(string $httpMethod, string $route, string $classMethod): void
    {
        $this->{"routes_available_$httpMethod"}[$route] = $classMethod;
    }
}

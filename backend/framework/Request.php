<?php
namespace framework;


/**
 * Class Request
 * @package framework
 */
class Request
{
    public array $session;
    public array $server;
    public array $request;
    public array $post;
    public array $get;
    public array $cookie;
    public array $env;
    public array $files;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->session = $_SESSION ?? [];
        $this->server = $_SERVER ?? [];
        $this->request = $_REQUEST ?? [];
        $this->post = $_POST ?? [];
        $this->get = $_GET ?? [];
        $this->cookie = $_COOKIE ?? [];
        $this->env = $_ENV ?? [];
        $this->files = $_FILES ?? [];

        if (in_array(strtolower($this->server['REQUEST_METHOD']), ['post', 'put'])) {
            $data = file_get_contents("php://input");
            $this->post = json_decode($data, true);
        }
    }
}

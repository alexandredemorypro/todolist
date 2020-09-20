<?php
namespace framework;

/**
 * Class Response
 * @package framework
 */
class Response
{

    public function __construct($data, int $code = 200)
    {
        header('Content-type:application/json;charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
        header('Access-Control-Allow-Headers: *');
        http_response_code($code);
        $data = is_array($data) ? $data : [$data];
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}
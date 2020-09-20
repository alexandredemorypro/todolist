<?php
require_once(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'Autoloader.php');
new \framework\AutoLoader();

$api = new \framework\Api();
$api->run();

<?php
/**
 * @var $response ResponseInterface
 */
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Psr\Http\Message\ResponseInterface;

ini_set('display_errors', 1);
error_reporting(E_ALL);

chdir(dirname(__DIR__));

session_start();

require_once('vendor/autoload.php');

require_once('public/dependencies.php');
require_once('public/router.php');

$emitter = new SapiEmitter();
$emitter->emit($response);
<?php
/**
 * @var $response ResponseInterface
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);

use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Psr\Http\Message\ResponseInterface;

chdir(dirname(__DIR__));

require_once('vendor/autoload.php');
require_once('public/dependencies.php');
require_once('public/router.php');

//Run

$emitter = new SapiEmitter();
$emitter->emit($response);
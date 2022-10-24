<?php

use App\Core\ActionResolver;
use App\Core\Container;
use App\Core\UriGeneragor;
use Aura\Router\RouterContainer;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\ServerRequestFactory;

/**
 * @var $container Container
 */
$request = ServerRequestFactory::fromGlobals();

$routerContainer = new RouterContainer();
$generator = $routerContainer->getGenerator();

$map = $routerContainer->getMap();

require_once('public/routes.php');

$matcher = $routerContainer->getMatcher();

$resolver = new ActionResolver();

$container->getBuilder()->register(UriGeneragor::class, UriGeneragor::class)->addArgument($generator);

try {
    $result = $matcher->match($request);

    foreach($result->attributes as $key => $value) {
        $request = $request->withAttribute($key, $value);
    }

    $action = $result->handler;

    if (is_array($action)) {
        $controller = $container->get($action);
        $action = array_pop($action);

        $response = $controller->$action($request);
    } else {
        $action = $resolver->resolve($action);

        $response = $action($request);
    }

} catch(Exception $exception) {
    $response = new Response();
    $response->getBody()->write($exception->getMessage());
}
<?php

// Routing
use App\Controllers\HomeController;
use App\Core\ActionResolver;
use Aura\Router\RouterContainer;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\ServerRequestFactory;

/**
 * @var $container \App\Core\Container
 */
$request = ServerRequestFactory::fromGlobals();

$routerContainer = new RouterContainer();
$map = $routerContainer->getMap();

require_once('public/routes.php');

$matcher = $routerContainer->getMatcher();

$resolver = new ActionResolver();

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

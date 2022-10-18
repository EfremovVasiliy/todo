<?php

use App\Controllers\HomeController;
use App\Core\A;
use App\Core\ActionResolver;
use App\Core\Controller;
use Aura\Router\RouterContainer;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Symfony\Component\DependencyInjection\Reference;

chdir(dirname(__DIR__));
require_once('vendor/autoload.php');

$container = new \Symfony\Component\DependencyInjection\ContainerBuilder();

$container->register(Controller::class, Controller::class);
$container->register(HomeController::class, HomeController::class);

// Routing
$routerContainer = new RouterContainer();
$map = $routerContainer->getMap();

$map->get('home.index', '/', [HomeController::class, 'index']);

$map->get('home.name', '/{name}/{some}', [HomeController::class, 'name'])->tokens(['name' => '\D+', 'some' => '\D+']);

$request = ServerRequestFactory::fromGlobals();

$response = new Response();

$matcher = $routerContainer->getMatcher();

$resolver = new ActionResolver();

try {
    $result = $matcher->match($request);

    foreach($result->attributes as $key => $value) {
        $request = $request->withAttribute($key, $value);
    }

    $action = $result->handler;

    if (is_array($action)) {
        $controller = array_shift($action);
        $action = array_shift($action);

        $object = $container->get($controller);
        $response = $object->$action($request, $response);

    } else {
        $action = $resolver->resolve($action);
        $response = $action($request);
    }

} catch(Exception $exception) {
    $response->getBody()->write($exception->getMessage());
}

//Run

$emitter = new SapiEmitter();
$emitter->emit($response);
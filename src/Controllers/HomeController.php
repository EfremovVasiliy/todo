<?php

namespace App\Controllers;

use App\Core\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HomeController extends Controller
{
    public function index(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
//        dd($request);
        $response->getBody()->write('Hello world');

        return $response->withHeader('author', 'Vasiliy');
    }

    public function name(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $name = $request->getAttribute('name');
        $response->getBody()->write('Your name is '. $name);
        return $response;
    }
}
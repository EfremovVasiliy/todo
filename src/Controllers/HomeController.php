<?php

namespace App\Controllers;

use App\Core\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class HomeController extends Controller
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function index(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $loader = new FilesystemLoader('src/views/templates');
        $twig = new Environment($loader);

        $temp = $twig->render('index.twig', ['name' => 'Vasia']);

        $response->getBody()->write($temp);
        return $response->withHeader('author', 'Vasiliy');
    }

    public function name(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $name = $request->getAttribute('name');
        $response->getBody()->write('Your name is '. $name);
        return $response;
    }
}
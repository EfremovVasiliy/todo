<?php

namespace App\Core;

use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class Controller
{
    public Environment $environment;
    private const TWIG_EXTENSION = '.twig';
    private ResponseInterface $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
        
        $loader = new FilesystemLoader('src/views/templates');
        $environment = new Environment($loader);
        
        $this->environment = $environment;
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    protected function render(string $template, array $context = []): ResponseInterface
    {
        $data = $this->environment->render($template. self::TWIG_EXTENSION, $context);
        $this->response->getBody()->write($data);
        return $this->response;
    }
}
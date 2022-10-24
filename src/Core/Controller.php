<?php

namespace App\Core;

use Laminas\Diactoros\Response;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{
    private Environment $environment;
    protected Response $response;

    private const TWIG_EXTENSION = '.twig';

    public function __construct(Response $response)
    {
        $this->response = $response;
        
        $loader = new FilesystemLoader('src/Views/templates');
        $environment = new Environment($loader, [
            'debug' => true
        ]);
        $environment->addExtension(new DebugExtension());
        
        $this->environment = $environment;
    }

    public function addResponseHeader(string $headerName, string|int $headerValue): void
    {
        $this->response = $this->response->withHeader($headerName, $headerValue);
    }

    public function addResponseHeaders(array $header): void
    {
        $this->response = $this->response->withHeaders($header);
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    protected function render(string $template, array $context = []): Response
    {
        $data = $this->environment->render($template. self::TWIG_EXTENSION, $context);
        $this->response->getBody()->write($data);
        return $this->response;
    }
}
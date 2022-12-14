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

    protected const TWIG_EXTENSION = '.twig';
    protected const TWIG_LAYOUT = 'layouts/main';

    public function __construct()
    {
        $loader = new FilesystemLoader('src/Views');
        $environment = new Environment($loader, [
            'debug' => true
        ]);
        $environment->addExtension(new DebugExtension());
        
        $this->environment = $environment;
        $this->response = new Response();
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
    protected function html(string $template, string $title = 'Page', array $context = []): Response
    {
        $temp = $this->environment->render($template. self::TWIG_EXTENSION, $context);

        $data = $this->environment->render(self::TWIG_LAYOUT. self::TWIG_EXTENSION, [
            'content' => $temp,
            'title' => $title,
            'session' => $_SESSION
        ]);

        $this->response->getBody()->write($data);
        return $this->response;
    }

    protected function json(array $data, int $status = 200, array $headers = []): Response\JsonResponse
    {
        return (new Response\JsonResponse($data, $status, $headers));
    }
}
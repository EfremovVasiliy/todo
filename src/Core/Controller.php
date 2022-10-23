<?php

namespace App\Core;

use Psr\Http\Message\ResponseInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{
    private Environment $environment;
    private ResponseInterface $response;

    private const TWIG_EXTENSION = '.twig';

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
        
        $loader = new FilesystemLoader('src/Views/templates');
        $environment = new Environment($loader, [
            'debug' => true
        ]);
        $environment->addExtension(new DebugExtension());
        
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
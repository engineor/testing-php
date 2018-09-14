<?php

declare(strict_types=1);

namespace App\Action;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment as Renderer;

final class HomePage
{
    private $renderer;

    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function handle(): Response
    {
        return new Response($this->renderer->render('home.html.twig'));
    }
}
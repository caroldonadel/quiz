<?php

namespace Quiz\Armazenamento\User;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Quiz\Armazenamento\Helper\RenderizadorDeHtmlTrait;

class Home implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $_SESSION['logado'] = false;

        $html =  $this->renderizaHtml('home.php', [
            'titulo' => 'Home'
        ]);

        return new Response(200, ['Cache-Control'=>' no-cache'], $html);
    }
}
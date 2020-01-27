<?php

namespace Quiz\Armazenamento\User;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Quiz\Armazenamento\Helper\RenderizadorDeHtmlTrait;

class Home
{
    use RenderizadorDeHtmlTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html =  $this->renderizaHtml('home.php', [
//            'titulo' => 'Home'
        ]);

        return new Response(200, [], $html);
    }
}
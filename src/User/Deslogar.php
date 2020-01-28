<?php

namespace Quiz\Armazenamento\User;

use Quiz\Armazenamento\Helper\{FlashMessageTrait, RenderizadorDeHtmlTrait};
use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};
use Nyholm\Psr7\Response;
use Psr\Http\Server\RequestHandlerInterface;

class Deslogar implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        session_destroy();
        return new Response(302, ['Location' => '/quiz/public/login'] );
    }
}
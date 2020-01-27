<?php

namespace Quiz\Armazenamento\User;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Quiz\Armazenamento\Helper\RenderizadorDeHtmlTrait;

class Formulario implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;

     public function handle(ServerRequestInterface $request): ResponseInterface
     {
         $html =  $this->renderizaHtml('users/formulario-login.php', [
             'titulo' => 'Login'
         ]);

         return new Response(200, [], $html);
     }
}

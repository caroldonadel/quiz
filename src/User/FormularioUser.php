<?php

namespace Quiz\Armazenamento\User;

namespace Quiz\Armazenamento\User;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Quiz\Armazenamento\Helper\RenderizadorDeHtmlTrait;

class FormularioUser implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html =  $this->renderizaHtml('users/formulario-novo-user.php', [
            'titulo' => 'Cadastrar Novo Usuário'
        ]);

        return new Response(200, [], $html);
    }
}
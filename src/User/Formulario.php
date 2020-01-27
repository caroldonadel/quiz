<?php

namespace Quiz\Armazenamento\User;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Quiz\Armazenamento\Helper\RenderizadorDeHtmlTrait;

//SRC/USER/FORMULARIO: CONTROLLER QUE MOSTRA O HTML DO FORMULÁRIO DE LOGIN QUANDO RECEBE UMA REQUISIÇÃO

class Formulario
{
    use RenderizadorDeHtmlTrait;

    public function handle(Request $request): Response
    {
        $html = $this->renderizaHtml('users/formulario-login.php', [
            'titulo' => 'Login'
        ]);

        return new Response(200, [], $html);
    }
}

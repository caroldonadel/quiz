<?php

namespace Quiz\Armazenamento\User;

use Quiz\Armazenamento\Helper\{FlashMessageTrait, RenderizadorDeHtmlTrait};
use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};
use Quiz\Armazenamento\User\UserModel;
use Nyholm\Psr7\Response;
use Psr\Http\Server\RequestHandlerInterface;

class RealizarLogin implements RequestHandlerInterface
{
    use FlashMessageTrait;
    use RenderizadorDeHtmlTrait;

    private $usuario;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {


        $email = filter_var( //ou seria filter_input?
            $request->getParsedBody()['email'],
            FILTER_VALIDATE_EMAIL
        );

        echo $email;

//        $redirecionamentoLogin = new Response(302, ['Location' => '/quiz/public/login']);
//
//        if (is_null($email) || $email === false) {
//            $this->defineMensagem(
//                'danger',
//                'O e-mail digitado não é um e-mail válido.'
//            );
//
//            return $redirecionamentoLogin;
//        }

        $senha = filter_input(
            INPUT_POST,
            'senha',
            FILTER_SANITIZE_STRING
        );

        $senha;

        $usuario = UserModel::carregar($email, $senha);

//        if (is_null($usuario) || !$usuario->senhaEstaCorreta($senha)) {
//            $this->defineMensagem('danger', 'E-mail ou senha inválidos');
//
//            return $redirecionamentoLogin;
//        }

        $_SESSION['logado'] = true;

        $html =  $this->renderizaHtml('users/pagina-principal-usuario.php', [
            'titulo' => 'nao sei ainda'
        ]);

        return new Response(200, [], $html);
    }
}
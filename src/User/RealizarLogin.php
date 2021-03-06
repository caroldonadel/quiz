<?php

namespace Quiz\Armazenamento\User;

use Quiz\Armazenamento\Helper\{FlashMessageTrait, RenderizadorDeHtmlTrait};
use Quiz\Armazenamento\Quiz\QuizModel;
use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};
use Nyholm\Psr7\Response;
use Psr\Http\Server\RequestHandlerInterface;

class RealizarLogin implements RequestHandlerInterface
{
    use FlashMessageTrait;
    use RenderizadorDeHtmlTrait;

    private $usuario;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $email = filter_var(
            $request->getParsedBody()['email'],
            FILTER_VALIDATE_EMAIL
        );

        $redirecionamentoLogin = new Response(302, ['Location' => '/login']);

        if ($email === false) {
            $this->defineMensagem(
                'danger',
                'O e-mail digitado não é um e-mail válido.'
            );

            return $redirecionamentoLogin;
        }

        $senha = filter_input(
            INPUT_POST,
            'senha',
            FILTER_SANITIZE_STRING
        );

        $usuario = new UserModel();
        $usuario->setEmail($email);
        $usuario->carregar();

        if ($usuario===false || !$usuario->senhaEstaCorreta($senha)) {
            $this->defineMensagem('danger', 'E-mail ou senha inválidos');

            return $redirecionamentoLogin;
        }

        $_SESSION['email'] = $usuario->getEmail();
        $_SESSION['logado'] = true;

        return new Response(200, ['Location' => '/inicio']);
//        return new Response(200, [], $html);

    }
}
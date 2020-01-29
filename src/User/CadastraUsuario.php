<?php

namespace Quiz\Armazenamento\User;

use Quiz\Armazenamento\Helper\{FlashMessageTrait, RenderizadorDeHtmlTrait};
use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};
use Nyholm\Psr7\Response;
use Psr\Http\Server\RequestHandlerInterface;

class CadastraUsuario implements RequestHandlerInterface
{
    use FlashMessageTrait;
    use RenderizadorDeHtmlTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $usuario = new UserModel();

        $nome = filter_var(
            $request->getParsedBody()['nome'],
            FILTER_SANITIZE_STRING
        );

        $email = filter_var(
            $request->getParsedBody()['email'],
            FILTER_VALIDATE_EMAIL
        );

        $senha = filter_input(
            INPUT_POST,
            'senha',
            FILTER_SANITIZE_STRING
        );

        $hashed_password = password_hash($senha, PASSWORD_ARGON2I);

        $usuario->setNome($nome);
        $usuario->setEmail($email);
        $usuario->setSenha($hashed_password);
        $usuario->setNivel("guest");

        $usuario->inserirUsuario();
        $usuario->carregar();

        $_SESSION['logado'] = true;
        $_SESSION['email'] = $usuario->getEmail();
//        $_SESSION['id'] = $usuario->getIdUsuario();

        $html =  $this->renderizaHtml('users/pagina-principal-usuario.php', [
            'titulo' => 'Seus Quizzes',
            'nivel' => $usuario->getNivel(),
            'idUsuario' => $usuario->getIdUsuario()
        ]);

        return new Response(200, [], $html);
    }
}
<?php

namespace Quiz\Armazenamento\User;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Quiz\Armazenamento\Helper\RenderizadorDeHtmlTrait;
use Quiz\Armazenamento\Quiz\QuizModel;

class Inicio implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;
    use Quiz\Armazenamento\User\UserModel;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $usuario = new UserModel();
        $usuario->setEmail($_SESSION['email']);
        $usuario->carregar();

        $quizzes = new QuizModel();

        $html =  $this->renderizaHtml('users/pagina-principal-usuario.php', [
            'titulo' => 'Seus Quizzes',
            'nivel' => $usuario->getNivel(),
            'idUsuario' => $usuario->getIdUsuario(),
            'lista' => $quizzes->listar()
        ]);

        return new Response(200, [], $html);
    }
}
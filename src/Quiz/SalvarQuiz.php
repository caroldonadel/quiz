<?php

namespace Quiz\Armazenamento\Quiz;

use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};
use Nyholm\Psr7\Response;
use Psr\Http\Server\RequestHandlerInterface;

class SalvarQuiz implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $json = file_get_contents('php://input');
        $jsonPayload = json_decode($json);

        $quiz = new QuizModel();
        $titulo = $jsonPayload->titulo;
        $idusuario = $jsonPayload->idusuario;

        $quiz->setTitulo($titulo);
        $quiz->setIdUsuarios($idusuario);
        $quiz->inserir();

        return new Response(200, [], $quiz->getIdQuizzes());
    }
}
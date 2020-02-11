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
        $quiz->setTitulo($titulo);
        $idusuario = $jsonPayload->idusuario;

        $quiz->carregarTitulo();
        $idquiz = $quiz->getIdQuizzes();

        if(!isset($idquiz)){
            $quiz->setIdUsuarios($idusuario);
            $quiz->inserir();

            return new Response(200, [], $quiz->getIdQuizzes());

        }else{
            return new Response(200, [], $quiz->getIdQuizzes());
         }
        }
}
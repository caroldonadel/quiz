<?php

namespace Quiz\Armazenamento\Quiz;

use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};
use Nyholm\Psr7\Response;
use Psr\Http\Server\RequestHandlerInterface;

class EditaQuiz implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $json = file_get_contents('php://input');
        $request = json_decode($json, true);

        $quiz = new QuizModel();
        $quiz->setTitulo($request['titulo']);
        $quiz->setIdQuizzes($request['idquiz']);

        $quiz->atualizar();

        var_dump($request);

            return new Response(200, []);
    }
}
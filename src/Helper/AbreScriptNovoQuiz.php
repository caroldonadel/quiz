<?php

namespace Quiz\Armazenamento\Helper;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
//include __DIR__ . '/../../js/script-criacao-quiz.php';


class AbreScriptNovoQuiz implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        echo
        file_get_contents(__DIR__ . '/../../js/script-criacao-quiz.js');

        return new Response(200, []);
    }
}
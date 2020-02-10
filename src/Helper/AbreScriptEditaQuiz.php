<?php


namespace Quiz\Armazenamento\Helper;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

include __DIR__ . '/../../js/script-edita-quiz.php';

class AbreScriptEditaQuiz implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new Response(200, []);
    }
}
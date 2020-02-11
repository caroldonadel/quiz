<?php

namespace Quiz\Armazenamento\Quiz;

use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};
use Nyholm\Psr7\Response;
use Psr\Http\Server\RequestHandlerInterface;

class EditaPerguntas implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $json = file_get_contents('php://input');
        $request = json_decode($json, true);

        $pergunta = new PerguntasModel();
        $pergunta->setTitulo($request['tituloPergunta']);
        $pergunta->setIdperguntas($request['idPergunta']);
        echo $pergunta->getIdperguntas();

        $pergunta->atualizar();

        return new Response(200, []);
    }
}
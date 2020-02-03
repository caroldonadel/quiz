<?php

namespace Quiz\Armazenamento\Quiz;

use Quiz\Armazenamento\Helper\FlashMessageTrait;
use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};
use Nyholm\Psr7\Response;
use Psr\Http\Server\RequestHandlerInterface;

class SalvarPerguntas implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $json = file_get_contents('php://input');
        $perguntas = json_decode($json, true);
        $perguntaEid = [];


        foreach ($perguntas["perguntas"] as $tituloPergunta){
            $pergunta = new PerguntasModel();
            $pergunta->setTitulo($tituloPergunta);
            $idquiz = $perguntas["idquiz"];
            $pergunta->setIdquiz($idquiz);

            $pergunta->inserir();

            $perguntaEidLoop = [$pergunta->getTitulo(), $pergunta->getIdperguntas()];
            array_push($perguntaEid, $perguntaEidLoop);
    }
//        return new Response(200, [], $pergunta->getIdperguntas());
        return new Response(200, [], json_encode($perguntaEid));
    }
}
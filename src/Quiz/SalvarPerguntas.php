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

        foreach ($perguntas["perguntas"] as $tituloPergunta) {
            $pergunta = new PerguntasModel();
            $titulo = $tituloPergunta;
            $idquiz = $perguntas["idquiz"];

            $pergunta->lastId(); //define idperguntas
            $pergunta->carregar();

            if ($pergunta->getTitulo() !== $titulo) {
                $pergunta->setTitulo($tituloPergunta);
                $pergunta->setIdquiz($idquiz);
                $pergunta->inserir(); //redefine o idperguntas pra enviar corretamente pro JS

                $perguntaEidLoop = [$pergunta->getTitulo(), $pergunta->getIdperguntas()];
                array_push($perguntaEid, $perguntaEidLoop);
            }
        }

        if(!is_null($perguntaEid)){
            return new Response(200, [], json_encode($perguntaEid));

        }else{
            return new Response(200, []);
        }
    }
}
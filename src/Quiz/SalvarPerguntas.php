<?php

namespace Quiz\Armazenamento\Quiz;

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
            $pergunta->setTitulo($titulo);

            $pergunta->carregarTitulo();
            $idPerguntas = $pergunta->getIdperguntas();

            if (!isset($idPerguntas)){
//                echo "nao esta no bd";
                $pergunta->setTitulo($titulo);
                $pergunta->setIdquiz($idquiz);
                $pergunta->inserir(); //redefine o idperguntas pra enviar corretamente pro JS

                $perguntaEidLoop = [$pergunta->getTitulo(), $pergunta->getIdperguntas()];
                array_push($perguntaEid, $perguntaEidLoop);

//                var_dump($perguntaEid);
            }else{
//                echo "ja estava no bd";
                $pergunta->setTitulo($tituloPergunta);
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
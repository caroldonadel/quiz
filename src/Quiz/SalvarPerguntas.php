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

        var_dump($perguntas);

        foreach ($perguntas["perguntas"] as $pergunta){
            $pergunta = new PerguntasModel();
            $titulo = $pergunta;
            var_dump($titulo);
            $idquiz = $perguntas["idquiz"];
            echo $idquiz;

            $pergunta->setTitulo($titulo);
            $pergunta->setIdQuiz($idquiz);
            $pergunta->inserir();
    }
        return new Response(200, []);
    }
}
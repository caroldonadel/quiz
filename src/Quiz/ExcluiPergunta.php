<?php

namespace Quiz\Armazenamento\Quiz;

use http\Env\Request;
use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};
use Nyholm\Psr7\Response;
use Psr\Http\Server\RequestHandlerInterface;

class ExcluiPergunta implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        $alternativa = new AlternativasModel();
        $alternativa->setIdperguntas($request->getQueryParams()['idpergunta']);
        $alternativasDaPergunta = $alternativa->listarPorPergunta();

        var_dump($alternativasDaPergunta);
        foreach ($alternativasDaPergunta as $alternativaExclusao) {

            $resposta = new RespostaModel();
            $resposta->setIdalternativas($alternativaExclusao['idalternativas']);
            $resposta->excluir();

            $alternativa->setIdalternativas($alternativaExclusao['idalternativas']);
            $alternativa->excluir();
        }

        $pergunta = new PerguntasModel();
        $pergunta->setIdperguntas($request->getQueryParams()['idpergunta']);
        $pergunta->excluir();

//        return new Response(200, []);
        return new Response(200, ['Location' => '/edita-quiz?id=' . $request->getQueryParams()['idquiz']]);
    }
}
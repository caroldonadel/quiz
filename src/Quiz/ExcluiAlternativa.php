<?php

namespace Quiz\Armazenamento\Quiz;

use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};
use Nyholm\Psr7\Response;
use Psr\Http\Server\RequestHandlerInterface;

class ExcluiAlternativa implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        $resposta = new RespostaModel();
        $resposta->setIdalternativas($request->getQueryParams()['idalternativa']);
        $resposta->excluir();

        $alternativa = new AlternativasModel();
        $alternativa->setIdalternativas($request->getQueryParams()['idalternativa']);
        $alternativa->excluir();

//        return new Response(200, []);
        return new Response(200, ['Location' => '/edita-quiz?id=' . $request->getQueryParams()['idquiz']]);
    }
}
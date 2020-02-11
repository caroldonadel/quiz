<?php

namespace Quiz\Armazenamento\Quiz;

use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};
use Nyholm\Psr7\Response;
use Psr\Http\Server\RequestHandlerInterface;

class EditaAlternativas implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $json = file_get_contents('php://input');
        $request = json_decode($json, true);

         $alternativa = new AlternativasModel();
         $alternativa->setDescricao($request['descricao']);
         $alternativa->setIdalternativas($request['idalternativas']);
         $alternativa->setIdperguntas($request['idpergunta']);
         $alternativa->setCorreta($request['correta']);

         $alternativa->atualizar();

        return new Response(200, []);
    }
}
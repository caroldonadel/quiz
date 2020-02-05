<?php

namespace Quiz\Armazenamento\Quiz;

use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};
use Nyholm\Psr7\Response;
use Psr\Http\Server\RequestHandlerInterface;

class SalvarRespostas implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $json = file_get_contents('php://input');
        $jsonPayload = json_decode($json);

        $idusuario = $jsonPayload->iduser;
        $idalternativa = $jsonPayload->idResp;

        $resposta = new RespostaModel();
        $resposta->setIdusuarios($idusuario);
        $resposta->setIdalternativas($idalternativa);

        $resposta->inserir();

        var_dump($resposta);

        return new Response(200, []);
    }
}
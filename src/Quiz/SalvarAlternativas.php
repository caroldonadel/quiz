<?php


namespace Quiz\Armazenamento\Quiz;

use Quiz\Armazenamento\Helper\FlashMessageTrait;
use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};
use Nyholm\Psr7\Response;
use Psr\Http\Server\RequestHandlerInterface;

class SalvarAlternativas implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $json = file_get_contents('php://input');
        $request = json_decode($json);

           $alternativa = new AlternativasModel();

            $alternativa->setDescricao($request->descricao);
            $alternativa->setIdperguntas($request->idpergunta);
            $alternativa->setCorreta($request->correta);

            $alternativa->inserir();

        return new Response(200, [], json_encode($alternativa));
    }
}

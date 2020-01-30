<?php

namespace Quiz\Armazenamento\Quiz;

use Quiz\Armazenamento\Helper\{FlashMessageTrait, RenderizadorDeHtmlTrait};
use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};
use Nyholm\Psr7\Response;
use Psr\Http\Server\RequestHandlerInterface;

class SalvarQuiz implements RequestHandlerInterface
{
//    use FlashMessageTrait;
//    use RenderizadorDeHtmlTrait;


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $json = file_get_contents('php://input');
        $jsonPayload = json_decode($json);

        echo "controler sendo chamado";
        var_dump($jsonPayload);

        $quiz = new QuizModel();
        $titulo = $jsonPayload->titulo;
        $idusuario = $jsonPayload->idusuario;

        $quiz->setTitulo($titulo);
        $quiz->setIdUsuarios($idusuario);
        $quiz->inserir();

        return new Response(200, [], "testando");
//        return new Response(200, ['Location' => $_SESSION['self']]);
//        ['Location' => '/quiz/public/home']
//        "Location:{$_SESSION['self']}"
//        'Content-Type: application/json'
    }
}
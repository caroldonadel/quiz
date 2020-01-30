<?php

namespace Quiz\Armazenamento\Quiz;

use Quiz\Armazenamento\Helper\FlashMessageTrait;
use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};
use Nyholm\Psr7\Response;
use Psr\Http\Server\RequestHandlerInterface;

class SalvarQuiz implements RequestHandlerInterface
{
    use FlashMessageTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $json = file_get_contents('php://input');
        $jsonPayload = json_decode($json);

//        echo "controler sendo chamado";
//        var_dump($jsonPayload);

        $quiz = new QuizModel();
        $titulo = $jsonPayload->titulo;
        $idusuario = $jsonPayload->idusuario;

        $quiz->setTitulo($titulo);
        $quiz->setIdUsuarios($idusuario);
        $quiz->inserir();

//        $tipo = 'success';
//        $mensagem = 'Quiz salvo com sucesso';
//        $_SESSION['mensagem'] = $mensagem;
//        $_SESSION['tipo_mensagem'] = $tipo;
//        $mensagem = '{tipo:' . $_SESSION["tipo_mensagem"] .',' . 'mensagem:' . $_SESSION["mensagem"] . '}';
//
////        return new Response(200, [], json_encode($mensagem));
        return new Response(200, [], );
    }
}
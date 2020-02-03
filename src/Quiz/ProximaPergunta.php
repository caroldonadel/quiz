<?php

namespace Quiz\Armazenamento\Quiz;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Quiz\Armazenamento\Helper\RenderizadorDeHtmlTrait;

class ProximaPergunta implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;
//    private $indice = 0;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $json = file_get_contents('php://input');
        $jsonPayload = json_decode($json);

        $id = $jsonPayload->id;
        $quiz = new QuizModel();
        $quiz->setIdQuizzes($id);
        $quiz->carregar();

        $perguntas = new PerguntasModel();
        $perguntas->setIdquiz($quiz->getIdQuizzes());
        $lista = $perguntas->carregar();
        unset($lista[0]);
        $indice =0;
        $indice++;

        var_dump($lista);

        $alternativas = new AlternativasModel();
        $alternativas->setIdperguntas($lista[$indice]['idperguntas']);
//        $listaAlt = [];
        $listaAlternativas = $alternativas->carregar();

//
//        $alternativas = new AlternativasModel();
//        $listaAlternativas = [];
//
//        foreach($lista as $pergunta){
//            $alternativas->setIdperguntas($pergunta['idperguntas']);
//            array_push($listaAlternativas, $alternativas->carregar());
//        }
//
//        $perguntas = new PerguntasModel();
//        $perguntas->setIdquiz($quiz->getIdQuizzes());
//        $lista = $perguntas->carregar();
//
//        $alternativas = new AlternativasModel();
//        $alternativas->setIdperguntas($lista[0]['idperguntas']);
////        $listaAlt = [];
//        $listaAlternativas = $alternativas->carregar();
//
        $resposta = ["titulo" => $quiz->getTitulo(),
            "idquiz" => $quiz->getIdQuizzes(),
            "listaPerguntas" => $lista,
            "listaAlternativas" => $listaAlternativas];

//        return new Response(200, [], json_encode($resposta));
        return new Response(200, [], $resposta);
    }
}
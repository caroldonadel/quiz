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
//    private static $indice = 0;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
//        echo $this->indice;
        $json = file_get_contents('php://input');
        $jsonPayload = json_decode($json);

        $id = $jsonPayload->id;
        $indice= $jsonPayload->indice;
        $quiz = new QuizModel();
        $quiz->setIdQuizzes($id);
        $quiz->carregar();

        $perguntas = new PerguntasModel();
        $perguntas->setIdquiz($quiz->getIdQuizzes());
        $lista = $perguntas->carregar();

//        var_dump($lista);
        echo $indice;

        unset($lista[$indice]);

        echo array_key_first($lista);

        if(count($lista)===0){

            $resposta = "MOSTRAR RESULTADO";
        }else {

        $alternativas = new AlternativasModel();
        $alternativas->setIdperguntas($lista[$indice+1]['idperguntas']);
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
        $resposta = ['titulo' => $quiz->getTitulo(),
            'idquiz' => $quiz->getIdQuizzes(),
            'listaPerguntas' => $lista,
            'listaAlternativas' => $listaAlternativas];

//        $resposta = ['listaPerguntas' => $lista];

//        var_dump($resposta);
      }

        return new Response(200, [], json_encode($resposta));
//        return new Response(200, [], $resposta);
    }
}
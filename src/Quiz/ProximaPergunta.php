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
//    static $lista;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
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
        $lista2 = $perguntas->carregar();


//        echo $indice;
//        echo count($lista);

        if($indice>=count($lista)){

            $indiceFim = $indice - 1;
            array_splice($lista2, 0, ($indice-1));
            array_splice($lista, 0, $indice);

            $alternativas = new AlternativasModel();
            $alternativas->setIdperguntas($lista2[array_key_first($lista2)]['idperguntas']);
            $listaAlternativas = $alternativas->listarPorPergunta();

            $resposta = ['fim' => 'yes',
                        'titulo' => $quiz->getTitulo(),
                        'idquiz' => $quiz->getIdQuizzes(),
                        'listaPerguntas' => $lista2,
                        'listaAlternativas' => $listaAlternativas];

        }else {
            array_splice($lista, 0, $indice);

//            var_dump($lista);

            $alternativas = new AlternativasModel();
            $alternativas->setIdperguntas($lista[array_key_first($lista)]['idperguntas']);
            $listaAlternativas = $alternativas->listarPorPergunta();

            $resposta = ['fim' => 'no',
                        'titulo' => $quiz->getTitulo(),
                        'idquiz' => $quiz->getIdQuizzes(),
                        'listaPerguntas' => $lista,
                        'listaAlternativas' => $listaAlternativas];
      }

        return new Response(200, [], json_encode($resposta));
//        return new Response(200, [], $resposta);
    }
}
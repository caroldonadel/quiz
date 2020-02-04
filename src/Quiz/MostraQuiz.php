<?php

namespace Quiz\Armazenamento\Quiz;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Quiz\Armazenamento\Helper\RenderizadorDeHtmlTrait;

class MostraQuiz implements RequestHandlerInterface
{

    use RenderizadorDeHtmlTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $idQuiz = $request->getQueryParams()['id'];

        $quiz = new QuizModel();
        $quiz->setIdQuizzes($idQuiz);
        $quiz->carregar();

        $perguntas = new PerguntasModel();
        $perguntas->setIdquiz($quiz->getIdQuizzes());
        $lista = $perguntas->carregar();

        $alternativas = new AlternativasModel();
        $alternativas->setIdperguntas($lista[0]['idperguntas']);
//        $listaAlt = [];
        $listaAlternativas = $alternativas->carregar();

//        echo '<pre>';
//        var_dump($lista);
//        echo '</pre>';

//        foreach ($listaAlternativas as $alternativa){
//            if($alternativa['idperguntas']=== $lista[0]['idperguntas']){
////                echo $alternativa['idperguntas'];
////                echo $lista[0]['idperguntas'];
//                array_push($listaAlt, $alternativas);
//            }
//        }

//        foreach($lista as $pergunta){
//            $alternativas->setIdperguntas($pergunta['idperguntas']);
//            array_push($listaAlternativas, $alternativas->carregar());
//        }

//        var_dump($listaAlt);
//        var_dump($listaAlternativas);

        $html =  $this->renderizaHtml('quiz/mostra-quiz.php', [
            'titulo' => $quiz->getTitulo(),
            'idquiz' => $quiz->getIdQuizzes(),
            'listaPerguntas' => $lista,
            'listaAlternativas' => $listaAlternativas
        ]);

        return new Response(200, [], $html);
    }
}
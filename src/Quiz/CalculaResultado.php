<?php

namespace Quiz\Armazenamento\Quiz;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Quiz\Armazenamento\Helper\RenderizadorDeHtmlTrait;

class CalculaResultado implements RequestHandlerInterface {

    use RenderizadorDeHtmlTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $quiz = new QuizModel();
        $idquiz = $request->getQueryParams()['idquiz'];
        $quiz->setIdQuizzes($idquiz);
        $quiz->carregar();

        $iduser = $request->getQueryParams()['iduser'];

        $perguntas = new PerguntasModel();
        $perguntas->setIdquiz($idquiz);
        $perguntas = $perguntas->carregar();

        $respostas = new RespostaModel();
        $respostas->setIdusuarios($iduser);
        $respostas = $respostas->carregar();

        $listaAlternativas = [];

        foreach ($perguntas as $pergunta) {  //CADA PERGUNTA DO QUIZ
            $idPergunta = $pergunta['idperguntas'];

            $alternativaCorreta = new AlternativasModel();
            $alternativaCorreta->setIdperguntas($idPergunta);

            array_push($listaAlternativas, ($alternativaCorreta->listar()));
            $lista = [];

            foreach ($listaAlternativas as $item) {
                if (is_array($item)) {
                    $lista = array_merge($lista, $item);
                }
            }

            $alternativaCorreta->carregar(); //SOMENTE A ALT CORRETA DE CADA RESPOSTA
            $idCorreta = $alternativaCorreta->getIdalternativas();

            foreach ($respostas as $resposta) { //CADA RESPOSTA DO USER
                if ($resposta['idalternativas'] == $idCorreta) ;
                {

                    foreach ($lista as $alternativa) {

                        if ($alternativa['idalternativas'] == $resposta['idalternativas']) {
                            $lista['escolhida'] = 1;
                        }
                    }
                }
            }
        }


        $perguntasQuiz = new PerguntasModel();
        $perguntasQuiz->setIdquiz($idquiz);
        $perguntasQuiz = $perguntasQuiz->carregar();

        $html =  $this->renderizaHtml('users/resultado-quiz.php', [
            'titulo' => "Resultado",
            'tituloQuiz' => $quiz->getTitulo(),
            'perguntas' => $perguntasQuiz,
            'alternativas' =>$lista,
            'respostas'=>$respostas
        ]);

        return new Response(200, [], $html);

    }
}


//{
//  { ["idalternativas"]=> string(1) "5" [0]=> string(1) "5" ["descricao"]=> string(5) "ALT 1" [1]=> string(5) "ALT 1" ["idperguntas"]=>
// string(1) "3" [2]=> string(1) "3" ["correta"]=> string(1) "1" [3]=> string(1) "1" }
//
//  { ["idalternativas"]=> string(1) "6" [0]=> string(1) "6" ["descricao"]=> string(11) "SEGUNDA ALT" [1]=> string(11) "SEGUNDA ALT"
// ["idperguntas"]=> string(1) "3" [2]=> string(1) "3" ["correta"]=> string(1) "0" [3]=> string(1) "0" }
//
//  { ["idalternativas"]=> string(1) "7" [0]=> string(1) "7" ["descricao"]=> string(11) "ALTERNATIVA" [1]=> string(11) "ALTERNATIVA"
// ["idperguntas"]=> string(1) "4" [2]=> string(1) "4" ["correta"]=> string(1) "0" [3]=> string(1) "0" }
//
//  { ["idalternativas"]=> string(1) "8" [0]=> string(1) "8" ["descricao"]=> string(20) "MAIS UMA ALTERNATIVA" [1]=> string(20)
// "MAIS UMA ALTERNATIVA" ["idperguntas"]=> string(1) "4" [2]=> string(1) "4" ["correta"]=> string(1) "1" [3]=> string(1) "1" } }
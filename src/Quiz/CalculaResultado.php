<?php

namespace Quiz\Armazenamento\Quiz;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Quiz\Armazenamento\Helper\RenderizadorDeHtmlTrait;

class CalculaResultado implements RequestHandlerInterface
{
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
        $respostas = $respostas->listar();

        $listaAlternativas = [];
//        $listaCorretas = [];

        foreach ($perguntas as $pergunta) {  //CADA PERGUNTA DO QUIZ
            $idPergunta = $pergunta['idperguntas'];

            $alternativaCorreta = new AlternativasModel();
            $alternativaCorreta->setIdperguntas($idPergunta);

            array_push($listaAlternativas, ($alternativaCorreta->listarPorPergunta()));
            $lista = [];

            foreach ($listaAlternativas as $item) {
                if (is_array($item)) {
                    $lista = array_merge($lista, $item); //lista = todas alternativas de cada pergunta
                }
            }

            $alternativaCorreta->carregar(); //SOMENTE A ALT CORRETA DE CADA RESPOSTA
            $idCorreta = $alternativaCorreta->getIdalternativas();

            foreach ($respostas as $resposta) { //CADA RESPOSTA DO USER

//                if ($resposta['idalternativas'] === $idCorreta)

                    foreach ($lista as &$alternativa) { //pra todas as alternativas da pergunta

                        if ($alternativa['idalternativas'] === $resposta['idalternativas'])  { //se a resposta tem a id da id correta

                            echo "sao iguais";
                            $alternativa['escolhida'] = '1';

    //                        }else{
    //
    //                        }
//                              if($alternativa['correta']==="1"){
//                                  $alternativa['corretaNaoEscolhida'] = '1';
//                              }

                    }
//                }
            }
//            foreach ($respostas as $resposta) { //CADA RESPOSTA DO USER
//
//                if ($resposta['idalternativas'] === $idCorreta) {
//
//                    foreach ($lista as &$alternativa) {
//
//                        if ($alternativa['idalternativas'] === $resposta['idalternativas']) {
////                            echo "teste";
//                            $alternativa['escolhida'] = "1";
////                            $lista->escolhida = '1';
//                        }
////else{
////
////
////                        }
//                    }
//                }
//            }


        }

        $perguntasQuiz = new PerguntasModel();
        $perguntasQuiz->setIdquiz($idquiz);
        $perguntasQuiz = $perguntasQuiz->carregar();

        $html = $this->renderizaHtml('users/resultado-quiz.php', [
            'titulo' => "Resultado",
            'tituloQuiz' => $quiz->getTitulo(),
            'perguntas' => $perguntasQuiz,
            'alternativas' => $lista,
            'respostas' => $respostas,
            'correta' => $alternativaCorreta
        ]);

        return new Response(200, [], $html);
    }
}



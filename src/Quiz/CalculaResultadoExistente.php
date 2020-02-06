<?php


namespace Quiz\Armazenamento\Quiz;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Quiz\Armazenamento\Helper\RenderizadorDeHtmlTrait;

class CalculaResultadoExistente implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $quiz = new QuizModel();
        $idquiz =  $_SESSION['idquiz'];
        $quiz->setIdQuizzes($idquiz);
        $quiz->carregar();

        $iduser = $_SESSION['idUser'];

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
                if ($resposta['idalternativas'] === $idCorreta) {
                    echo "teste";

                    foreach ($lista as $alternativa) {

                        if ($alternativa['idalternativas'] === $resposta['idalternativas']) {
                            $alternativa["escolhida"] = "1";
                        }
//else{
//
//
//                        }
                    }
                }
            }
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
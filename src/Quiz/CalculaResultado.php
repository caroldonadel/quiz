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

    private bool $ehIgual;

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

        foreach ($perguntas as $pergunta) {             //PARA CADA PERGUNTA DO QUIZ

            echo "pergunta do quiz";
            echo "<br>";
            $idPergunta = $pergunta['idperguntas'];                                // PEGA O ID DA PERGUNTA

            $alternativaCorreta = new AlternativasModel();
            $alternativaCorreta->setIdperguntas($idPergunta);//
            array_push($listaAlternativas, ($alternativaCorreta->listarPorPergunta())); //LISTA DE ALTERNATIVAS PARA A PERGUNTA DA VEZ
            //
            $lista = [];

            foreach ($listaAlternativas as $item) {
                if (is_array($item)) {
                    $lista = array_merge($lista, $item); //LISTA DE ALTERNATIVAS PARA A PERGUNTA DA VEZ
                }
            }

            $alternativaCorreta->carregarSomenteACorreta(); //SOMENTE A ALT CORRETA DA PERGUNTA DA VEZ (CARREGA SO CORRETA=1)
            $idCorreta = $alternativaCorreta->getIdalternativas();

            echo "idcorreta " . $idCorreta;
            echo "<br>";

            foreach ($respostas as $resposta) { //CADA RESPOSTA DO USER

                if ($resposta['idalternativas'] === $idCorreta) {
                    $this->ehIgual = true;
                } else {
                    $this->ehIgual = false;
                }
                echo "id resposta " . $resposta['idalternativas'] . 'iguais ' . $this->ehIgual;
                echo "<br>";

                foreach ($lista as &$alternativa) { //pra todas as alternativas da pergunta

                    echo $alternativa['idalternativas'];
                    echo "<br>";
                    if ($resposta['idalternativas'] === $idCorreta) { //SE A RESPOSTA TEM O MESMO ID DA ALT CORRETA DA PERGUNTA DA VEZ

                        if ($alternativa['idalternativas'] === $resposta['idalternativas'] && $this->ehIgual) { //se a ALTERNATIVA tem o id da correta
                            $alternativa['escolhida'] = '1';
                            break;
                        }
//                        elseif ($alternativa['idalternativas'] === $resposta['idalternativas'] && $this->ehIgual===false) {
//                            $alternativa['errada'] = '1';
//                        }
                    }
                }
            }
        }

        var_dump($lista);


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



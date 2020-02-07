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

    private bool $ehIgual;
    private bool $errada;

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
        $respostas = $respostas->listar();

        $listaAlternativas = [];

        foreach ($perguntas as &$pergunta) {

//            echo 'pergunta';
//            echo '<br>';

            $this->errada=false;
            $idPergunta = $pergunta['idperguntas'];
            $alternativaCorreta = new AlternativasModel();
            $alternativaCorreta->setIdperguntas($idPergunta);//
            array_push($listaAlternativas, ($alternativaCorreta->listarPorPergunta()));
            $listaAlternativasMerge = [];

            foreach ($listaAlternativas as $item) {
                if (is_array($item)) {
                    $listaAlternativasMerge = array_merge($listaAlternativasMerge, $item);
                }
            }

            $alternativaCorreta->carregarSomenteACorreta();
            $idCorreta = $alternativaCorreta->getIdalternativas();

//            echo 'idcorreta' . $idCorreta;
//            echo '<br>';

            foreach ($respostas as $resposta) {

//                echo "idresposta " . $resposta['idalternativas'];
//                echo '<br>';

                if($this->errada===true){
                    continue;
                }

                if ($resposta['idalternativas'] === $idCorreta) {
                    $this->ehIgual = true;
                } else {
                    $this->ehIgual = false;
                }

//                echo $this->ehIgual;

                foreach ($listaAlternativasMerge as &$alternativa) {

//                    echo "idalternativa" . $alternativa['idalternativas'];
//                    echo '<br>';

                    if(($alternativa['idalternativas']===$resposta['idalternativas']) &&
                        ($resposta['idalternativas']<>$idCorreta)) {
//                    if(($alternativa['idalternativas']===$resposta['idalternativas']) && $this->ehIgual===false) {

                        $alternativa['escolhidaErrada'] = 1;
                        $this->errada = true;
//                        echo 'errada';
//                        echo '<br>';

                    }elseif($alternativa['idalternativas'] === $idCorreta
                        || ($alternativa['idalternativas']===$idCorreta
                            && $alternativa['idalternativas']===$resposta['idalternativas'])){

                        $alternativa['respostaCerta'] = 1;
//                        echo 'correta';
//                        echo '<br>';

                    }
//                    elseif(($alternativa['idalternativas']<>$resposta['idalternativas']) && !$this->ehIgual) {
//
//                        $alternativa['naoFoiEscolhida'] = 1;
//                        $this->errada = true;
//                    }

//                    echo $this->errada;
                }
//                echo '<br>';
//                echo '<br>';
            }
            $pergunta['listaDeAlternativas'] = $listaAlternativasMerge;
            $listaAlternativas = [];
         }

//        $perguntasQuiz = new PerguntasModel();
//        $perguntasQuiz->setIdquiz($idquiz);
//        $perguntasQuiz = $perguntasQuiz->carregar();

        $html = $this->renderizaHtml('users/resultado-quiz.php', [
            'titulo' => $quiz->getTitulo(),
            'perguntas' => $perguntas,
            'respostas' => $respostas,
            'correta' => $alternativaCorreta
        ]);

        return new Response(200, [], $html);
    }
}



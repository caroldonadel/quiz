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

        $listaAlternativas = [];//tem que ficar aqui pra listar as alt de todas as perguntas

        foreach ($perguntas as &$pergunta) {             //PARA CADA PERGUNTA DO QUIZ
            echo "loop da pergunta da vez";
            echo "<br>";

            $this->errada=false;

            echo $this->errada;
            echo "<br>";

            $idPergunta = $pergunta['idperguntas'];                                // PEGA O ID DA PERGUNTA

            $alternativaCorreta = new AlternativasModel();
            $alternativaCorreta->setIdperguntas($idPergunta);//
            array_push($listaAlternativas, ($alternativaCorreta->listarPorPergunta())); //LISTA DE ALTERNATIVAS PARA A PERGUNTA DA VEZ
            $listaAlternativasMerge = [];

            foreach ($listaAlternativas as $item) {
                if (is_array($item)) {
                    $listaAlternativasMerge = array_merge($listaAlternativasMerge, $item); //LISTA DE ALTERNATIVAS PARA A PERGUNTA DA VEZ
                }
            }

            $alternativaCorreta->carregarSomenteACorreta(); //SOMENTE A ALT CORRETA DA PERGUNTA DA VEZ (CARREGA SO CORRETA=1)
            $idCorreta = $alternativaCorreta->getIdalternativas();

            echo $idCorreta;
            echo "<br>";

            foreach ($respostas as $resposta) { //CADA RESPOSTA DO USER


                if($this->errada===true){
                    continue;
                }

                if ($resposta['idalternativas'] === $idCorreta) {
                    $this->ehIgual = true;
                } else {
                    $this->ehIgual = false;
                }

                echo "loop da resposta da vez";
                echo "<br>";
                echo $this->ehIgual;
                echo "<br>";
                echo $resposta['idalternativas'];
                echo "<br>";
                echo "<br>";

                foreach ($listaAlternativasMerge as &$alternativa) { //pra todas as alternativas da pergunta

                    if($alternativa['idalternativas'] === $idCorreta
                    || ($alternativa['idalternativas']===$idCorreta
                    && $alternativa['idalternativas']===$resposta['idalternativas'])){

                        echo 'verde';
                        echo "<br>";

                        $alternativa['respostaCerta'] = 1;

                    }elseif(($alternativa['idalternativas']<>$resposta['idalternativas']) && !$this->ehIgual) {

                        echo 'vermelha';
                        echo "<br>";

                        $alternativa['escolhidaErrada'] = 1;
                        $this->errada = true;

                        echo $this->errada;
                        echo "<br>";


                    }

                    echo $alternativa['idalternativas'];
                    echo "<br>";
                }
            }
            $pergunta['listaDeAlternativas'] = $listaAlternativasMerge;
            var_dump($pergunta);

            $listaAlternativas = [];

        }


//    if ($resposta['idalternativas'] === $idCorreta){ //SE A RESPOSTA TEM O MESMO ID DA ALT CORRETA DA PERGUNTA DA VEZ
//
//        foreach ($listaAlternativasMerge as &$alternativa) { //pra todas as alternativas da pergunta
//
//        if ($alternativa['idalternativas'] === $resposta['idalternativas']) { //se a ALTERNATIVA tem o id da correta
//
//        echo "sao iguais";
//        $alternativa['escolhida'] = '1';
//
//        }else{
//         $alternativa['errada'] = '1'; //a alt nao tem a msm id
//
// }
// }
// }

//        $listaAlt = $alternativaCorreta->listar();
//        var_dump($listaAlternativasMerge);

        $perguntasQuiz = new PerguntasModel();
        $perguntasQuiz->setIdquiz($idquiz);
        $perguntasQuiz = $perguntasQuiz->carregar();

        $html = $this->renderizaHtml('users/resultado-quiz.php', [
            'titulo' => "Resultado",
            'tituloQuiz' => $quiz->getTitulo(),
            'perguntas' => $perguntas,
            'alternativas' => $listaAlternativasMerge,
            'respostas' => $respostas,
            'correta' => $alternativaCorreta
        ]);

        return new Response(200, [], $html);
    }
}



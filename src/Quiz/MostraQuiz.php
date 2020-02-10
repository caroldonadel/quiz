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
    private $foiRespondido = null;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $idQuiz = $request->getQueryParams()['id'];
        $idUser = $request->getQueryParams()['idUser'];

        $quiz = new QuizModel();
        $quiz->setIdQuizzes($idQuiz);
        $quiz->carregar();

        $perguntas = new PerguntasModel();
        $perguntas->setIdquiz($quiz->getIdQuizzes());
        $lista = $perguntas->listar();//todas as perguntas do quiz

        $alternativas = new AlternativasModel();
        $alternativas->setIdperguntas($lista[0]['idperguntas']);
        $listaAlternativas = $alternativas->listarPorPergunta();//todas as alternativas da PRIMEIRA pergunta

        foreach($listaAlternativas as $alternativa){

            $respostaExiste = new RespostaModel();
            $respostaExiste->setIdusuarios($idUser);
            $respostaExiste->setIdalternativas($alternativa['idalternativas']);
//          $existe = $respostaExiste->carregar();
//          $respostaExiste->carregar();

            if(!is_null($respostaExiste->carregar())){
//            if($alternativa['idalternativas'] === $respostaExiste->getIdalternativas()){
                $this->foiRespondido = "sim";
                break;
            }

//            else{
//                $this->foiRespondido = "nao";
//                echo $this ->foiRespondido;
//                break
//            }
        }

        if(is_null($this->foiRespondido)) {
            $html = $this->renderizaHtml('quiz/mostra-quiz.php', [
                'titulo' => $quiz->getTitulo(),
                'idquiz' => $quiz->getIdQuizzes(),
                'idUser' => $idUser,
                'listaPerguntas' => $lista,
                'listaAlternativas' => $listaAlternativas
            ]);
            return new Response(200, [], $html);
        }
         else{
            $_SESSION['idquiz'] = $idQuiz;
            $_SESSION['idUser'] = $idUser;

            return new Response(200, ['Location'=> '/quiz/public/resultado-existe']);
         }
    }
}
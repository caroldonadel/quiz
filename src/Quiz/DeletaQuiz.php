<?php


namespace Quiz\Armazenamento\Quiz;

use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};
use Nyholm\Psr7\Response;
use Psr\Http\Server\RequestHandlerInterface;

class DeletaQuiz implements RequestHandlerInterface
{

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
    $quiz = new QuizModel();
    $idquiz = $request->getQueryParams()['id'];
    $quiz->setIdQuizzes($idquiz);

    $idPerguntas = [];
    $perguntas = new PerguntasModel();
    $perguntas->setIdquiz($idquiz);
    $perguntasDoQuiz = $perguntas->listar();

    foreach ($perguntasDoQuiz as $pergunta){
        array_push($idPerguntas, $pergunta['idperguntas']); //array com todos os ids de perguntas do quiz
    }

    $idAlternativas = [];
    $alternativas = new AlternativasModel();

    foreach ($idPerguntas as $pergunta){  //pra cada pergunta
        $alternativas->setIdperguntas($pergunta);
        $alternativas->listarPorPergunta();
        array_push($idAlternativas, $alternativas->listarPorPergunta()); //lista todas as alternativas da pergunta

        foreach ($idAlternativas[0] as $alternativa){ //pra cada alternativa da pergunta
            $respostas = new RespostaModel();
            $idAlternativa = $alternativa['idalternativas'];
            $respostas->setIdalternativas($idAlternativa);
            $respostas->excluir(); //exclui as respostas que escolheram a alternativa da vez
            $alternativas->excluir();//exclui a alternativa
        }

        $idAlternativas = [];
    }

    var_dump($perguntasDoQuiz);

        foreach ($perguntasDoQuiz as $pergunta){//exclui as perguntas
//            array_push($idPerguntas, $pergunta['idperguntas']);
        $perguntas->setIdquiz($idquiz);
        $perguntas->excluir();
        }

        $quiz->excluir(); //exclui o quiz

        return new Response(200, ['Location' => '/inicio']);
//        return new Response(200, []);
    }
}
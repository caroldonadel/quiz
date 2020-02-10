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
        array_push($idPerguntas, $pergunta['idperguntas']);
//        $perguntas->setIdquiz($pergunta['idperguntas']);
//        $perguntas->excluir();
    }

    $idAlternativas = [];
    $alternativas = new AlternativasModel();

    foreach ($idPerguntas as $pergunta){
        $alternativas->setIdperguntas($pergunta);
        $alternativas->listarPorPergunta();
        array_push($idAlternativas, $alternativas->listarPorPergunta());

        foreach ($idAlternativas[0] as $alternativa){
            $respostas = new RespostaModel();
            $idAlternativa = $alternativa['idalternativas'];
            $respostas->setIdalternativas($idAlternativa);
            $respostas->excluir();
        }
        $idAlternativas = [];
    }

        $quiz->excluir();
//        return new Response(200, ['Location' => '/quiz/public/inicio']);
        return new Response(200, []);
    }
}
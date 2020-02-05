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

        $idUser = $request->getQueryParams()['idUser'];

        $quiz = new QuizModel();
        $quiz->setIdQuizzes($idQuiz);
        $quiz->carregar();

        $perguntas = new PerguntasModel();
        $perguntas->setIdquiz($quiz->getIdQuizzes());
        $lista = $perguntas->carregar();

        $alternativas = new AlternativasModel();
        $alternativas->setIdperguntas($lista[0]['idperguntas']);
        $listaAlternativas = $alternativas->listar();

        $html =  $this->renderizaHtml('quiz/mostra-quiz.php', [
            'titulo' => $quiz->getTitulo(),
            'idquiz' => $quiz->getIdQuizzes(),
            'idUser' => $idUser,
            'listaPerguntas' => $lista,
            'listaAlternativas' => $listaAlternativas
        ]);

        return new Response(200, [], $html);
    }
}
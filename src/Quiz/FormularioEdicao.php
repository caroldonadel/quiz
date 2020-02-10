<?php


namespace Quiz\Armazenamento\Quiz;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Quiz\Armazenamento\Helper\RenderizadorDeHtmlTrait;

class FormularioEdicao implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $idquiz = $request->getQueryParams()['id'];
        $quiz = new QuizModel();
        $quiz->setIdQuizzes($idquiz);
        $quiz->carregar();

        $perguntas = new PerguntasModel();
        $perguntas->setIdquiz($idquiz);
        $listaPerguntas = $perguntas->listar();

        $alternativas = new AlternativasModel();
        $listaAlternativas = $alternativas->listar();

        $html =  $this->renderizaHtml('quiz/edita-quiz.php', [
            'titulo' => 'Editar Quiz',
            'idquiz'=> $quiz->getIdQuizzes(),
            'tituloQuiz' => $quiz->getTitulo(),
            'listaPerguntas' => $listaPerguntas,
            'listaAlternativas' => $listaAlternativas
        ]);

        return new Response(200, [], $html);
    }
}
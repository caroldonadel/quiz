<?php


namespace Quiz\Armazenamento\Quiz;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Quiz\Armazenamento\Helper\RenderizadorDeHtmlTrait;

class FormularioQuiz implements RequestHandlerInterface
{

    use RenderizadorDeHtmlTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $quizzes = new QuizModel();

        $html =  $this->renderizaHtml('quiz/formulario-novo-quiz.php', [
            'titulo' => 'Novo Quiz',
            'idUsuario' => $request->getQueryParams()['id'],
            'lista' => $quizzes->listar()
//            'tituloUltimoQuiz' => $quizzes->getTituloUltimoAdicionado()
        ]);

        return new Response(200, [], $html);
    }
}
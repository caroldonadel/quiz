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
        $html =  $this->renderizaHtml('quiz/formulario-novo-quiz.php', [
            'titulo' => 'Novo Quiz'
        ]);

        return new Response(200, [], $html);
    }
}
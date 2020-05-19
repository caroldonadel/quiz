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
    private bool $errada;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        $quiz = new QuizModel();
        $idquiz = $request->getQueryParams()['idquiz'];
        $quiz->setIdQuizzes($idquiz);
        $quiz->carregar();

        $iduser = $request->getQueryParams()['iduser'];

        $perguntas = new PerguntasModel();
        $perguntas->setIdquiz($idquiz);
        $perguntas = $perguntas->listar();

        $respostas = new RespostaModel();
        $respostas->setIdusuarios($iduser);
        $respostas = $respostas->listar();

        $listaAlternativas = [];

        foreach ($perguntas as &$pergunta) {

            $this->errada = false;
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

            foreach ($respostas as $resposta) {

                if ($this->errada === true) {
                    continue;
                }

                if ($resposta['idalternativas'] === $idCorreta) {
                    $this->ehIgual = true;
                } else {
                    $this->ehIgual = false;
                }

                foreach ($listaAlternativasMerge as &$alternativa) {

                    if (($alternativa['idalternativas'] === $resposta['idalternativas']) &&
                        ($resposta['idalternativas'] <> $idCorreta)) {

                        $alternativa['escolhidaErrada'] = 1;
                        $this->errada = true;

                    } elseif ($alternativa['idalternativas'] === $idCorreta
                        || ($alternativa['idalternativas'] === $idCorreta
                            && $alternativa['idalternativas'] === $resposta['idalternativas'])) {

                        $alternativa['respostaCerta'] = 1;

                    }

                }

            }
            $pergunta['listaDeAlternativas'] = $listaAlternativasMerge;
            $listaAlternativas = [];
        }

        $html = $this->renderizaHtml('users/resultado-quiz.php', [
            'titulo' => $quiz->getTitulo(),
            'perguntas' => $perguntas,
            'respostas' => $respostas,
            'correta' => $alternativaCorreta
        ]);

        return new Response(200, [], $html);
    }
}



<?php

namespace Quiz\Armazenamento\Helper;

trait RenderizadorDeHtmlTrait
{
    public function renderizaHtml(string $caminhoTemplate, array $dados): string
    {
        extract($dados);
        //output buffer - buffer de saída de dados para a aplicação, só faz isso apos o buffer ser encerrado
        ob_start();
        require __DIR__ . '/../../view/' . $caminhoTemplate;
        $html = ob_get_clean(); // Obtém o conteudo do buffer e exclui o buffer de saída atual

        return $html;
    }
}
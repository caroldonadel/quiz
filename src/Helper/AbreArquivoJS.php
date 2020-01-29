<?php

namespace Quiz\Armazenamento\Helper;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
include __DIR__ . '/../../js/principal.js';


class AbreArquivoJS implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        echo '<script> addQuizAjax() </script>';

        return new Response(200, []);
    }
}
<?php

require __DIR__ . '/../vendor/autoload.php';

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
//use Psr\Container\ContainerInterface;
//use Psr\Http\Server\RequestHandlerInterface;
//use Quiz\Armazenamento\User\Home;

$caminho = $_SERVER['REQUEST_URI'];
$rotas = require __DIR__ . '/../config/routes.php';

echo $caminho;
echo var_dump($_SERVER);

$psr17Factory = new Psr17Factory();

$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);

$serverRequest = $creator->fromGlobals();

switch ($caminho) {
    case '/home':
        $classeControladora = $rotas[$caminho];
        $controlador = new $classeControladora();
        break;
    default:
        echo "Erro 404";
        break;
}

$resposta = $controlador->handle($serverRequest);

echo $resposta->getBody();




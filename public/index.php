<?php

require __DIR__ . '/../vendor/autoload.php';

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
//use Psr\Container\ContainerInterface;
//use Psr\Http\Server\RequestHandlerInterface;
//use Quiz\Armazenamento\User\Home;

$caminho = $_SERVER['REQUEST_URI'];
//echo $caminho;
$rotas = require __DIR__ . '/../config/routes.php';

if (!array_key_exists($caminho, $rotas)) {
    http_response_code(404);
    exit();
}

//session_start();
//
//$ehRotaDeLogin = stripos($caminho, 'login');
//if (!isset($_SESSION['logado']) && $ehRotaDeLogin === false) {
//    header('Location: /login');
//    exit();
//}

$psr17Factory = new Psr17Factory();

$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);

$serverRequest = $creator->fromGlobals();

$classeControladora = $rotas[$caminho];
$controlador = new $classeControladora();
$resposta = $controlador->handle($serverRequest);

echo $resposta->getBody();




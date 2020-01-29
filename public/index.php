<?php

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Quiz\Armazenamento\User\UserModel;
//use Psr\Http\Server\RequestHandlerInterface;

//UserModel::CarregaAdmin();

$caminho = $_SERVER['REQUEST_URI'];
$rotas = require __DIR__ . '/../config/routes.php';

if (!array_key_exists($caminho, $rotas)) {
    http_response_code(404);
    exit();
}

session_start();

$ehRotaDeLogin = stripos($caminho, 'login');
$ehNovoUser = stripos($caminho, 'user');
if (!isset($_SESSION['logado']) && $ehRotaDeLogin === false && $ehNovoUser === false) {
    header('Location: /quiz/public/login');
    exit();
}

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

foreach ($resposta->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $resposta->getBody();




<?php

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;

//use Psr\Http\Server\RequestHandlerInterface;

//UserModel::CarregaAdmin();

$caminho = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$rotas = require __DIR__ . '/../config/routes.php';

if (!array_key_exists($caminho, $rotas)) {
    http_response_code(404);
    exit();
}

session_start();

$ehRotaDeLogin = stripos($caminho, 'login');
$ehNovoUser = stripos($caminho, 'user');
$ehHome = "/";

if ((!isset($_SESSION['logado']) || $_SESSION['logado']===false)
    && $ehRotaDeLogin === false && $ehNovoUser === false && $caminho !== $ehHome) {
//    && $ehRotaDeLogin === false && $ehNovoUser === false && $ehHome === false) {
//if (!isset($_SESSION['logado']) && $ehRotaDeLogin === false && $ehNovoUser === false && $ehHome ===false) {
    header('Location: /login');
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
///** @var RequestHandlerInterface $controlador */
$controlador = new $classeControladora();
$resposta = $controlador->handle($serverRequest);

foreach ($resposta->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $resposta->getBody();




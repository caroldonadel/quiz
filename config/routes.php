<?php

use Quiz\Armazenamento\User\{
    CadastraUsuario,
    Deslogar,
    FormularioUser,
    Home,
    FormularioLogin,
    Inicio,
    RealizarLogin};
use Quiz\Armazenamento\Quiz\{FormularioQuiz, SalvarPerguntas, SalvarQuiz};
use Quiz\Armazenamento\Helper\AbreArquivoJS;


return [
    '/quiz/public/home' => Home::class,
    '/quiz/public/inicio' => Inicio::class,
    '/quiz/public/login' => FormularioLogin::class,
    '/quiz/public/realiza-login' => RealizarLogin::class,
    '/quiz/public/novo-user' => FormularioUser::class,
    '/quiz/public/cadastra-user' => CadastraUsuario::class,
    '/quiz/public/logout' => Deslogar::class,
    '/quiz/public/novo-quiz' => FormularioQuiz::class,
    '/quiz/public/cadastra-quiz' => SalvarQuiz::class,
    '/quiz/public/principal' => AbreArquivoJS::class,
    '/quiz/public/cadastra-perguntas' => SalvarPerguntas::class
];


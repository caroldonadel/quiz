<?php

use Quiz\Armazenamento\User\{CadastraUsuario, Deslogar, FormularioUser, Home, FormularioLogin, RealizarLogin};
use Quiz\Armazenamento\Quiz\FormularioQuiz;

return [
    '/quiz/public/home' => Home::class,
    '/quiz/public/login' => FormularioLogin::class,
    '/quiz/public/realiza-login' => RealizarLogin::class,
    '/quiz/public/novo-user' => FormularioUser::class,
    '/quiz/public/cadastra-user' => CadastraUsuario::class,
    '/quiz/public/logout' => Deslogar::class,
    '/quiz/public/novo-quiz' => FormularioQuiz::class
];


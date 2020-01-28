<?php

use Quiz\Armazenamento\User\{CadastraUsuario, Deslogar, FormularioUser, Home, Formulario, RealizarLogin};

return [
    '/quiz/public/home' => Home::class,
    '/quiz/public/login' => Formulario::class,
    '/quiz/public/realiza-login' => RealizarLogin::class,
    '/quiz/public/novo-user' => FormularioUser::class,
    '/quiz/public/cadastra-user' => CadastraUsuario::class,
    '/quiz/public/logout' => Deslogar::class
];


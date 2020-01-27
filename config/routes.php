<?php

use Quiz\Armazenamento\User\{Home, Formulario};

return [
    '/quiz/public/home' => Home::class,
    '/quiz/public/login' => Formulario::class
];
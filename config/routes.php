<?php

use Quiz\Armazenamento\User\{
    CadastraUsuario,
    Deslogar,
    FormularioUser,
    Home,
    FormularioLogin,
    Inicio,
    RealizarLogin};
use Quiz\Armazenamento\Quiz\{
    CalculaResultado,
    CalculaResultadoExistente,
    DeletaQuiz,
    FormularioEdicao,
    FormularioQuiz,
    MostraQuiz,
    MostraResultado,
    ProximaPergunta,
    SalvarAlternativas,
    SalvarPerguntas,
    SalvarQuiz,
    SalvarRespostas};
use Quiz\Armazenamento\Helper\AbreScriptEditaQuiz;
use Quiz\Armazenamento\Helper\AbreScriptMostraQuiz;
use Quiz\Armazenamento\Helper\AbreScriptNovoQuiz;

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
    '/quiz/public/principal' => AbreScriptNovoQuiz::class,
    '/quiz/public/cadastra-perguntas' => SalvarPerguntas::class,
    '/quiz/public/cadastra-alternativas' => SalvarAlternativas::class,
    '/quiz/public/quiz' => MostraQuiz::class,
    '/quiz/public/mostra-quiz' => AbreScriptMostraQuiz::class,
    '/quiz/public/proxima-pergunta' => ProximaPergunta::class,
    '/quiz/public/cadastra-respostas' => SalvarRespostas::class,
    '/quiz/public/resultado' => CalculaResultado::class,
    '/quiz/public/mostra-resultado' => MostraResultado::class,
    '/quiz/public/resultado-existe' => CalculaResultadoExistente::class,
    '/quiz/public/exclui-quiz' => DeletaQuiz::class,
    '/quiz/public/edita-quiz' => FormularioEdicao::class,
    '/quiz/public/edicao' => AbreScriptEditaQuiz::class,
];


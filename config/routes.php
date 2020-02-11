<?php

use Quiz\Armazenamento\User\{
    CadastraUsuario,
    Deslogar,
    FormularioUser,
    Home,
    FormularioLogin,
    Inicio,
    RealizarLogin};
use Quiz\Armazenamento\Quiz\{CalculaResultado,
    CalculaResultadoExistente,
    DeletaQuiz,
    EditaAlternativas,
    EditaPerguntas,
    EditaQuiz,
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
    '/' => Home::class,
    '/inicio' => Inicio::class,
    '/login' => FormularioLogin::class,
    '/realiza-login' => RealizarLogin::class,
    '/novo-user' => FormularioUser::class,
    '/cadastra-user' => CadastraUsuario::class,
    '/logout' => Deslogar::class,
    '/novo-quiz' => FormularioQuiz::class,
    '/cadastra-quiz' => SalvarQuiz::class,
    '/principal' => AbreScriptNovoQuiz::class,
    '/cadastra-perguntas' => SalvarPerguntas::class,
    '/cadastra-alternativas' => SalvarAlternativas::class,
    '/quiz' => MostraQuiz::class,
    '/mostra-quiz' => AbreScriptMostraQuiz::class,
    '/proxima-pergunta' => ProximaPergunta::class,
    '/cadastra-respostas' => SalvarRespostas::class,
    '/resultado' => CalculaResultado::class,
    '/mostra-resultado' => MostraResultado::class,
    '/resultado-existe' => CalculaResultadoExistente::class,
    '/exclui-quiz' => DeletaQuiz::class,
    '/edita-quiz' => FormularioEdicao::class,
    '/edicao' => AbreScriptEditaQuiz::class,
    '/edita-alternativas' => EditaAlternativas::class,
    '/edita-perguntas' => EditaPerguntas::class,
    '/edicao-quiz' => EditaQuiz::class
];


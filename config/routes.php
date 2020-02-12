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
    ExcluiAlternativa,
    ExcluiPergunta,
    FormularioEdicao,
    FormularioQuiz,
    MostraQuiz,
    MostraResultado,
    ProximaPergunta,
    SalvarAlternativas,
    SalvarPerguntas,
    SalvarQuiz,
    SalvarRespostas};


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
    '/cadastra-perguntas' => SalvarPerguntas::class,
    '/cadastra-alternativas' => SalvarAlternativas::class,
    '/quiz' => MostraQuiz::class,
    '/proxima-pergunta' => ProximaPergunta::class,
    '/cadastra-respostas' => SalvarRespostas::class,
    '/resultado' => CalculaResultado::class,
    '/mostra-resultado' => MostraResultado::class,
    '/resultado-existe' => CalculaResultadoExistente::class,
    '/exclui-quiz' => DeletaQuiz::class,
    '/edita-quiz' => FormularioEdicao::class,
    '/edita-alternativas' => EditaAlternativas::class,
    '/edita-perguntas' => EditaPerguntas::class,
    '/edicao-quiz' => EditaQuiz::class,
    '/exclui-pergunta' => ExcluiPergunta::class,
    '/exclui-alternativa' => ExcluiAlternativa::class
];


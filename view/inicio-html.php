<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<!--<h1> --><?//=  $_SESSION['logado'] ?><!-- </h1>-->
<?php if (($_SESSION['logado']===true)): ?>
    <nav class="navbar navbar-dark bg-dark mb-2">
        <ul class="nav justify-content-center">

            <li class="nav-item active">
                <a class="navbar-brand" href="/quiz/public/inicio">Início</a>
            </li>

            <li class="nav-item active">
                <a class="navbar-brand" href="/quiz/public/logout">Sair</a>
            </li>

        </ul>
    </nav>
<?php endif; ?>

<div class="container" >
    <div class="card text-white bg-info mb-3" style="width: 100%">
        <div class="card-body">
            <h1><?= $titulo; ?></h1>
        </div>
    </div>
    <div id="divAlerta" class="alert" style="margin: 0">
    <?php if (isset($_SESSION['mensagem'])): ?>
            <?= $_SESSION['mensagem']; ?>
    <?php
        unset($_SESSION['mensagem']);
        unset($_SESSION['tipo_mensagem']);
    endif;
    ?>
    </div>


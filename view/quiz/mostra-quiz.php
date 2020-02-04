<?php include __DIR__ . '/../inicio-html.php';?>
<input type="hidden" value="<?= $idquiz?>" id="idUsuario">

<!--REMOVER ESSAS DIVS PQ ESSAS LISTAS SO SERAO USADAS UMA VEZ-->
<div id="dom-target1" style="display: none;">
    <?php
    $listaPerg = $listaPerguntas;
    ?>
</div>
<div id="dom-target2" style="display: none;">
    <?php
    $lista = $listaAlternativas;
    ?>
</div>
<!--SELECIONA O P NO AJAX E ATUALIZA PRO PRIMEIRO VALOR DA LISTA DE PERGUNTAS APOS O CONTROLLER REMOVER A PERGUNTA 1-->
<p> <?= $listaPerguntas[0]['titulo'] ?>   <p/>
<!--SELECIONA O UL NO AJAX, E LA DAR UM FOREACH NA LISTA DE ALTERNATIVAS E CRIA OS ELEMENTOS HTML-->
<!--PRIMEIRO REMOVER TODOS OS LI QUE JA ESTARAO ALI DENTRO-->
<!--FAZER O INDICE NO CONTROLLER MANTER SEU VALOR INCREMENTADO ENTRE CHAMADAS-->
<ul>
    <?php foreach ($lista as $alternativa) :
//        foreach ($alternativa as $alt) :
        if ($alternativa['idperguntas'] = $listaPerguntas[0]['idperguntas']){
            ?>

        <input type="radio">
        <li> <?= $alternativa['descricao']; ?> </li>

        <?php }
//        endforeach;
        endforeach; ?>
    </ul>

<button> Próxima Pergunta</button>

<script type="text/javascript" src= "/quiz/public/mostra-quiz"></script>

<!-- no script js por um event listener com uma função AJAX que pode fazer request-->
<!--novamente para mostraQuiz e da um unset[0] no array de perguntas-->

<!--    html com script tag-->





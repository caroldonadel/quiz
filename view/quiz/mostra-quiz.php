<?php include __DIR__ . '/../inicio-html.php';?>

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

<p> <?= $listaPerguntas[0]['titulo'] ?>   <p/>
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





<?php include __DIR__ . '/../inicio-html.php';?>
<div id="conteudo">
<input type="hidden" value="<?= $idquiz?>" id="idQuiz">
<input type="hidden" value="<?= $idUser?>" id="idUser">

<p> <?= $listaPerguntas[0]['titulo'] ?>   <p/>
<input type="hidden" value="<?= $listaPerguntas[0]['idperguntas']?>" id="idPergunta">

<ul id="listaAlt">

    <?php foreach ($listaAlternativas as $alternativa) :
        if ($alternativa['idperguntas'] = $listaPerguntas[0]['idperguntas']){ ?>

        <input type="radio" class="radio" id="<?= $alternativa['idalternativas']?>">
        <li> <?= $alternativa['descricao']; ?> </li>

        <?php }
        endforeach; ?>

</ul>

<button id="botaoProxima"> Próxima Pergunta</button>
</div>
<script type="text/javascript" src= "/quiz/public/mostra-quiz"></script>






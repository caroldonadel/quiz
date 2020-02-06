<?php include __DIR__ . '/../inicio-html.php';?>
<div id="conteudo">
<input type="hidden" value="<?= $idquiz?>" id="idQuiz">
<input type="hidden" value="<?= $idUser?>" id="idUser">

<!--<div class="card border-info mb-3" >-->
<!--    <div class="card-body">-->
        <h2 class="card-title text-center"> <?= $listaPerguntas[0]['titulo'] ?>   </h2>
<!--    </div>-->
<!--</div>-->
<input type="hidden" value="<?= $listaPerguntas[0]['idperguntas']?>" id="idPergunta">
<div class="form-group">
<ul id="listaAlt" class="list-group">

    <?php foreach ($listaAlternativas as $alternativa) :
        if ($alternativa['idperguntas'] = $listaPerguntas[0]['idperguntas']){ ?>

<!--        <input type="radio" class="radio" id="--><?//= $alternativa['idalternativas']?><!--">-->
<!--        <li class="list-group-item alternativa"> --><?//= $alternativa['descricao']; ?><!-- </li>-->
            <button type="button" id="<?= $alternativa['idalternativas']?>" class="list-group-item list-group-item-action alternativa"><?= $alternativa['descricao']; ?></button>

        <?php }
        endforeach; ?>

</ul>
</div>
<button type="button"  class="btn btn-light" id="botaoProxima"> Próxima Pergunta</button>
</div>
<script type="text/javascript" src= "/quiz/public/mostra-quiz"></script>






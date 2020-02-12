<?php include __DIR__ . '/../inicio-html.php';?>
<div id="conteudo">
<input type="hidden" value="<?= $idquiz?>" id="idQuiz">
<input type="hidden" value="<?= $idUser?>" id="idUser">
<input type="hidden" value="nao-respondido" id="quiz-respondido">


        <h2 class="card-title text-center"> <?= $listaPerguntas[0]['titulo'] ?>   </h2>

<input type="hidden" value="<?= $listaPerguntas[0]['idperguntas']?>" id="idPergunta">
<div class="form-group">
<div id="listaAlt" class="list-group">

    <?php foreach ($listaAlternativas as $alternativa) :
        if ($alternativa['idperguntas'] = $listaPerguntas[0]['idperguntas']){ ?>

            <button type="button" id="<?= $alternativa['idalternativas']?>"class="list-group-item list-group-item-action"
                    name="alternativa">
            <?= $alternativa['descricao']; ?></button>

        <?php }
        endforeach; ?>

</div>
</div>
<button type="button"  class="btn btn-light" id="botaoProxima"> Próxima Pergunta</button>
</div>
<script type="text/javascript" src= "/js/script-mostra-quiz.js"></script>






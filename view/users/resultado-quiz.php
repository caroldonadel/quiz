<?php include __DIR__ . '/../inicio-html.php'; ?>

<h1 class="card-title text-center"> <?= $tituloQuiz ?> </h1>

<?php foreach ($perguntas as $pergunta) : ?>
    <fieldset>
    <h1 class="card-title"> <?= $pergunta['titulo']; ?>
    <fieldset>
        <ul>
            <?php foreach($alternativas as $alternativa) : ?>

                <?php if ($alternativa['idperguntas'] === $pergunta['idperguntas']) :

                    if (array_key_exists("escolhida", $alternativa)) :?>

                        <li class="escolhida"><?= $alternativa['descricao'] ?></li>

                    <?php else : ?>

                        <li> <?= $alternativa['descricao'] ?></li>

                <?php endif; ?>
            <?php endif; ?>
          <?php endforeach; ?>
            </ul>
    </fieldset>
</fieldset>
<?php endforeach;?>





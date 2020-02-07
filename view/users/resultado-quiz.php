<?php include __DIR__ . '/../inicio-html.php'; ?>

<h1 class="card-title text-center"> <?= $tituloQuiz ?> </h1>

<?php foreach ($perguntas as $pergunta) : ?>
    <fieldset>
    <h1 class="card-title"> <?= $pergunta['titulo']; ?>
    <fieldset>
        <ul>
            <?php foreach($pergunta['listaDeAlternativas'] as $alternativa) : ?>
                <?php if (array_key_exists("respostaCerta", $alternativa)) {
                    ?>

                        <li class="respostaCerta"><?= $alternativa['descricao'] ?></li>
                <?php }
                elseif(array_key_exists("escolhidaErrada", $alternativa)) { ?>

                        <li class="escolhidaerrada"> <?= $alternativa['descricao'] ?></li>
                <?php }

            endforeach; ?>
        </ul>
    </fieldset>
</fieldset>
<?php endforeach;?>





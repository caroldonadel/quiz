<?php include __DIR__ . '/../inicio-html.php'; ?>

<?php foreach ($perguntas as $pergunta) : ?>
    <fieldset>
    <div  class ="form-group">
    <h1 class="text-center"> <?= $pergunta['titulo']; ?></h1>
    </div>
    <fieldset>
        <ul class="list-group">
            <?php foreach($pergunta['listaDeAlternativas'] as $alternativa) : ?>

                <?php if (array_key_exists("respostaCerta", $alternativa)) { ?>

                        <li class="font-weight-bold list-group-item text-left text-success respostaCerta"><?= $alternativa['descricao'] ?></li>

                <?php }

                 elseif (array_key_exists("escolhidaErrada", $alternativa)) { ?>

                    <li class="font-weight-bold list-group-item text-left text-danger escolhidaErrada"> <?= $alternativa['descricao'] ?></li>

                <?php }else { ?>

                    <li class="font-weight-bold list-group-item text-left"> <?= $alternativa['descricao'] ?></li>

                <?php }

            endforeach; ?>
        </ul>
    </fieldset>
</fieldset>
<?php endforeach;?>

<!--<script type="text/javascript" src= ""></script>-->

</body>
</html>




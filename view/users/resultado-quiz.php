<!--<h1> --><?//= var_dump($respostas) ?><!-- </h1>-->
<h1> <?= var_dump($correta) ?> </h1>


<h1> <?= var_dump($respostas) ?> </h1>


<h1> <?= $titulo ?> </h1>


<h1> <?= $tituloQuiz ?> </h1>

<?php foreach ($perguntas as $pergunta) { ?>
<fieldset>
    <h1> <?= $pergunta['titulo']; ?>
        <fieldset>
            <ul>
<!--php foreach na lista de alternativas-->
<!--                if alternativa contem a key escolhida-->
<!--                <li class=escolhida>descricao alternativa</li>-->
<!--                else-->
                <!--                <li class=escolhida>descricao alternativa</li>-->


            </ul>
        </fieldset>
</fieldset>
<?php } ?>

<h1> <?php var_dump($alternativas); ?> </h1>


        <!--'perguntas' => $perguntasQuiz,-->
<!--'alternativas' =>$listaAlternativas-->


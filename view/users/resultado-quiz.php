<h1> <?= var_dump($respostas) ?> </h1>


<h1> <?= $titulo ?> </h1>


<h1> <?= $tituloQuiz ?> </h1>

<?php foreach ($perguntas as $pergunta) { ?>
    <h1> <?= $pergunta['titulo']; ?>
<?php } ?>

<h1> <?php var_dump($alternativas); ?> </h1>


        <!--'perguntas' => $perguntasQuiz,-->
<!--'alternativas' =>$listaAlternativas-->


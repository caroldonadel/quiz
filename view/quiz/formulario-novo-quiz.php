<?php include __DIR__ . '/../inicio-html.php'; ?>

<fieldset id="formularioQuiz">
<div class="form-group">
    <label for="inputAddress">Título do Quiz</label>
    <input type="text" name="nome" class="form-control w-50" id="inputAddress" placeholder="Novo quiz" maxlength="70">
    <input type="hidden" value="<?php echo $idUsuario; ?>" id="idUsuario">
</div>
    <div id="listaPerguntas">
        <div class="form-group">
            <button id="botaoAddPergunta" class="btn btn-outline-info">Criar pergunta</button>
        </div>
    </div>

</fieldset>

<div class="d-flex justify-content-center">
<button id="botaoAddQuiz" class="btn btn-outline-info btn-lg mb-2 ">Salvar Quiz</button>
</div>

<script type="text/javascript" src= "/js/script-criacao-quiz.js"></script>

</body>
</html>
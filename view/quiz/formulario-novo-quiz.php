<?php include __DIR__ . '/../inicio-html.php'; ?>

<fieldset>
<div class="form-group">
    <label for="inputAddress">Título do Quiz</label>
    <input type="text" name="nome" class="form-control" id="inputAddress">
    <input type="hidden" value="<?= $idUsuario ?>" id="idUsuario">
</div>
    <fieldset id="listaPerguntas">
        <div class="form-group">
            <button id="botaoAddPergunta" class="btn btn-primary">Criar pergunta</button>


        </div>
    </fieldset>
</fieldset>

<div class="form-group">
<button id="botaoAddQuiz" class="btn btn-primary">Salvar Quiz</button>
</div>

<script type="text/javascript" src= "/quiz/public/principal"></script>

</body>
</html>
<?php include __DIR__ . '/../inicio-html.php'; ?>


<!--<form action="/quiz/public/cadastra-quiz" method="post">-->

<div class="form-group">
    <label for="inputAddress">Título do Quiz</label>
    <input type="text" name="nome" class="form-control" id="inputAddress">
    <input type="hidden" value="<?= $idUsuario ?>" id="idUsuario">
</div>
    <button type="submit" id="botaoAddQuiz" class="btn btn-primary">Salvar Quiz</button>

<script type="text/javascript" src= "/quiz/public/principal"></script>
<!--<script type="text/javascript" src= "/../../js/principal.js"></script>-->
<!--<script type="text/javascript" src= "/../../src/Helper/principal.js"></script>-->
<!--</form>-->

</body>
</html>
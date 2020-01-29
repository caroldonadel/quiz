<?php include __DIR__ . '/../inicio-html.php'; ?>

<form action="/quiz/public/cadastra-user" method="post">
    <div class="form-group">
        <label for="inputAddress">Título do Quiz</label>
        <input type="text" name="nome" class="form-control" id="inputAddress">
    </div>
       <button type="submit" class="btn btn-primary">Salvar Quiz</button>
</form>
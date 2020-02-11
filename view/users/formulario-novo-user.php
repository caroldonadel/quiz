<?php include __DIR__ . '/../inicio-html.php'; ?>

<form action="/cadastra-user" method="post">
    <div class="form-group">
        <label for="inputAddress">Nome Completo</label>
        <input type="text" name="nome" class="form-control" id="inputAddress">
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputEmail4">Email</label>
            <input type="email" name="email" class="form-control" id="inputEmail4">
        </div>
        <div class="form-group col-md-6">
            <label for="inputPassword4">Senha</label>
            <input type="password" name="senha" class="form-control" id="inputPassword4">
        </div>
    </div>
    <span>
        <button type="submit" class="btn btn-primary">Cadastrar</button>

        <a href="/login" class="btn btn-primary">
            Voltar para login
        </a>

<!--        <a href="/home" class="btn btn-primary">-->
<!--            Home-->
<!--        </a>-->
     </span>
</form>
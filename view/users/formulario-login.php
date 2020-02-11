<?php include __DIR__ . '/../inicio-html.php'; ?>

<form action="/realiza-login" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Senha</label>
            <input type="password" name="senha" class="form-control" id="exampleInputPassword1">
        </div>
        <span>
            <button type="submit" class="btn btn-primary">Entrar</button>

            <a href="/novo-user" class="btn btn-primary">
                Novo Usuário
            </a>
         </span>
</form>
<h1> <?=  $_SESSION['logado'] ?> </h1>
</div>
</body>
</html>
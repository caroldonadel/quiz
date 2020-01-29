<?php include __DIR__ . '/../inicio-html.php'; ?>

<form action="/quiz/public/realiza-login" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="senha" class="form-control" id="exampleInputPassword1">
        </div>
        <span>
            <button type="submit" class="btn btn-primary">Submit</button>
        <a href="/quiz/public/novo-user" class="btn btn-primary">
            Novo Usuário
        </a>
         </span>
</form>

</div>
</body>
</html>
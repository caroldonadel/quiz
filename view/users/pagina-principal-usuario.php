<?php include __DIR__ . '/../inicio-html.php'; ?>

<div class="form-group">
<?php if($nivel === 'admin') { ?>
    <a href="/quiz/public/novo-quiz?id=<?= $idUsuario; ?>" class="btn btn-primary btn-lg btn-block">
        Novo Quiz
    </a>
<?php }else{ ?>
    <a href="/quiz/public/novo-quiz" class="btn btn-primary btn-lg btn-block disabled">
        Novo Quiz
    </a>
<?php  } ?>
</div>

<div class="form-group">

<ul class="list-group">
<?php foreach ($lista as $linha) : ?>
    <li class=" list-group-item d-flex justify-content-between">
        <a href="/quiz/public/quiz?id=<?= $linha['idquizzes'] ?>&idUser=<?= $idUsuario ?>" class="btn btn-primary btn-lg btn-block">
            <?= $linha['titulo'] ?>
        </a>
        <?php if($nivel === 'admin') { ?>
            <a href="/quiz/public/exclui-quiz?id=<?=$linha['idquizzes']?>" class="btn btn-danger">
                Deletar Quiz
            </a>
            <a href="/quiz/public/edita-quiz?id=<?=$linha['idquizzes']?>" class="btn btn-success">
                Editar Quiz
            </a>
        <?php }else{ ?>
            <a href="/quiz/public/exclui-quiz?id=<?=$linha['idquizzes']?>" class="btn btn-danger" disabled="">
                Deletar Quiz
            </a>
            <a href="/quiz/public/edita-quiz?id=<?=$linha['idquizzes']?>" class="btn btn-success">
                Editar Quiz
            </a>
        <?php  } ?>
    </li>
    <?php endforeach; ?>
</ul>
</div>

<input type="hidden" value="<?= $idUsuario?>" id="idUser">
</div>
</body>
</html>

<?php include __DIR__ . '/../inicio-html.php'; ?>

<div class="form-group d-flex align-items-center flex-row-reverse">
<?php if($nivel === 'admin') { ?>
    <a href="/novo-quiz?id=<?= $idUsuario; ?>" class="btn btn-primary btn-lg ">
        Novo Quiz
    </a>
<?php }else{ ?>
    <a href="/novo-quiz" class="btn btn-primary btn-lg disabled">
        Novo Quiz
    </a>
<?php  } ?>
</div>

<div class="form-group">

<ul class="list-group">
<?php foreach ($lista as $linha) : ?>
<!--    <div class=" list-group-item d-flex justify-content-between">-->
    <li class="list-group-item p-2 d-flex justify-content-end border border-primary rounded bg-light">
        <a href="/quiz?id=<?= $linha['idquizzes'] ?>&idUser=<?= $idUsuario ?>" class="btn btn-light btn-lg w-75">
            <?= $linha['titulo'] ?>
        </a>
        <?php if($nivel === 'admin') { ?>
            <a href="/exclui-quiz?id=<?=$linha['idquizzes']?>" class="btn btn-danger">
                Deletar
            </a>
            <a href="/edita-quiz?id=<?=$linha['idquizzes']?>" class="btn btn-success">
                Editar
            </a>
        <?php }else{ ?>
            <a href="/exclui-quiz?id=<?=$linha['idquizzes']?>" class="btn btn-danger" disabled="">
                Deletar
            </a>
            <a href="/edita-quiz?id=<?=$linha['idquizzes']?>" class="btn btn-success" disabled>
                Editar
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

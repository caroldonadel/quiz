<?php include __DIR__ . '/../inicio-html.php'; ?>

<div class="form-group d-flex  flex-row-reverse ">
<?php if($nivel === 'admin') { ?>
    <a href="/novo-quiz?id=<?= $idUsuario; ?>" class="btn btn-primary mr-2">
        Novo Quiz
    </a>
<?php } ?>

</div>

<div class="form-group">

<div class="list-group ">
<?php foreach ($lista as $linha) : ?>
    <div class=" d-flex justify-content-between  w-100 p-1 mb-2 mx-auto border border-light rounded bg-light">
        <a href="/quiz?id=<?= $linha['idquizzes'] ?>&idUser=<?= $idUsuario ?>" class="text-info my-auto w-75 h5 p-0">
            <?= $linha['titulo'] ?>
        </a>
        <span >
        <?php if($nivel === 'admin') { ?>
            <a href="/exclui-quiz?id=<?=$linha['idquizzes']?>" class="h4 btn btn-outline-danger m-0">
                Deletar
            </a>
            <a href="/edita-quiz?id=<?=$linha['idquizzes']?>" class="h4 btn btn-outline-success m-0">
                Editar
            </a>
        <?php } ?>
        </span>
    </div>
    <?php endforeach; ?>
</div>
</div>

<input type="hidden" value="<?= $idUsuario?>" id="idUser">
</div>
</body>
</html>

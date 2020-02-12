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
    <div class=" d-flex justify-content-end w-100 p-2 mb-2 border border-secondary rounded bg-light">
        <a href="/quiz?id=<?= $linha['idquizzes'] ?>&idUser=<?= $idUsuario ?>" class=" w-75 h4">
            <?= $linha['titulo'] ?>
        </a>
        <span class="borderd-inline-table-cell">
        <?php if($nivel === 'admin') { ?>
            <a href="/exclui-quiz?id=<?=$linha['idquizzes']?>" class="h4 btn btn-danger  m-0">
                Deletar
            </a>
            <a href="/edita-quiz?id=<?=$linha['idquizzes']?>" class="h4 btn btn-success  m-0">
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
        </span>
    </div>
    <?php endforeach; ?>
</ul>
</div>

<input type="hidden" value="<?= $idUsuario?>" id="idUser">
</div>
</body>
</html>

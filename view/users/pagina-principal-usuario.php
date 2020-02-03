<?php include __DIR__ . '/../inicio-html.php'; ?>

<ul class="list-group">
        <li class="list-group-item d-flex justify-content-between">
<?php if($nivel === 'admin') { ?>
            <a href="/quiz/public/novo-quiz?id=<?= $idUsuario; ?>" class="btn btn-primary btn-lg btn-block">
                Novo Quiz
            </a>
            <?php }else{ ?>
            <a href="/quiz/public/novo-quiz" class="btn btn-primary btn-lg btn-block disabled">
                Novo Quiz
            </a>
            <?php  } ?>
        </li>
<?php foreach ($lista as $linha) : ?>
    <li class="list-group-item d-flex justify-content-between">
        <a href="/quiz/public/quiz?id=<?= $linha['idquizzes'] ?>" class="btn btn-primary btn-lg btn-block">
            <?= $linha['titulo'] ?>
        </a>
    </li>
    <?php endforeach; ?>
</ul>

</div>
</body>
</html>

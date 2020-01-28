<?php include __DIR__ . '/../inicio-html.php'; ?>

<ul class="list-group">
    <?php foreach ($cursos as $curso): ?>
        <li class="list-group-item d-flex justify-content-between">

             <a href="/quiz/public/quiz?id=<?= $quiz->getId(); ?>" class="btn btn-info btn-sm">
                <?= $quiz->getTitulo(); ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

</div>
</body>
</html>

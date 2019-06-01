<?php

/**
 * @var app\models\tables\Tasks $model
 */
?>

<div class="task-preview">
    <a class="task-preview_link" href="/?r=task/preview&id=<?= $model->id ?>">
        <p class="task-preview_text">Название: <?= $model->name ?></p>
        <p class="task-preview_text">Статус: <?= $model->status->name ?></p>
        <p class="task-preview_text">Срок-до: <?= $model->deadline ?></p>
        <p class="task-preview_text">Ответстыенный: <?= $model->responsible->username ?></p>
    </a>
</div>
<style>
    .form-container form,
    .comments-container form,
    .upload-container form {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        width: 70%;
        margin: 0 auto;
        text-align: center;
    }

    .attachments-container,
    .flex-container,
    .all-attachments {
        display: flex;
        justify-content: space-between;
    }

    .comments-container,
    .upload-container {
        width: 49%;
    }

    .form-group {
        width: 32%;
    }

    .form-input {
        display: block;
        width: 100%;
        padding: 10px;
        text-align: center;
    }

    .field-tasks-description,
    .field-comments-comment,
    .field-attachmentsform-upload {
        width: 100%;
    }

    .field-attachmentsform-taskid {
        display: none;
    }

    .field-attachmentsform-upload {
        margin-top: 20px;
    }

    #attachmentsform-upload {
        margin: 0 auto;
        width: 100%;
        text-align: center;
        padding: 22px 20%;
        border: 1px solid #A9A9A9;
    }

    .field-tasks-responsible,
    .field-tasks-deadline {
        width: 35%;
    }

    .btn {
        width: 50%;
        margin: 0 auto;
        padding: 10px 0;
    }

    .all-attachments,
    .all-comments {
        width: 45%;
    }

    .all-attachments {
        flex-wrap: wrap;
    }
    .all-attachments a {
        margin: 10px;
    }

    hr {
        margin: 20px auto 0;
    }
</style>

<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\tables\Tasks;
use app\models\tables\Users;
use app\models\tables\Comments;
use app\models\forms\AttachmentsForm;

/**
 * @var Tasks $model
 * @var array $statuses
 * @var array $users
 * @var Comments $commentsForm
 * @var AttachmentsForm $attachmentsForm
 * @var Users $userId
 */
?>
<div class="form-container">
	<?php
	$task = ActiveForm::begin();

	echo $task
		->field($model, 'name')
		->textInput(['class' => 'form-input form-input__name']);

	echo $task
		->field($model, 'status_id')
		->dropDownList($statuses, ['class' => 'form-input form-input__status']);

	echo $task
		->field($model, 'creator_id')
		->dropDownList($users, ['class' => 'form-input form-input__creator']);

	echo $task
		->field($model, 'description')
		->textInput(['class' => 'form-input form-input__description']);

	echo $task
		->field($model, 'responsible_id')
		->dropDownList($users, ['class' => 'form-input form-input__responsible']);

	echo $task
		->field($model, 'deadline')
		->input('date', ['class' => 'form-input form-input__deadline']);

	echo Html::submitButton('Подтвердить', ['class' => 'btn btn-success']);

	ActiveForm::end();
	?>
</div>
<hr>

<?php if ($userId) : ?>
    <div class="attachments-container">
        <div class="comments-container">
			<?php
			$commentForm = ActiveForm::begin(['action' => Url::to(['task/save-comment'])]);

			echo $commentForm
				->field($commentsForm, 'task_id')
				->hiddenInput(['value' => $model->id])->label(false);

			echo $commentForm
				->field($commentsForm, 'user_id')
				->hiddenInput(['value' => $userId])->label(false);

			echo $commentForm
				->field($commentsForm, 'comment')
				->textarea(['class' => 'form-input form-input__description']);

			echo Html::submitButton('Добавить', ['class' => 'btn btn-default']);

			ActiveForm::end();
			?>
        </div>
        <div class="upload-container">
			<?php
			$uploadForm = ActiveForm::begin(['action' => Url::to(['task/save-attachment'])]);

			echo $uploadForm
				->field($attachmentsForm, 'taskId')
				->hiddenInput(['value' => $model->id])->label(false);

			echo $uploadForm
				->field($attachmentsForm, 'upload')
				->fileInput();

			echo Html::submitButton('Загрузить', ['class' => 'btn btn-default']);

			ActiveForm::end();
			?>
        </div>
    </div>
<?php endif; ?>
<hr>
<div class="flex-container">
    <div class="all-comments">
		<?php foreach ($model->comments as $comment) : ?>

            <p><i><b><?= $comment->user->username ?>: </b></i><?= $comment->comment ?></p>

		<?php endforeach; ?>
    </div>
    <div class="all-attachments">
		<?php foreach ($model->attachments as $attachment) : ?>

            <a href="/images/tasks/max/<?= $attachment->source ?>">
                <img src="/images/tasks/min/<?= $attachment->source ?>" alt="attached image">
            </a>

		<?php endforeach; ?>
    </div>
</div>
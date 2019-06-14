<style>
    .form-container form {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        width: 70%;
        margin: 0 auto;
        text-align: center;
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

    .field-tasks-description {
        width: 100%;
    }

    .field-tasks-responsible,
    .field-tasks-deadline {
        width: 35%;
    }

    .btn {
        width: 100%;
        padding: 10px;
    }
</style>

<?php

use \yii\widgets\ActiveForm;
use \app\models\tables\Tasks;
use \yii\helpers\Html;

/**
 * @var Tasks $model
 * @var array $statuses
 * @var array $users
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
        ->label('Status')
        ->dropDownList($statuses, ['class' => 'form-input form-input__status']);

	echo $task
        ->field($model, 'creator_id')
        ->label('Creator')
        ->dropDownList($users, ['class' => 'form-input form-input__creator']);

	echo $task
        ->field($model, 'description')
        ->textInput(['class' => 'form-input form-input__description']);

	echo $task
        ->field($model, 'responsible_id')
        ->label('Responsible')
        ->dropDownList($users, ['class' => 'form-input form-input__responsible']);

	echo $task
        ->field($model, 'deadline')
        ->input('date', ['class' => 'form-input form-input__deadline']);

	echo Html::submitButton('Подтвердить', ['class' => 'btn btn-success']);

	ActiveForm::end();
	?>
</div>
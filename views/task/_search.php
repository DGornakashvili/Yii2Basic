<?php

use app\models\filters\TasksFilter;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\filters\TasksFilter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-search">

	<?php
    $form = ActiveForm::begin();

	$dates = [];
	for ($i = 1; $i <= 12; $i++) {
	    $dates[$i] = date('F', strtotime(date('Y') . "-$i"));
	}

	echo $form->field($model, 'created')->label('Filter')->dropDownList($dates);

	echo Html::submitButton('Find', ['class' => 'btn btn-primary']);

	ActiveForm::end();
	?>

</div>

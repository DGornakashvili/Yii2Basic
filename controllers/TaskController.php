<?php

namespace app\controllers;

use app\models\Task;
use yii\web\Controller;

class TaskController extends Controller
{
	public function actionIndex()
	{
		echo 'Это страничка';
	}


	public function actionTask()
	{
		$model = new Task();
		$model->load([
			'id' => 1,
			'status' => 'В процессе',
			'priority' => 5,
			'name' => 'Задача',
			'description' => 'Back - 1 этап',
			'author' => 'Иван',
			'performer' => 'Василий',
			'starting' => date('d.m.Y'),
			'deadline' => date('d.m.Y', strtotime(date('d.m.Y') . ' + 3 days'))
		], '');

		if (!$model->validate()) {
			var_dump($model->getErrors());
		}
		var_dump($model->getAttributes());
	}
}
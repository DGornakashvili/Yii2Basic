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
	}
}
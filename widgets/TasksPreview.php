<?php

namespace app\widgets;

use app\models\tables\Tasks;
use yii\base\Widget;
use Exception;

class TasksPreview extends Widget
{
	public $model;

	/**
	 * @return string
	 * @throws Exception
	 */
	public function run()
	{
		if (is_a($this->model, Tasks::class)) {
			return $this->render('tasksPreview', ['model' => $this->model]);
		}
		throw new Exception("Ошибка: Допустимая модель - " . Tasks::class);
	}
}
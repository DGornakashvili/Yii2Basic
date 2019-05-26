<?php


namespace app\validator;

use yii\validators\Validator;

class MyTermValidator extends Validator
{
	public function validateAttribute($model, $attributes = null)
	{
		if (strtotime($model->$attributes) < strtotime($model->getAttributes()['starting'])) {
			$model->addError($model->attributes['deadline'], "Дата старта задачи не может быть меньше дедлайна");
		}
	}
}
<?php

namespace app\models;

use Yii;
use yii\base\Behavior;
use app\models\tables\Tasks;

class NotificationBehavior extends Behavior
{
	public function events()
	{
		return [
			Tasks::EVENT_AFTER_INSERT => 'notification'
		];
	}

	public function notification($event)
	{
		$task = Tasks::findOne($event->sender['id']);
		$result = Yii::$app->mailer->compose()
			->setTo([$task->responsible->email => $task->responsible->username])
			->setFrom([$task->creator->email => $task->creator->username])
			->setSubject($task->name)
			->setTextBody($task->description)
			->send();

		return $result;
	}
}
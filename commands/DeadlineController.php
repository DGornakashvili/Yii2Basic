<?php


namespace app\commands;


use Yii;
use yii\helpers\Console;
use yii\console\Controller;
use app\models\tables\Tasks;

class DeadlineController extends Controller
{
	/**
	 * Notifies responsible that the task deadline expires in range of $days
	 * @param int $days
	 */
	public function actionIndex($days = 1)
	{
		if ($tasks = Tasks::findDeadlineExpires($days)) {

			Console::startProgress($i = 1, $count = count($tasks));
			/** @var Tasks $task */
			foreach ($tasks as $task) {
				Yii::$app->mailer->compose()
					->setTo([$task->responsible->email => $task->responsible->username])
					->setFrom([$task->creator->email => $task->creator->username])
					->setSubject("{$task->name} - expires {$task->deadline}")
					->setTextBody($task->description)
					->send();

				Console::updateProgress($i++, $count);
			}

			Console::endProgress();
		}
	}
}
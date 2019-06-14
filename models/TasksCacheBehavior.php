<?php

namespace app\models;

use Yii;
use yii\base\Behavior;
use app\models\tables\Tasks;
use yii\caching\TagDependency;

class TasksCacheBehavior extends Behavior
{
	public function events()
	{
		return [
			Tasks::EVENT_AFTER_INSERT => 'clearCache',
			Tasks::EVENT_AFTER_UPDATE => 'clearCache',
			Tasks::EVENT_AFTER_DELETE => 'clearCache',
		];
	}

	public function clearCache()
	{
		TagDependency::invalidate(Yii::$app->cache, 'tasksCache');
	}
}
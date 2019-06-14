<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\tables\Tasks;
use app\models\tables\Users;
use yii\caching\TagDependency;
use app\models\tables\TaskStatuses;
use app\models\filters\TasksFilter;

class TaskController extends Controller
{
	public function actionIndex()
	{
		$searchModel = new TasksFilter();
		$dataProvider = $searchModel->monthFilter(Yii::$app->request->post());
		$tagDep = new TagDependency(['tags' => 'tasksCache']);

		Yii::$app->db->cache(function () use ($dataProvider) {
			return $dataProvider->prepare();
		}, 36000, $tagDep);

		return $this->render(
			'index',
			[
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]
		);
	}


	public function actionPreview($id)
	{
		$model = Tasks::findOne($id);

		if (Yii::$app->request->post()) {
			$model->load(Yii::$app->request->post());
			$model->save();
		}

		return $this->render(
			'preview',
			[
				'model' => $model,
				'statuses' => TaskStatuses::getStatuses(),
				'users' => Users::getUsers(),
			]
		);
	}
}
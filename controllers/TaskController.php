<?php

namespace app\controllers;

use Yii;
use app\models\tables\Tasks;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class TaskController extends Controller
{
	public function actionIndex()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Tasks::find()
		]);

		return $this->render('index', ['dataProvider' => $dataProvider]);
	}


	public function actionPreview($id)
	{
		$model = Tasks::findOne($id);

		if (Yii::$app->request->post()) {
			$model->load(Yii::$app->request->post());
			$model->save();
		}

		return $this->render('preview', ['model' => $model]);
	}
}
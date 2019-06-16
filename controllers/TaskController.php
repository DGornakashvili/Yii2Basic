<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\base\Exception;
use yii\web\UploadedFile;
use app\models\tables\Tasks;
use app\models\tables\Users;
use yii\filters\AccessControl;
use yii\caching\TagDependency;
use app\models\tables\Comments;
use app\models\filters\TasksFilter;
use app\models\tables\TaskStatuses;
use app\models\forms\AttachmentsForm;

class TaskController extends Controller
{
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::class,
				'only' => ['preview', 'save'],
				'rules' => [
					[
						'actions' => ['preview'],
						'allow' => true,
						'roles' => ['@'],
					],
					[
						'actions' => ['save'],
						'allow' => true,
						'roles' => ['taskUpdate'],
					],
				],
			],
		];
	}

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

		return $this->render(
			'preview',
			[
				'model' => $model,
				'statuses' => TaskStatuses::getStatuses(),
				'users' => Users::getUsers(),
				'commentsForm' => new Comments(),
				'attachmentsForm' => new AttachmentsForm(),
				'userId' => Yii::$app->user->id,
			]
		);
	}

	public function actionSave($id)
	{
		$model = Tasks::findOne($id);

		if (Yii::$app->request->post()) {
			$model->load(Yii::$app->request->post());
			$model->save();
		}

		$this->redirect(Yii::$app->request->referrer);
	}

	public function actionSaveComment()
	{
		$model = new Comments();

		if (Yii::$app->request->post()) {
			$model->load(Yii::$app->request->post());
			$model->save();
		}

		$this->redirect(Yii::$app->request->referrer);
	}

	/**
	 * @throws Exception
	 */
	public function actionSaveAttachment()
	{
		$model = new AttachmentsForm();

		if (Yii::$app->request->post()) {
			$model->load(Yii::$app->request->post());
			$model->upload = UploadedFile::getInstance($model, 'upload');
			$model->save();
		}

		$this->redirect(Yii::$app->request->referrer);
	}
}
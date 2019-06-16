<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
	public function actionIndex()
	{
		$am = Yii::$app->authManager;

		$admin = $am->createRole('admin');
		$user = $am->createRole('user');
		$moder = $am->createRole('moder');

		$am->add($admin);
		$am->add($user);
		$am->add($moder);

		$permTaskCreate = $am->createPermission('TaskCreate');
		$permTaskUpdate = $am->createPermission('TaskUpdate');
		$permTaskDelete = $am->createPermission('TaskDelete');

		$am->add($permTaskCreate);
		$am->add($permTaskUpdate);
		$am->add($permTaskDelete);

		$am->addChild($admin, $permTaskCreate);
		$am->addChild($admin, $permTaskUpdate);
		$am->addChild($admin, $permTaskDelete);

		$am->addChild($moder, $permTaskCreate);

		$am->assign($admin, 1);
		$am->assign($user, 2);
		$am->assign($moder, 3);
	}
}
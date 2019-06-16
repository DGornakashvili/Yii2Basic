<?php

namespace app\assets;

use yii\web\AssetBundle;

class TaskPreviewAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';

	public $css = [
		'css/taskPreview.css',
	];

	public $depends = [
		'app\assets\AppAsset',
	];
}
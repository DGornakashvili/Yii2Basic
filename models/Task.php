<?php

namespace app\models;

use yii\base\Model;

class Task extends Model
{
	public $id;
	public $name;
	public $description;
	public $creator_id;
	public $responsible_id;
	public $deadline;
	public $status_id;

	public function rules()
	{
		return [
			[['name'], 'required'],
			[['creator_id', 'responsible_id', 'status_id'], 'integer'],
			[['deadline'], 'safe'],
			[['name'], 'string', 'max' => 50],
			[['description'], 'string', 'max' => 255],
		];
	}
}
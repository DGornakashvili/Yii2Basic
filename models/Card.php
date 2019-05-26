<?php

namespace app\models;

use yii\base\Model;
use app\validator\MyTermValidator;

class Card extends Model
{
	public $id;
	public $status;
	public $priority;
	public $name;
	public $description;
	public $author;
	public $performer;
	public $starting;
	public $deadline;

	public function rules()
	{
		return [
			[['id', 'priority'], 'number'],
			[['status', 'name', 'description', 'author', 'performer', 'starting', 'deadline'], 'string'],
			[['deadline'], MyTermValidator::class]
		];
	}
}
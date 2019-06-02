<?php

namespace app\models\tables;

use app\models\NotificationBehavior;
use Yii;
use \yii\db\ActiveRecord;
use \yii\db\ActiveQuery;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $name Название задачи
 * @property string $description
 * @property int $creator_id
 * @property int $responsible_id
 * @property string $deadline
 * @property int $status_id
 * @property string $created
 * @property string $updated
 *
 * @property Users $creator
 * @property Users $responsible
 * @property TaskStatuses $status
 */
class Tasks extends ActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'tasks';
	}

	public function behaviors()
	{
		return [
			'timestamp' => [
				'class' => TimestampBehavior::class,
				'attributes' => [
					self::EVENT_BEFORE_INSERT => ['created', 'updated'],
					self::EVENT_BEFORE_UPDATE => ['updated'],
				],
				'value' => new Expression('NOW()'),
			],
			'notification' => [
				'class' => NotificationBehavior::class,
			]
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['name'], 'required'],
			[['creator_id', 'responsible_id', 'status_id'], 'integer'],
			[['deadline', 'created', 'updated'], 'safe'],
			[['name'], 'string', 'max' => 50],
			[['description'], 'string', 'max' => 255],
			[['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['creator_id' => 'id']],
			[['responsible_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['responsible_id' => 'id']],
			[['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaskStatuses::class, 'targetAttribute' => ['status_id' => 'id']],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'name' => 'Name',
			'description' => 'Description',
			'creator_id' => 'Creator ID',
			'responsible_id' => 'Responsible ID',
			'deadline' => 'Deadline',
			'status_id' => 'Status ID',
			'created' => 'Created',
			'updated' => 'Updated',
		];
	}

	/**
	 * @return ActiveQuery
	 */
	public function getCreator()
	{
		return $this->hasOne(Users::class, ['id' => 'creator_id']);
	}

	/**
	 * @return ActiveQuery
	 */
	public function getResponsible()
	{
		return $this->hasOne(Users::class, ['id' => 'responsible_id']);
	}

	/**
	 * @return ActiveQuery
	 */
	public function getStatus()
	{
		return $this->hasOne(TaskStatuses::class, ['id' => 'status_id']);
	}
}

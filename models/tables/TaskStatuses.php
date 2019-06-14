<?php

namespace app\models\tables;

use Yii;
use \yii\db\ActiveRecord;
use \yii\db\ActiveQuery;

/**
 * This is the model class for table "task_statuses".
 *
 * @property int $id
 * @property string $name
 *
 * @property Tasks[] $tasks
 */
class TaskStatuses extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_statuses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 50],
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
        ];
    }

    public static function getStatuses()
    {
    	return self::find()
		    ->select('name')
		    ->asArray()
		    ->indexBy('id')
		    ->column();
    }

    /**
     * @return ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::class, ['status_id' => 'id']);
    }
}

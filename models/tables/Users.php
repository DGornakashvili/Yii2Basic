<?php

namespace app\models\tables;

use Yii;
use \yii\db\ActiveRecord;
use \yii\db\ActiveQuery;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 * @property string $email
 *
 * @property Tasks[] $creator
 * @property Tasks[] $responsible
 */
class Users extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'authKey', 'accessToken', 'email'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'email' => 'Email',
        ];
    }

    public static function getUsers()
    {
		return self::find()
			->select('username')
			->asArray()
			->indexBy('id')
			->column();
    }

    /**
     * @return ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasMany(Tasks::class, ['creator_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getResponsible()
    {
        return $this->hasMany(Tasks::class, ['responsible_id' => 'id']);
    }
}

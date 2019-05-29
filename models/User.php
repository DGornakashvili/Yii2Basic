<?php

namespace app\models;

use app\models\tables\Users;
use yii\base\BaseObject;
use yii\web\IdentityInterface;

class User extends BaseObject implements IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];


	/**
	 * {@inheritdoc}
	 */
	public static function findIdentity($id)
	{
		self::$users = Users::findOne(['id' => $id])->toArray();
		return is_null(self::$users) ? null : new static(self::$users);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function findIdentityByAccessToken($token, $type = null)
	{
		self::$users = Users::findOne(['accessToken' => $token])->toArray();
		if (self::$users['accessToken'] === $token) {
			return new static(self::$users);
		}

		return null;
	}

	/**
	 * Finds user by username
	 *
	 * @param string $username
	 * @return static|null
	 */
	public static function findByUsername($username)
	{
		self::$users = Users::findOne(['username' => $username])->toArray();
		if (!is_null(self::$users)) {
			return new static(self::$users);
		}

		return null;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getId()
	{
		return self::$users['id'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function getAuthKey()
	{
		return self::$users['authKey'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function validateAuthKey($authKey)
	{
		return self::$users['authKey'] === $authKey;
	}

	/**
	 * Validates password
	 *
	 * @param string $password password to validate
	 * @return bool if password provided is valid for current user
	 */
	public function validatePassword($password)
	{
		return self::$users['password'] === $password;
	}
}

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
	public $email;

	/**
	 * {@inheritdoc}
	 */
	public static function findIdentity($id)
	{
		$user = Users::findOne(['id' => $id])->toArray();
		return $user ? new static($user) : null;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function findIdentityByAccessToken($token, $type = null)
	{
		$user = Users::findOne(['accessToken' => $token])->toArray();
		return $user ? new static($user) : null;
	}

	/**
	 * Finds user by username
	 *
	 * @param string $username
	 * @return static|null
	 */
	public static function findByUsername($username)
	{
		$user = Users::findOne(['username' => $username])->toArray();
		return $user ? new static($user) : null;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getAuthKey()
	{
		return $this->authKey;
	}

	/**
	 * {@inheritdoc}
	 */
	public function validateAuthKey($authKey)
	{
		return $this->authKey === $authKey;
	}

	/**
	 * Validates password
	 *
	 * @param string $password password to validate
	 * @return bool if password provided is valid for current user
	 */
	public function validatePassword($password)
	{
		return $this->password === $password;
	}
}

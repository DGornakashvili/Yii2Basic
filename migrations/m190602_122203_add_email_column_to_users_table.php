<?php

use yii\db\Migration;

/**
 * Handles adding email to table `{{%users}}`.
 */
class m190602_122203_add_email_column_to_users_table extends Migration
{
	protected $tableName = 'users';
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->addColumn($this->tableName, 'email', $this->string(50));
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropColumn($this->tableName, 'email');
	}
}

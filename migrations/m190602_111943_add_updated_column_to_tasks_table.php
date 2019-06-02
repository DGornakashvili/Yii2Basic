<?php

use yii\db\Migration;

/**
 * Handles adding updated to table `{{%tasks}}`.
 */
class m190602_111943_add_updated_column_to_tasks_table extends Migration
{
	protected $tableName = 'tasks';
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->addColumn($this->tableName, 'updated', $this->date());
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropColumn($this->tableName, 'updated');
	}
}

<?php

use yii\db\Migration;

/**
 * Handles adding created to table `{{%tasks}}`.
 */
class m190602_111732_add_created_column_to_tasks_table extends Migration
{
	protected $tableName = 'tasks';
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->addColumn($this->tableName, 'created', $this->date());
	}

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    	$this->dropColumn($this->tableName, 'created');
    }
}

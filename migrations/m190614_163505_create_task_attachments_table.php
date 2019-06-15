<?php

use yii\db\Migration;
use app\models\tables\Tasks;

/**
 * Handles the creation of table `task_attachments`.
 */
class m190614_163505_create_task_attachments_table extends Migration
{
	protected $tableName = 'task_attachments';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('task_attachments', [
            'id' => $this->primaryKey(),
	        'task_id' => $this->integer(),
	        'source' => $this->string(),
        ]);

	    $tasksTable = Tasks::tableName();

	    $this->addForeignKey('fk_tasks_attachments', $this->tableName, 'task_id', $tasksTable, 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('task_attachments');
    }
}

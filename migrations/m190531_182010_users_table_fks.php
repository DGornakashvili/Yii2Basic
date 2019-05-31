<?php

use app\models\tables\Tasks;
use yii\db\Migration;

/**
 * Class m190531_182010_tasks_table_fks
 */
class m190531_182010_users_table_fks extends Migration
{
	protected $tableName = 'users';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $tasksTable = Tasks::tableName();

	    $this->addForeignKey('fk_task_creator', $tasksTable, 'creator_id', $this->tableName, 'id');
	    $this->addForeignKey('fk_task_responsible', $tasksTable, 'responsible_id', $this->tableName, 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $tasksTable = Tasks::tableName();

        $this->dropForeignKey('fk_task_creator', $tasksTable);
        $this->dropForeignKey('fk_task_responsible', $tasksTable);

        return false;
    }
}

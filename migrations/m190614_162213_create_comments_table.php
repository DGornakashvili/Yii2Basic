<?php

use yii\db\Migration;
use app\models\tables\Users;
use app\models\tables\Tasks;

/**
 * Handles the creation of table `{{%comments}}`.
 */
class m190614_162213_create_comments_table extends Migration
{
	protected $tableName = 'comments';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comments', [
            'id' => $this->primaryKey(),
	        'user_id' => $this->integer(),
	        'task_id' => $this->integer(),
	        'comment' => $this->string(),
        ]);

	    $usersTable = Users::tableName();
	    $tasksTable = Tasks::tableName();

	    $this->addForeignKey('fk_users_comments', $this->tableName, 'user_id', $usersTable, 'id');
	    $this->addForeignKey('fk_tasks_comments', $this->tableName, 'task_id', $tasksTable, 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('comments');
    }
}

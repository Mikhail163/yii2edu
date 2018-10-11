<?php

use yii\db\Migration;

/**
 * Class m181011_085753_add_foreign_key_user_task
 */
class m181011_085753_add_foreign_key_user_task extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    	$this->addForeignKey('fx_taskuser_user', 'task_user', ['user_id'], 'user', ['id']);
    	$this->addForeignKey('fx_taskuser_task', 'task_user', ['task_id'], 'task', ['id']);
    	$this->addForeignKey('fx_task_user1', 'task', ['creator_id'], 'user', ['id']);
    	$this->addForeignKey('fx_task_user2', 'task', ['updater_id'], 'user', ['id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181011_085753_add_foreign_key_user_task cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181011_085753_add_foreign_key_user_task cannot be reverted.\n";

        return false;
    }
    */
}

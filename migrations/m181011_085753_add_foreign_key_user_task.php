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
    	$this->addForeignKey('fx_taskuser_user', 'task_user', ['user_id'], 'user', ['user_id']);
    	$this->addForeignKey('fx_taskuser_task', 'task_user', ['task_id'], 'task', ['task_id']);
    	$this->addForeignKey('fx_task_user1', 'task', ['creator_id'], 'user', ['user_id']);
    	$this->addForeignKey('fx_task_user2', 'task', ['updater_id'], 'user', ['user_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    	$this->dropForeignKey('fx_taskuser_user', 'user');
    	$this->dropForeignKey('fx_taskuser_task', 'task');
    	$this->dropForeignKey('fx_task_user1', 'user');
    	$this->dropForeignKey('fx_task_user2', 'user');

        return true;
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

<?php

use yii\db\Migration;

/**
 * Class m181008_134339_add_task_user
 */
class m181008_134339_add_task_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    	/*
    	 id - integer, primaryKey
		 task_id - integer, not null
		 user_id - integer, not null
    	 */
    	
    	$this->createTable('task_user', [
    			'task_user_id' => $this->primaryKey(),
    			'task_id' => $this->integer()->notNull(),
    			'user_id' => $this->integer()->notNull(),
    	]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    	$this->dropTable('task_user');
    	
    	return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181008_134339_add_task_user cannot be reverted.\n";

        return false;
    }
    */
}

<?php

use yii\db\Migration;

/**
 * Class m181008_132609_add_task
 */
class m181008_132609_add_task extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    	/*
    	 id - integer, primaryKey
		 title - varchar(255), not null
		 description - text, not null
		 creator_id - integer, not null
		 updater_id - integer, null
		 created_at - integer, not null
		 updated_at - integer, null
    	 */
    	$this->createTable('task', [
    			'task_id' => $this->primaryKey(),
    			'title' => $this->string(255)->notNull(),
    			'description' => $this->string(255)->notNull(),
    			'creator_id' => $this->integer()->notNull(),
    			'updater_id' => $this->integer()->null(),
    			'created_at' => $this->integer()->notNull(),
    			'updated_at' => $this->integer()->null(),
    	]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    	$this->dropTable('task');
    	
    	return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181008_132609_add_task cannot be reverted.\n";

        return false;
    }
    */
}

<?php

use yii\db\Migration;

/**
 * Class m181008_130541_add_user
 */
class m181008_130541_add_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    	/*
			id - integer, primaryKey
			username - varchar(255), not null
			name - varchar(255), not null
			password_hash - varchar(255), not null
			access_token - varchar(255), null
			auth_key - varchar(255), null
			creator_id - integer, not null
			updater_id - integer, null
			created_at - integer, not null
			updated_at - integer, null
    	 */
		$this->createTable('user', [
				'user_id' => $this->primaryKey(),
				'username' => $this->string(255)->notNull()->comment('Настоящие имя пользователя'),
				'password_hash' => $this->string(255)->notNull(),
				'access_token' => $this->string(255)->notNull(),
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
        $this->dropTable('user');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181008_130541_add_user cannot be reverted.\n";

        return false;
    }
    */
}

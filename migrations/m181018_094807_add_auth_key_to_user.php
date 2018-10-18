<?php

use yii\db\Migration;

/**
 * Class m181018_094807_add_auth_key_to_user
 */
class m181018_094807_add_auth_key_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    	$this->addColumn(
    		'user',
    		'auth_key',
    		$this->string(255)->null()
    	);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    	$this->dropColumn('user', 'auth_key');
    	
    	return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181018_094807_add_auth_key_to_user cannot be reverted.\n";

        return false;
    }
    */
}

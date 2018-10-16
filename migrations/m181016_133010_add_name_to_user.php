<?php

use yii\db\Migration;

/**
 * Class m181016_133010_add_name_to_user
 */
class m181016_133010_add_name_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    	$this->addColumn(
    			'user',
    			'name',
    			$this->string(255)->notNull()
    	);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    	$this->dropColumn('user', 'name');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181016_133010_add_name_to_user cannot be reverted.\n";

        return false;
    }
    */
}

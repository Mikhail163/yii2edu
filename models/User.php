<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "user".
 *
 * @property int $user_id
 * @property string $username Настоящие имя пользователя
 * @property string $password_hash
 * @property string $access_token
 * @property int $creator_id
 * @property int $updater_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Task[] $tasksCreated
 * @property Task[] $tasksUpdated
 * @property TaskUser[] $taskUsers
 * @property Task[] $sharedTasks
 * @mixin TimestampBehavior
 */
class User extends \yii\db\ActiveRecord
{
	const RELATION_TASKS_CREATED = 'tasksCreated';
	const RELATION_TASKS_UPDATED = 'tasksUpdated';
	const RELATION_TASKS_USERS = 'taskUsers';
	const RELATION_TASKS_SHARED = 'sharedTasks';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }
    
    public function behaviors()
    {
    	return [
    			[
    					'class' => TimestampBehavior::class,
    					'updatedAtAttribute' => false,
    			],
    			[
    					'class' => BlameableBehavior::class,
    					'createdByAttribute' => 'creator_id',
    					'updatedByAttribute' => 'updater_id',
    			],
    	];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'name', 'password_hash'], 'required'],
            [['creator_id', 'updater_id', 'created_at', 'updated_at'], 'integer'],
            [['username', 'name', 'password_hash', 'access_token'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'username' => 'Username',
            'password_hash' => 'Password Hash',
            'access_token' => 'Access Token',
            'creator_id' => 'Creator ID',
            'updater_id' => 'Updater ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasksCreated()
    { 
        return $this->hasMany(Task::className(), ['creator_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasksUpdated()
    {
        return $this->hasMany(Task::className(), ['updater_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskUsers()
    {
    	return $this->hasMany(TaskUser::className(), ['user_id' => 'user_id']);
    }
    
    public function getSharedTasks() 
    {
        //ini_set('memory_limit', '1024M');
    	//return 0;
    	return $this->hasMany(Task::className(), ['task_id' => 'task_id'])
    		->via(self::RELATION_TASKS_USERS);
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}

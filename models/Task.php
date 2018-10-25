<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $task_id
 * @property string $title
 * @property string $description
 * @property int $creator_id
 * @property int $updater_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $creator
 * @property User $updater
 * @property TaskUser[] $taskUsers
 */
class Task extends \yii\db\ActiveRecord
{
	const SCENARIO_CREATE = 'create';
	const SCENARIO_UPDATE = 'update';
	const RELATION_TASK_USERS = 'taskUsers';
	const RELATION_SHARED_USERS = 'sharedUsers';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }
    
    /*
     * Метод для переопределения базы
    public static function getDb() {
    	return $otherConnection;
    }
    */

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
        	[['created_at', 'creator_id'], 'required', 'on' => self::SCENARIO_CREATE],
        	[['updated_at', 'updater_id'], 'required', 'on' => self::SCENARIO_UPDATE],
        	[['creator_id', 'updater_id', 'created_at', 'created_at'], 'integer'],
            [['title', 'description'], 'string', 'max' => 255],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['creator_id' => 'user_id']],
            [['updater_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updater_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'task_id' => 'Task ID',
            'title' => 'Title',
            'description' => 'Description',
            'creator_id' => 'Creator ID',
            'updater_id' => 'Updater ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['user_id' => 'creator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['user_id' => 'updater_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskUsers()
    {
        return $this->hasMany(TaskUser::className(), ['task_id' => 'task_id']);
    }
    
    /**
     * Берем всех пользователей, которым открыт доступ к задачам
     * @param {integer} $taskId
     * @return {integer[]} массив id пользователей
     */
    public static function getTaskUsersId($taskId)
    {
    	return  self::find()
	    	->select('user_id')
	    	->from('task_user')
	    	->where(['=', 'task_id', $taskId])
	    	->column();
    	
    }
   
    public function getSharedUsers()
    {
    	return $this->hasMany(User::className(), ['user_id' => 'user_id'])
    		->via(self::RELATION_TASK_USERS);
    }

    /**
     * {@inheritdoc}
     * @return TaskQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TaskQuery(get_called_class());
    }
}

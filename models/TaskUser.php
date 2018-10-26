<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task_user".
 *
 * @property int $task_user_id
 * @property int $task_id
 * @property int $user_id
 *
 * @property Task $task
 * @property User $user
 */
class TaskUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'user_id'], 'required'],
            [['task_id', 'user_id'], 'integer'],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'task_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'task_user_id' => 'Task User ID',
            'task_id' => 'Task ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['task_id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }
    
    public static function getUserTasks($userId) {
    	
    	if (!$userId) {
    		return false;
    	}
    	
    	return self::find()
    		->where([ 'user_id' => $userId ])->all();
    	
    }

    /**
     * {@inheritdoc}
     * @return TaskUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TaskUserQuery(get_called_class());
    }
    
}

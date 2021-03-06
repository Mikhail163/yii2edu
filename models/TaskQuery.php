<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Task]].
 *
 * @see Task
 */
class TaskQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/
	
	public function byCreator($userId) 
	{
		return $this->andWhere(['creator_id' => $userId]);
	}
	
	public function shared($userId)
	{
		return $this->innerJoin(
				'task_user',
				"task.task_id = task_user.task_id AND task_user.user_id = {$userId}");
	}

    /**
     * {@inheritdoc}
     * @return Task[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Task|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\User;
use app\models\Task;
use app\models\TaskUser;

class TestController extends Controller
{
	public function updateUser() {
		$model = User::findOne(4);
		$model->username = '44ewe4';
		$model->name = 'Четвертый';
		$model->password_hash = 'f3i4y3978y3fgugfiwuf';
		$model->save();
		
		return $model;
	}
	
	public function createUser() {
		$model = new User();		
		
		$model->username = '44';
		$model->name = 'Четвертый';
		$model->password_hash = 'f3i4y3978y3fgugfiwuf';
		$model->creator_id = '1';
		$model->access_token = '0';
		// created_at создается автоматически 
		// благодаря TimestampBehavior в behaviors
		
		$model->save();
		
		return $model;
	}
	
    public function actionIndex()
    {
    	$model = new TaskUser();
    	$result = $model->getUserTasks(1);	

    	return $this->render('index', [
    			'result' => $result,
    	]);
    	
    }
    
    public function createUserTaskRelation() {
    	$modelUser = User::findOne(1);
    	$modelTask = Task::findOne(1);
    	$modelUser->unlink(
    			User::RELATION_TASKS_SHARED,
    			$modelTask,
    			true //удаляем запись
    			);
    }

    
    public function lazyLoading() {
    	/**
    	 * Ленивая - отложенная загрузка
    	 */
    	
    	// первый запрос
    	$model = User::findOne(1);
    	
    	// второй запрос
    	//$result = $model->getTasksCreated()->all();
    	
    	/**
    	 * Жадная загрузка
    	 */
    	
    	// единственный запрос
    	//$models = User::find()->with(User::RELATION_TASKS_CREATED)->all();
    	
    	/**
    	 * JOIN запрос
    	 */
    	
    	//$models = User::find()->joinWith(User::RELATION_TASKS_CREATED)->all();
    	//$result = $models[0]->tasksCreated[0]->updater;
    	
    	$result = $model->sharedTasks;
    	/*
    	 $modelTaskUser = new TaskUser();
    	 $modelTaskUser->user_id = 1;
    	 $modelTaskUser->task_id = 3;
    	 $modelTaskUser->save();
    	 */
    	 return $this->render('index', [
    	 'result' => $result,
    	 ]);
    }
}

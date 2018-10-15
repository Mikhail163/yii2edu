<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\User;

class TestController extends Controller
{
    public function actionIndex()
    {

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
    	
    	return $this->render('index', [
    			'result' => $result,
    	]);

    }

}

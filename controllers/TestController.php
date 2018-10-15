<?php

namespace app\controllers;

use yii\web\Controller;
use yii\helpers\VarDumper;
use app\models\User;

class TestController extends Controller
{
    public function actionIndex()
    {

    	$model = User::findOne(1);
    	
    	return VarDumper::dumpAsString($model->getTasksCreated()->all(), 4 , true);
    	
    	return $this->render('index', [
    			'result' => $result,
    	]);

    }

}

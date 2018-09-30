<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Product;

class TestController extends Controller
{
    public function actionIndex()
    {
    	//return \Yii::$app->test->run();
    	
    	$model = new Product([
    			'name' => 'Тестовый продукт', 
    			'price' => 1900, 
    			'id' => 1989767
    	]);
    	
        return $this->render('index', [
        		'title' => 'Тестовая страница',
        		'content' => 'Выполняем задание к уроку 1 курс yii2 базовый',
        		'model' => $model,
        ]);
    }

}

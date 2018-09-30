<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Product;

class TestController extends Controller
{
 
    public function actionIndex()
    {
    	$model = new Product();
    	
    	$model->name = 'Тестовый продукт';
    	$model->price = 1900;
    	$model->id = 1989767;
    	
        return $this->render('index', [
        		'title' => 'Тестовая страница',
        		'content' => 'Выполняем задание к уроку 1 курс yii2 базовый',
        		'model' => $model,
        ]);
    }

}

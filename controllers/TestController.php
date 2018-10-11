<?php

namespace app\controllers;

use yii\web\Controller;


class TestController extends Controller
{
    public function actionIndex()
    {

    	
    	$result = \Yii::$app->db->createCommand()
    	->batchInsert('user',
    			['username', 'password_hash', 'access_token', 'creator_id', 'created_at'],
    			[
    					['Вася', 'hash', 'token', 0, time()],
    					['Катя', 'hash', 'token', 0, time()],
    					['Марина', 'hash', 'token', 0, time()],
    			]
    			)->execute();
    	
    	$result = \Yii::$app->db->createCommand()
    		->batchInsert('task', 
    				['title', 'description', 'creator_id', 'created_at'], 
	    			[
	    					['Запись от Васи', 'Поэма написана в честь 1000 летию со дня основаняи Зеленограда', 1, time()],
	    					['Катя пишет Васе', 'Василий сколько стоит молоко в былочном магазине напротив', 2, time()],
	    					['Ответ Васи Кате', 'Лучше перейти через улицу и купить кефир в пицерии', 1, time()],
	    			]
    	)->execute();
    	
    	return $result;

    }

}

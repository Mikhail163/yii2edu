<?php

namespace app\controllers;

use yii\web\Controller;


class TestController extends Controller
{
    public function actionIndex()
    {

    	
    	$result = \Yii::$app->db->createCommand()->batchInsert('user', ['user_name', 'password_hash', 'access_token', 'creator_id', 'created_at'], 
    			[
    					['Вася', '', '', 0, time()],
    					['Катя', '', '', 0, time()],
    			]);
    	
    	return $result;

    }

}

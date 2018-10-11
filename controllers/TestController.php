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
	    			]
    	)->execute();
    	
    	return $result;

    }

}

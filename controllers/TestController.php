<?php

namespace app\controllers;

use yii\web\Controller;


class TestController extends Controller
{
    public function actionIndex()
    {

    	
    	/*
    	 * task_idПервичный	int(11)			Нет	Нет		AUTO_INCREMENT	 Изменить Изменить	 Удалить Удалить	
Ещё Ещё
	2	title	varchar(255)	utf8_unicode_ci		Нет	Нет			 Изменить Изменить	 Удалить Удалить	
Ещё Ещё
	3	description	varchar(255)	utf8_unicode_ci		Нет	Нет			 Изменить Изменить	 Удалить Удалить	
Ещё Ещё
	4	creator_id	int(11)			Нет	Нет			 Изменить Изменить	 Удалить Удалить	
Ещё Ещё
	5	created_at	int(11)			Да	NULL			 Изменить Изменить	 Удалить Удалить	
Ещё Ещё
	6	updated_at	int(11)
    	 */
    	
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

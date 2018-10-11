<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Product;
use yii\helpers\VarDumper;

class User {
	public $name;
	public $passwordHash;
	public $accessToken;
	public $creatorId;
	public $createdAt;
	public $updatedAt;
	
	public function __construct(
			$userName, $passwordHash = 'empty_hash', 
			$accessToken = 'empty_token', $creatorId = 0, 
			$createdAt = 0, $updatedAt = NULL) {
		$this->name = $userName;
		$this->passwordHash = $passwordHash;
		$this->accessToken = $accessToken;
		$this->creatorId = $creatorId;
		$this->createdAt = ($createdAt == 0) ? time() : $createdAt;
		$this->updatedAt= $updatedAt;
	}
	
	public function valForInsert() {
		return [
				'user_name' => $this->name, 
				'password_hash' => $this->passwordHash,
				'access_token' => $this->accessToken,
				'creator_id' => $this->creatorId,
				'created_at' => $this->createdAt,
		];
	}
	
	public static function rowNameForInsert() {
		return ['user_name', 'password_hash', 'access_token', 'creator_id', 'created_at'];
	}
	
	public function valForMultiInsert() {
		return [
				$this->name,
				$this->passwordHash,
				$this->accessToken,
				$this->creatorId,
				$this->createdAt,
		];
	}
}

class TestController extends Controller
{
    public function actionIndex()
    {

    	/*
    	$id = 5000;
    	$result = \Yii::$app->db
    		->createCommand('SELECT * FROM {{product}} WHERE product_id > :id', ['id' => $id])
    			->queryAll();
    	*/
    	
    	$users[0] = new User('Вася');
    	$users[1] = new User('Катя');
    	$users[2] = new User('Марина');
    	$users[3] = new User('Сережа');
    	$users[4] = new User('Вика');
    	
    	$usersArray4insert = [];
    	
    	foreach($users as $user) {
    		array_push($usersArray4insert, $user->valForMultiInsert());
    	}
    	
    	//var_dump(User::rowNameForInsert());
    	var_dump($usersArray4insert);
    	
    	//$result = \Yii::$app->db->createCommand()->batchInsert('user', ['user_name', 'password_hash', 'access_token', 'creator_id', 'created_at'], $usersArray4insert);
    	
    	$result = '';
    	
    	return $result;
    	/*
    	$model = new Product();
    	
    	$model->attributes = [ 'name' => 'Тестовый продукт', 'price' => 1900, 'product_id' => 1989767 ];
    	
    	
        return $this->render('index', [
        		'title' => 'Тестовая страница',
        		'content' => 'Выполняем задание к уроку 1 курс yii2 базовый',
        		'model' => $model,
        ]);
        */
    }

}

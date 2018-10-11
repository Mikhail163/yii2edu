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
			$userName, 
			$passwordHash = 'empty_hash', 
			$accessToken = 'empty_token', 
			$creatorId = 0, 
			$createdAt = 0, 
			$updatedAt = NULL
			) {
		
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
    	$users = [];
    	
    	array_push($users, new User('Вася'));
    	array_push($users, new User('Катя'));
    	array_push($users, new User('Марина'));
    	array_push($users, new User('Сережа'));
    	array_push($users, new User('Вика'));
    	
    	$usersArray4insert = [];
    	
    	foreach($users as $user) {
    		array_push($usersArray4insert, $user->valForMultiInsert());
    	}
    	
    	var_dump(User::rowNameForInsert());
    	var_dump($usersArray4insert);
    	
    	$result = \Yii::$app->db->createCommand()->batchInsert('user', User::rowNameForInsert(), $usersArray4insert);
    	
    	return $result;

    }

}

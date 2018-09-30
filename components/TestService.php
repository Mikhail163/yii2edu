<?php

namespace app\components;

use yii\base\Component;

class TestService extends Component
{
	public $prop = 'default';
	
	public function run() {
		
		return "Запущен тестовый сервис<br>Его значение по умолчанию<br>>{$this->prop}<br>Сервис закончил свою работу!";
	}
}

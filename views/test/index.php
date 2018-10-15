<?php
use yii\helpers\VarDumper;
/**
 * View объект
 * отображает тестовую страницу
 * @var string $title заголовок страницы
 * @var string $content контент
 * @var \app\models\Product $model
 *//*
echo "<h1>$title</h1>";
echo "<p>$content</p>";
echo "<ul>{$model->name}
		<li>#id {$model->product_id}</li>
		<li>цена {$model->price} р</li>
     </ul>";*/
//echo DetailView::widget(['result' => $model]);

echo VarDumper::dumpAsString($result, 4 , true);
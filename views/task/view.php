<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Task */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['my']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->task_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->task_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'task_id',
            'title',
            'description',
            'creator_id',
            'updater_id',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

<p><b>Список пользователей - кому доступна задача</b></p>

	    <?= GridView::widget([
        'dataProvider' => $dp,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
        	'user_id',
        	[
        		'label' => 'Логин',
        		'value' => 'user.username',
	    	],
            [
            	'class' => 'yii\grid\ActionColumn',
            	'template' => '{delete}',	
            ],
        ],
    ]); ?>

</div>

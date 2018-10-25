<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Расшаренные задачи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?php //Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
	</p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
        	'title',
            'description:ntext',
        	[
        		'label' => 'users',
        		'value' => function(\app\models\Task $model) {
        			$usernames = ArrayHelper::map(
        					$model->taskUsers,
        					'user_id', 'user.username'
        			);
        			return join(', ', $usernames);
        		}
    		],	
            [
            	'class' => 'yii\grid\ActionColumn',
            	'template' => '{unshareAll}',
            	'buttons' => [
            			'unshareAll' => function ($url,  app\models\Task $model, $key) {
            				$ico = \yii\bootstrap\Html::icon('ban-circle');
            				return Html::a($ico, 
            						['task-user/unshare-all', 'taskId'=>$model->task_id], [
            							'data' => [
            								'confirm' => 'Удалить доступ всем',		
            								'method' => 'post',
            							]
            						]);
    					}
    			]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaskUser */

$this->title = 'Update Task User: ' . $model->task_user_id;
$this->params['breadcrumbs'][] = ['label' => 'Task Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->task_user_id, 'url' => ['view', 'id' => $model->task_user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="task-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

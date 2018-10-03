<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->product_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->product_id], [
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
            'product_id',
            'brend_id',
            'meta_id',
            'lenght',
            'height',
            'width',
            'weight',
            'name',
            'articul',
            'offer',
            'h1',
            'title',
            'description:ntext',
            'keywords',
            'seo_description',
            'price',
            'discounted_price',
            'thumbnail',
            'display',
            'visible',
            'for_sale',
            'replace_product_id',
            'show_description',
            'watermark',
            'quantity',
            'purchase_cost',
            'yamt_category',
            'model',
            'yamt_description',
            'type_id',
        ],
    ]) ?>

</div>

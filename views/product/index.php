<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'product_id',
            'brend_id',
            //'meta_id',
            //'lenght',
            //'height',
            //'width',
            //'weight',
            'name',
            //'articul',
            //'offer',
            //'h1',
            //'title',
        	[
        		'attribute' => 'description',
        		'format' => 'html',
        	],
            //'description:ntext',
            //'keywords',
            //'seo_description',
        	[
        		'attribute' => 'price',
        		'contentOptions' => ['class' => 'small'],
        		'format' => 'html',
        		'value' => function(app\models\Product $model) {
        			
        			if ($model->price <= $model->discounted_price ||
        				$model->discounted_price == 0) {
        				return "{$model->price} руб";
        			}
        			else {
        				$old_price = Html::tag('span', Html::encode($model->price), ['class' => 'old-price']);
        				return $old_price .' '.$model->discounted_price . "руб";
        			}	
        		}
        	],
            //'discounted_price',
            //'thumbnail',
            //'display',
            //'visible',
            //'for_sale',
            //'replace_product_id',
            //'show_description',
            //'watermark',
            //'quantity',
            //'purchase_cost',
            //'yamt_category',
            //'model',
            //'yamt_description',
            //'type_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

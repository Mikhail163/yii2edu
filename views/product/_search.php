<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'brend_id') ?>

    <?= $form->field($model, 'meta_id') ?>

    <?= $form->field($model, 'lenght') ?>

    <?= $form->field($model, 'height') ?>

    <?php // echo $form->field($model, 'width') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'articul') ?>

    <?php // echo $form->field($model, 'offer') ?>

    <?php // echo $form->field($model, 'h1') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'keywords') ?>

    <?php // echo $form->field($model, 'seo_description') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'discounted_price') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'image_2') ?>

    <?php // echo $form->field($model, 'image_3') ?>

    <?php // echo $form->field($model, 'image_4') ?>

    <?php // echo $form->field($model, 'image_5') ?>

    <?php // echo $form->field($model, 'image_6') ?>

    <?php // echo $form->field($model, 'image_7') ?>

    <?php // echo $form->field($model, 'image_8') ?>

    <?php // echo $form->field($model, 'image_9') ?>

    <?php // echo $form->field($model, 'image_10') ?>

    <?php // echo $form->field($model, 'thumbnail') ?>

    <?php // echo $form->field($model, 'display') ?>

    <?php // echo $form->field($model, 'visible') ?>

    <?php // echo $form->field($model, 'for_sale') ?>

    <?php // echo $form->field($model, 'replace_product_id') ?>

    <?php // echo $form->field($model, 'show_description') ?>

    <?php // echo $form->field($model, 'watermark') ?>

    <?php // echo $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'purchase_cost') ?>

    <?php // echo $form->field($model, 'yamt_category') ?>

    <?php // echo $form->field($model, 'model') ?>

    <?php // echo $form->field($model, 'yamt_description') ?>

    <?php // echo $form->field($model, 'type_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

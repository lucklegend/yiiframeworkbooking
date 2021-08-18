<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AssetSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asset-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'model') ?>

    <?= $form->field($model, 'category') ?>

    <?= $form->field($model, 'brand') ?>

    <?php // echo $form->field($model, 'code') ?>

    <?php // echo $form->field($model, 'purchase_from') ?>

    <?php // echo $form->field($model, 'purchase_date') ?>

    <?php // echo $form->field($model, 'warranty_end_date') ?>

    <?php // echo $form->field($model, 'amc_by') ?>

    <?php // echo $form->field($model, 'amc_start') ?>

    <?php // echo $form->field($model, 'amc_end') ?>

    <?php // echo $form->field($model, 'notes') ?>

    <?php // echo $form->field($model, 'user_unit') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

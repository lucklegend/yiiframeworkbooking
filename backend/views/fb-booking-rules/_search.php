<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FbBookingRulesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fb-booking-rules-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'facility') ?>

    <?= $form->field($model, 'group') ?>

    <?= $form->field($model, 'peak') ?>

    <?= $form->field($model, 'range_type') ?>

    <?php // echo $form->field($model, 'range_limit') ?>

    <?php // echo $form->field($model, 'rules_order') ?>

    <?php // echo $form->field($model, 'condition') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FbBookingSlotSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fb-booking-slot-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'facility') ?>

    <?= $form->field($model, 'price') ?>

    <?= $form->field($model, 'time_from') ?>

    <?= $form->field($model, 'time_to') ?>

    <?php // echo $form->field($model, 'monday') ?>

    <?php // echo $form->field($model, 'tuesday') ?>

    <?php // echo $form->field($model, 'wednesday') ?>

    <?php // echo $form->field($model, 'thursday') ?>

    <?php // echo $form->field($model, 'friday') ?>

    <?php // echo $form->field($model, 'saturday') ?>

    <?php // echo $form->field($model, 'sunday') ?>

    <?php // echo $form->field($model, 'peak') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

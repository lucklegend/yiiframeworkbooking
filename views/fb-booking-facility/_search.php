<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FbBookingFacilitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fb-booking-facility-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'group') ?>

    <?= $form->field($model, 'bookday_start') ?>

    <?= $form->field($model, 'bookday_end') ?>

    <?php // echo $form->field($model, 'cancel_date') ?>

    <?php // echo $form->field($model, 'unit_time') ?>

    <?php // echo $form->field($model, 'rulestype') ?>

    <?php // echo $form->field($model, 'rulescondition') ?>

    <?php // echo $form->field($model, 'deposit') ?>

    <?php // echo $form->field($model, 'notes') ?>

    <?php // echo $form->field($model, 'attachment') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'album_id') ?>

    <?php // echo $form->field($model, 'album_url') ?>

    <?php // echo $form->field($model, 'published') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

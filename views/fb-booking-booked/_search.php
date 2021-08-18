<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FbBookingBookedSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fb-booking-booked-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'facility_id') ?>

    <?= $form->field($model, 'slot_from') ?>

    <?= $form->field($model, 'slot_to') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'deposit') ?>

    <?php // echo $form->field($model, 'total_amount') ?>

    <?php // echo $form->field($model, 'paid_amount') ?>

    <?php // echo $form->field($model, 'payment_method_id') ?>

    <?php // echo $form->field($model, 'payment_details') ?>

    <?php // echo $form->field($model, 'payment_status') ?>

    <?php // echo $form->field($model, 'returned_amount') ?>

    <?php // echo $form->field($model, 'returned_by') ?>

    <?php // echo $form->field($model, 'returned_date') ?>

    <?php // echo $form->field($model, 'returned_details') ?>

    <?php // echo $form->field($model, 'cancelled_time') ?>

    <?php // echo $form->field($model, 'cancelled_by') ?>

    <?php // echo $form->field($model, 'cancelled_reason') ?>

    <?php // echo $form->field($model, 'lapse_date') ?>

    <?php // echo $form->field($model, 'lasttime_book') ?>

    <?php // echo $form->field($model, 'peak') ?>

    <?php // echo $form->field($model, 'notes') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

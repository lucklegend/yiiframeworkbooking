<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FbBookingBooked */

$this->title = 'Booking: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fb Booking Bookeds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
        <?php
    yii\bootstrap\Modal::begin(['id' =>'modal']);
    yii\bootstrap\Modal::end();
?>

<div class="fb-booking-booked-update" style="margin-left:20px">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('cancel_form', [
        'model' => $model,
    ]) ?>

</div>

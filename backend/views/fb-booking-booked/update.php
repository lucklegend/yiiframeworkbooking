<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FbBookingBooked */

$this->title = 'Update Booking: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fb Booking Book', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fb-booking-booked-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

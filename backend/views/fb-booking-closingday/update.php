<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FbBookingClosingday */

$this->title = 'Update Closingday: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Fb Booking Closingdays', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fb-booking-closingday-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

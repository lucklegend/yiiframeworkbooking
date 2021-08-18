<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FbBookingClosingday */

$this->title = 'Update Fb Booking Closingday: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Fb Booking Closingdays', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fb-booking-closingday-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

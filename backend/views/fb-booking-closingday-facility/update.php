<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FbBookingClosingdayFacility */

$this->title = 'Update Fb Booking Closingday Facility: ' . $model->closingday_id;
$this->params['breadcrumbs'][] = ['label' => 'Fb Booking Closingday Facilities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->closingday_id, 'url' => ['view', 'id' => $model->closingday_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fb-booking-closingday-facility-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

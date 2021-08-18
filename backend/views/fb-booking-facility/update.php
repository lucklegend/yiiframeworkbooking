<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FbBookingFacility */

$this->title = 'Update Facility: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Fb Booking Facilities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fb-booking-facility-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

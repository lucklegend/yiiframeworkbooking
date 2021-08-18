<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FbBookingFacility */

$this->title = 'Update Fb Booking Facility: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Fb Booking Facilities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fb-booking-facility-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

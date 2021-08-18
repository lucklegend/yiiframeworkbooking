<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FbBookingSlot */

$this->title = 'Update Slot: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fb Booking Slots', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fb-booking-slot-update">

    <?= $this->render('_form1', [
        'model' => $model, 'id' => $id, 'group' =>$group,
    ]) ?>

</div>

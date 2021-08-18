<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FbBookingRules */

$this->title = 'Update Rules: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fb Booking Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fb-booking-rules-update">

    <?= $this->render('_form', [
        'model' => $model, 'id' => $id, 'group' =>$group, 'facility' =>$facility,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FbBookingConfig */

$this->title = 'Update Fb Booking Config: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fb Booking Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fb-booking-config-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

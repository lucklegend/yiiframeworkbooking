<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FbBookingGroup */

$this->title = 'Update Fb Booking Group: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Fb Booking Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fb-booking-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

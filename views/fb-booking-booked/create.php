<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FbBookingBooked */

$this->title = 'Create Booking';
$this->params['breadcrumbs'][] = ['label' => 'New Booking', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fb-booking-booked-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FbBookingStatus */

$this->title = 'Create Fb Booking Status';
$this->params['breadcrumbs'][] = ['label' => 'Fb Booking Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fb-booking-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

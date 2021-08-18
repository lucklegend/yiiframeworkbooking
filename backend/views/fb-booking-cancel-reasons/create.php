<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FbBookingCancelReasons */

$this->title = 'Create Fb Booking Cancel Reasons';
$this->params['breadcrumbs'][] = ['label' => 'Fb Booking Cancel Reasons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fb-booking-cancel-reasons-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

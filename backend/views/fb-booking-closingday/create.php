<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FbBookingClosingday */

$this->title = 'Create Closingday';
$this->params['breadcrumbs'][] = ['label' => 'Fb Booking Closingdays', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fb-booking-closingday-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

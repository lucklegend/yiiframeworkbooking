<?php

use yii\helpers\Html;
use common\models\FbBookingFacility;


/* @var $this yii\web\View */
/* @var $model common\models\FbBookingBooked */

$this->title = 'Booking Status';
$this->params['breadcrumbs'][] = ['label' => 'New Booking', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$fac = FbBookingFacility::find()->select('notes')->where(['id' => $model->facility_id])->one();


?>
<Style>
  .price:hover {
    background-color: #ffffff00 !important;
    color: #8c6238 !important;
  }
</style>
<div class="fb-booking-booked-create">
  <br>
  <br>
  <?= $fac->notes; ?>
  <br>
  <?= Html::a('Booking Details', ['/fb-booking-booked/view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
</div>
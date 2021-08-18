<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FbBookingBooked */

$this->title = 'Create Booking';
$this->params['breadcrumbs'][] = ['label' => 'New Booking', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<Style>
.price:hover {
	background-color: #ffffff00 !important;
	color: #8c6238 !important;
}

 </style>
<div class="fb-booking-booked-create">
 
 <div class="col-sm-9">
 <p style="color:#000"> Kindly, Select Your Mode of Payment. </p> 
 <a class="price" style="color:#8c704b" href="<?php echo FRONTEND.'/index.php?r=fb-booking-booked/confirmbooking&id='.$model->id.'&pid=3'; ?>">1) Pay at Management Office – Cheque</a><br /> 
</div>
</div>
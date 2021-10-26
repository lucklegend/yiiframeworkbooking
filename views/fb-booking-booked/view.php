<?php 

use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\db\Query;
use common\models\Events;
/* @var $this yii\web\View */
/* @var $model common\models\FbBookingBooked */
$this->title = 'Booking-'. $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Fb Booking Bookeds', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

//For checking dates by Janno issue last Oct 26, 2021
// $script_tz = date_default_timezone_get();
// $today = date("F j, Y, g:i a");
// echo $script_tz;
// echo '<br>'.$today;
// echo '<br>'.$model->created;

$this->registerJs("$(function() {
   $('#popupModal').click(function(e) {
     e.preventDefault();
     $('#modal').modal('show').find('.modal-content')
     .load($(this).attr('href'));
   });
});");
$this->registerJs("$(function() {
   $('#popupModal1').click(function(e) {
     e.preventDefault();
     $('#modal').modal('show').find('.modal-content')
     .load($(this).attr('href'));
   });
});");
$this->registerJs("$(function() {
   $('#popupModal2').click(function(e) {
     e.preventDefault();
     $('#modal').modal('show').find('.modal-content')
     .load($(this).attr('href'));
   });
});");
?>
<div class="row fb-booking-booked-view"> 
<h1 style="color:#8c6238;">Bookings</h1>
        <?php
    yii\bootstrap\Modal::begin(['id' =>'modal']);
    yii\bootstrap\Modal::end();
?> 
    <?= \gamitg\detailview4cols\DetailView4Col::widget([
			'model' => $model,
			'attributes' => [
				[
					'attribute'=>'user_id',
					'label'=>'Name',
					'value' => $model->user->username,
				],
				[
					'attribute'=>'id',
					'label'=>'Reference No'
				],
				[     
					'attribute' => 'facility_id',		
					'value' => $model->facility0->name,
				],	
				[   
					'attribute' => 'status',		
					'value' => $model->status2->title,		
				],    
				[		
					'attribute'=>'slot_from',	
					'value' =>   date('d M Y h:ia', strtotime($model->slot_from)),
				],		
				[		
					'attribute'=>'slot_to',	
					'value' =>   date('d M Y h:ia', strtotime($model->slot_to)),
				],		
				[	
					'attribute'=>'price',
					'value' => $model->price == '' ? 'NA' :  'SGD '.Yii::$app->formatter->asDecimal($model->price),
					'label'=>'Cost Per Booking'	
				], 
				[	
					'attribute'=>'deposit',		
					'value' =>  $model->deposit == '' ? 'NA' :  'SGD '.Yii::$app->formatter->asDecimal($model->deposit),
				],   
				[	
					'attribute'=>'paid_amount',		
					'value' =>  $model->paid_amount == '' ? 'NA' :  'SGD '.Yii::$app->formatter->asDecimal($model->paid_amount),
				], 
				[
					'attribute' => 'payment_method_id',
					'value' => $model->method->title,
				],
				[
					'attribute' => 'payment_status',
					'value' => $model->status1->title,
				],		
				[	
					'attribute'=>'returned_amount',		
					'value' => $model->returned_amount == '' ? 'NA' :  'SGD '.Yii::$app->formatter->asDecimal($model->returned_amount),
				],     
				[		
					'attribute'=>'cancelled_time',		
					'value' => $model->cancelled_time == '' ? 'NA' : date('d F Y h:ia', strtotime($model->cancelled_time)),	
				],       
				[    
					'attribute' => 'cancelled_reason',		
					'value' => $model->cancelled_reason == '' ? 'NA' :$model->cancelled_reason,	
				],   
				[
					'attribute'=>'created',
					//'format' => ['date', 'php:d M Y h:ia'],
					'value' =>  date('d F Y h:ia', strtotime($model->created)),
				],
				[
					'attribute'=>'notes',
					'format' => 'raw'
				],    
      ],
    ]);
	
	?> 
</div>
    

<?php 
	echo  Html::a(Yii::t('app', ' {modelClass}', [
		'modelClass' => 'Booking Receipt',
	]), ['review','id'=>$model->id], ['class' => 'btn btn-success', 'id' => 'popupModal']);  

			$cancel = $model->facility0->cancel_date;
			$date = date('Y-m-d h:i:s' , strtotime($model->slot_from));
			// echo date('Y-m-d h:i:s' , strtotime($date." -".$cancel." hours"));
			// echo date('Y-m-d h:i:s');
	echo '&nbsp;';		
	if( strtotime(date('Y-m-d h:i:s' , strtotime($date." -".$cancel." hours"))) > strtotime(date('Y-m-d h:i:s'))    && $model->status != 3  ){ 
		echo Html::a(
				'Cancel this Booking',
				['/fb-booking-booked/cancelupdate', 'id' => $model->id],
				[  'class' => 'btn btn-danger']
			);
	}
?>
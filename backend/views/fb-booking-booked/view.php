<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\FbBookingBooked */

$this->title = 'Booking '. $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fb Booking Book', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

	$this->registerJs("$(function() {
   $('#popupModal').click(function(e) {
     e.preventDefault();
     $('#modal').modal('show').find('.modal-content')
     .load($(this).attr('href'));
   });
});");

?>
<div class="fb-booking-booked-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', ' {modelClass}', [
									  'modelClass' => 'Receipt',
									  ]), ['review','id'=>$model->id], ['class' => 'btn btn-success', 'id' => 'popupModal']);
									  ?>									  		<?= Html::a('Back', ['index'], ['class' => 'btn btn-info']) ?>
    </p>
        <?php
    yii\bootstrap\Modal::begin(['id' =>'modal']);
    yii\bootstrap\Modal::end();
?>

<?= \gamitg\detailview4cols\DetailView4Col::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
            'attribute' => 'user_id',
			'value' => $model->user->username 
			],
            //'facility_id',
			[
            'attribute' => 'facility_id',
			'value' => $model->facility0->name,
			],
            [
			'attribute'=>'slot_from', 
			'value' =>   date('d M Y h:ia', strtotime($model->slot_from)),
			],
            //'amc_end',
			[
		    'attribute'=>'slot_to',
			'value' =>   date('d M Y h:ia', strtotime($model->slot_to)),
			],
           	[
			'attribute'=>'price',
			 'value' =>   $model->price == '' ? 'NA' :  'SGD '.Yii::$app->formatter->asDecimal($model->price),
			'label'=>'Cost Per Booking'
			],
			 [	
			 'attribute'=>'deposit',		
			 'value' =>   $model->deposit == 0 ? 'NA' :  'SGD '.Yii::$app->formatter->asDecimal($model->deposit), 
			 ],   
            'total_amount',
            'paid_amount',
           // 'payment_method_id',
			[
            'attribute' => 'payment_method_id',
			'value' => $model->method->title,
			],
            'payment_details',
           // 'payment_status',
			[
            'attribute' => 'payment_status',
			'value' => $model->status1->title,
			],
            'returned_amount',
           // 'returned_by',
			[
		    'attribute'=>'returned_by',
			'value' => $model->returned_by == '' ? 'NA' : $model->returned_by
			],
           // 'returned_date',
			[
		    'attribute'=>'returned_date',
			'value' => $model->returned_date == '' ? 'NA' : date('d F Y h:ia', strtotime($model->returned_date)),
			],
			 
			[
				'attribute'=>'returned_details',
				'value' => $model->returned_details == '' ? 'NA' : $model->returned_details,
			],
 
            //'cancelled_time',
			[
		    'attribute'=>'cancelled_time',
			'value' => $model->cancelled_time == '' ? 'NA' : date('d F Y h:ia', strtotime($model->cancelled_time)),
			],
            //'cancelled_by',
			[
		    'attribute'=>'cancelled_by',
			'value' => $model->cancelled_by == '' ? 'NA' : $model->cancel->name
			],
           // 'cancelled_reason',
			[
		    'attribute'=>'cancelled_reason',
			'value' => $model->cancelled_reason == '' ? 'NA' : $model->cancelled_reason
			],
            //'lapse_date',
			[
		    'attribute'=>'lapse_date',
			'value' => $model->lapse_date == 0 ? 'NA' : date('d F Y h:ia', strtotime($model->lapse_date)),
			],
           // 'lasttime_book:datetime',
			[
		    'attribute'=>'lasttime_book',
			'value' => $model->lasttime_book == 0 ? 'NA' : date('d F Y h:ia', strtotime($model->lasttime_book)),
			],
           // 'peak',
			[
		    'attribute'=>'peak',
			'value' => $model->peak == 0 ? 'Non-Peak' : 'Peak'
			],
            //'created',
			[
		    'attribute'=>'created',
			'format' => ['date', 'php:d M Y h:ia']
			],
           // 'created_by', 
            /* [
		    'attribute'=>'status',
			'value' => $model->status == 0 ? 'InActive' : 'Active'
			],*/
			[
            'attribute' => 'status',
			'value' => $model->status2->title,
			],
			[
			'attribute' => 'notes',
			'format' => 'raw',
			]

        ],
    ]);
	
	?>

</div>

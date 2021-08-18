<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\helpers\ArrayHelper; 
use common\models\FbBookingFacility;
use common\models\FbBookingStatus;
use common\models\Users;
use yii\jui\DatePicker;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FbBookingBookedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Booking Report';
$this->params['breadcrumbs'][] = $this->title;

// equivalent to: $get = $_GET;





?>
<div class="booking-report-index">

    <?php $gridColumns = [
            [
			'class' => 'yii\grid\SerialColumn',
			'contentOptions' => ['style' => 'max-width:40px;'],
			],
			[
				'attribute' => 'facility_id',
				'value' => 'facility0.name',
			],
		/*	[
			'attribute' => 'user_id',
			'label' => 'Resident',
			'value' =>  'user.fname',
			],  */


			[
				'attribute'=>'slot_from',
				'label' => 'Date',
				'value' => function($model){
						return date('Y-m-d', strtotime($model->slot_from));
				},
			 
			],

			
			[
				'attribute'=>'slot_from',
				'label' => 'From Time',
				'value' => function($model){
					return date('h:ia', strtotime($model->slot_from));
				},
			 
			],

			
			[
				'attribute'=>'slot_to',
				'label' => 'To Time',
				'value' => function($model){
					return date('h:ia', strtotime($model->slot_to));
								 
				},
			 
			],

			[
			'attribute' => 'user_id',
			'label' => 'Resident',
			'value' =>  'user.username',
			],
			[
				'attribute' => 'created_by',
				'label' => 'By Who',
				'value' => function($model){
					return $model->profiles->username ;
								 
				},
			],

			[
				'attribute' => 'facility_id',
				
			'label' => 'Restriction On Cancellation',
			'value' => function($model){
				return $model->facility0->cancel_date . ' hr(s) before usage time';
							 
			},
			 
			],
			
			[
				'attribute' => 'status',
				'format' => 'raw',
				'value' => function($model){
										
					$request = Yii::$app->request;

					$get = $request->get();
					$userid = $request->get('userid');
					$fac = $request->get('fac');
					$from = $request->get('from');
					$to = $request->get('to');
					$stat = $request->get('stat');

					$status = FbBookingStatus::findOne($model->status);
					$data = $status->title;
					$data .= '</br>';
										 
					if($model->status != '3'  ){ 
 

						$data .= Html::a('cancel', ['/fb-booking-booked/can' , 'id' => $model->id , 'userid' => $userid,
						'fac' => $fac,
						'from' => $from,
						'to' => $to,
						'stat' => $stat] , ['class' => 'btn btn-success btn-xs', 'data-pjax' => 'w0']);
					 
					}  

					if($model->status != '5' && $model->facility_id == '27' || $model->status != '5' && $model->facility_id == '38' ){ 
 

						$data .= Html::a('Absent', ['/fb-booking-booked/abs' , 'id' => $model->id , 'userid' => $userid,
						'fac' => $fac,
						'from' => $from,
						'to' => $to,
						'stat' => $stat] , ['class' => 'btn btn-danger btn-xs', 'data-pjax' => 'w0']);
					 
					}  
					if( $model->status != '7' && $model->facility0->group == '18'){ 
					 
						if( date("Y-m-d", strtotime($model->slot_from)) > date("Y-m-d")  ){
						
							$data .= Html::a('Rain', ['/fb-booking-booked/rain' , 'id' => $model->id , 'userid' => $userid,
							'fac' => $fac,
							'from' => $from,
							'to' => $to,
							'stat' => $stat] , ['class' => 'btn btn-info btn-xs', 'data-pjax' => 'w0']);
							$data .= '</br>';

						}		

					}  



					return $data;
				},
			], 

			
				  
    ]; 
	 
	
?>
    <p>	
    <?php	// Renders a export dropdown menu
    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'exportConfig' => [
            ExportMenu::FORMAT_PDF => true,
            ExportMenu::FORMAT_TEXT => false,
        ]
    ]);
    ?>  
    <?= Html::a('Export as PDF', ['fb-booking-booked/searchpdf', 
			'userid' => $userid,
			'fac' => $fac,
			'from' => $from,
			'to' => $to,
            'stat' => $stat,
			], 
			['class' => 'btn btn-danger', 'target'=>'_blank']) ?>
    </p>

   
<?php Pjax::begin(['id' => 'list-data-list', 'timeout' => false, 'enablePushState' => false]); ?>  
<?= GridView::widget([
        'dataProvider' => $dataProvider, 
		/*'rowOptions'   => function ($model, $index, $widget, $grid) {
								return [
									'id' => $model['id'], 
									'onclick' => 'location.href="'
										. Yii::$app->urlManager->createUrl('fb-booking-booked/view') 
										. '&id="+(this.id);',
									'style' =>'cursor:pointer;', 
								];
						 },	*/
		 'columns' => $gridColumns,
		 'pjax'=>true,
    ]); 
	?>
    
 <?php Pjax::end(); ?>
</div>

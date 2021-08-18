<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

use yii\grid\GridView;
use marekpetras\calendarview\CalendarView;
use yii\db\Query;

use yii\helpers\ArrayHelper;
use common\models\Users;
use common\models\Profiles;
use common\models\FbBookingFacility;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AttendanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Booking';
$facID = Yii::$app->request->get('facid');
$facID = $facID ? $facID : 1;
$userId = Yii::$app->request->get('uid');

?>
<div class="row">
  <div class="col-sm-3 col-xs-12">
    <?php $form = ActiveForm::begin(['action' => Url::to(['booking/index']), 'method' => 'get']);
		  echo Html::dropDownList('uid', $userId, ArrayHelper::map(Users::find()->asArray()->all(), 'id', 'username'),['class'=>'form-control','prompt' => 'Select User', 'required' => 'required']);
		  //Html::activeDropDownList($searchModel, 'facility_id', ArrayHelper::map(FbBookingFacility::find()->asArray()->all(), 'id', 'name'),['class'=>'form-control','prompt' => 'Select Facility'])
	?>
  </div>
  <div class="col-sm-3 col-xs-12">
    <?php echo Html::dropDownList('facid', $facID, ArrayHelper::map(FbBookingFacility::find()->asArray()->all(), 'id', 'name'),['class'=>'form-control','prompt' => 'Select Facility', 'required' => 'required']);
	?>
  </div>
  <div class="col-sm-3 col-xs-12">
    <?php //= Html::a('New Booking', ['booking/index'], ['class' => 'btn btn-success']) ?>
    <?= Html::submitButton('New Booking', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>
  </div>
</div>
<br />


    <?php
	//echo $calendar['timeStart'];
	echo yii2fullcalendar\yii2fullcalendar::widget([ 
      'options' => [
        'lang' => 'en',
	  
        //... more options to be defined here!
      ],
      //'ajaxEvents' => Url::to(['booking/jsoncalendar']) . '&facid=' . $facID
      'events'=> $calendar['events'],
	  'clientOptions' => [
			'minTime' => $calendar['timeStart'],
			'maxTime' => $calendar['timeEnd'],
			'slotDuration' => $calendar['slotDuration'],
			'defaultView' => 'agendaWeek',
			//'gotoDate' => $calendar['dateStart'],
			//maxTime' => $calendar['events'],
			// 'firstDay' => 'nextDay',
			// 'editable' => false,
			'contentHeight' => 'auto',
			'height' => 'auto',
			'now' =>  $calendar['dateStart'],
			
	  ],

	  
    ]);
?>
</div>

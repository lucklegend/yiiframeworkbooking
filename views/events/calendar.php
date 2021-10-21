<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use marekpetras\calendarview\CalendarView;
use yii\db\Query;
use common\models\FbBookingFacility;
use yii\bootstrap\Modal;
use yii\web\JsExpression;
//use Yii;
/* @var $this yii\web\View */
/* @var $searchModel common\models\AttendanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Events';
$this->params['subtitle'] = 'Events calendar';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-title">
  <h1 style="color:#ac7339;">Events</h1>
  <span class="line-h"></span> 
  <p><a style="color:#ac7339; font-weight:bold; background:none" href="index.php?r=events/index">Click here</a> to event list view</p>
  </div>
<?php
 
	echo yii2fullcalendar\yii2fullcalendar::widget([ 
      'options' => [
        'lang' => 'en',
      ],
      //'ajaxEvents' => Url::to(['booking/jsoncalendar']) . '&facid=' . $facIDtitle: eventObj.title,content: eventObj.description,
      'events'=> $events,
	  'eventRender' => 'function(eventObj, $el) { 
						    $el.popover({
								title: eventObj.description,
								trigger: \'hover\',
								placement: \'top\',
								container: \'body\'
						    }); 
						}',
	    
	  'clientOptions' => [
			'defaultView' => 'month',
//			'header'=>[
//	 				'left'=>'prev,next today',
//	 				'center'=> 'title',
//	 				'right'=> 'month,agendaWeek,agendaDay'
//	 		],
			'header'=>[
	 				'left'=>'prev, today',
	 				'center'=> 'title',
	 				'right'=> 'listYear,next'
	 		],
	  ],
    ]);
?>

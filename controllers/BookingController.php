<?php

namespace app\controllers;

use Yii;
use common\models\FbBookingBooked;
use common\models\FbBookingFacility;
use common\models\BookingRules;
use yii\db\Query;
use yii\filters\AccessControl;
use app\controllers\VerbFilter;



class BookingController extends \yii\web\Controller
{

	public function behaviors()
	{
		return [
			/*'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],*/
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@']
					]
				]
			]

		];
	}

	public function actionIndex()
	{
		$model = new FbBookingBooked();

		$query = new Query;
		$query->select(['*'])
			->from('fb_booking_group')
			->where(['bookable' => 1])
			->orderby(['name' => 'ASC']);
		//->where(['id' => $model->defect]);
		$command = $query->createCommand();
		$groups = $command->queryAll();
		$facly = FbBookingFacility::find()->all();
		$calendar = $this->actionCalendar();
		//exit;
		//print_r($events);
		return $this->render('index', [
			'calendar' => $calendar,
			'groups' => $groups,
			'facly' => $facly,
			'model' => $model,
		]);
	}

	public function actionCalendar($start = NULL, $end = NULL, $_ = NULL)
	{

		//Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		//echo Yii::$app->getBasePath();;
		$facID = Yii::$app->request->get('facid');
		$facID = $facID ? $facID : 14;
		$userId = Yii::$app->user->getId();

		if ($facID < 1 || $userId < 1) return NULL;
		$cRules = new BookingRules();
		//get the dateEnd, dateStart, events, slotDuration, TimeEnd, and TimeStart based on the facid
		$allSlots = $cRules->getCalendar($facID, $userId);
		// get the FbBookingFacility datas
		$facgrp = $cRules->facility($facID);

		$calendar = array();
		if ($allSlots['unitTime'] == 180) {
			$calendar['slotDuration'] = sprintf('%02d', $allSlots['unitTime'] / 180) . ':' . sprintf('%02d', $allSlots['unitTime'] % 180) . ':00';
		} else {
			$calendar['slotDuration'] = sprintf('%02d', $allSlots['unitTime'] / 120) . ':' . sprintf('%02d', $allSlots['unitTime'] % 120) . ':00';
		}
		$calendar['dateStart'] = $allSlots['dateStart'];
		$calendar['dateEnd'] = $allSlots['dateEnd'];
		$calendar['timeStart'] = $cRules->time2To3($allSlots['timeStart']);
		$calendar['timeEnd'] = $cRules->time2To3($allSlots['timeEnd']);
		$calendar['description'] = 'Test';

		$events = array();

		// disect all slots into pieces.
		foreach ($allSlots as $slotdate => $daySlot) {
			// echo $slotdate;
			// print_r($daySlot); 
			if (is_array($daySlot)) {
				
				foreach ($daySlot as $slottime => $slotDetails) {

					$Event = new \yii2fullcalendar\models\Event();
					$tid =  strtotime($slotdate . ' ' . $slottime);

					if ($slotDetails->alreadyReservedUser > 0 && $slotDetails->alreadyReservedUser != 0) {
						$Event->title = 'YB';
						$Event->description = 'Your Current Booking';
						$Event->className  = 'ybslot';
					}  elseif ( $slotdate  < $slotDetails->barr  && $facgrp->group == '18'  ) {
						$Event->title = 'BR';
						$Event->description = 'User Barred';
						$Event->className  = 'brslot';
					}  elseif ($slotDetails->chkRoom > 0 && $slotDetails->chkRoom != 0 ) {
						$Event->title = 'CL';
						$Event->description = 'Closed';
						$Event->className  = 'clslot'; 
					} elseif ($slotDetails->alreadyReserved == 1) {
						$Event->title = 'BO';
						$Event->description = 'Booked by Others';
						$Event->className  = 'boslot';
					} elseif ($slotdate == date("Y-m-d") && $cRules->time2To3($slotDetails->end) < date('H:i:s')) {
						$Event->title = 'CL';
						$Event->description = 'Closed';
						$Event->className  = 'naslot';
					} elseif ($slotDetails->closed == 1) {
						$Event->title = 'MT';
						$Event->description = 'Under Maintenance';
						$Event->className  = 'mtslot';
					} elseif ($slotDetails->reserveLimit == 0 && $slotDetails->canReserve == 0) {
						$Event->title = 'LE';
						$Event->description = 'Limit Exceeded';
						$Event->className  = ' leslot';
					} elseif ($slotDetails->canReserve == 1) {
						$Event->title = 'AV';
						$Event->description = 'Available for Booking';
						$Event->className  = ' avslot';
					} else {
						$Event->title = 'CL';
						$Event->description = 'Closed';
						$Event->className  = ' naslot';
					}

					if ($slotDetails->peak > 0 && $slotDetails->peak != 0) {
						$Event->className  .= ' peak';
					} elseif($slotDetails->nonPeak > 0 && $slotDetails->nonPeak != 0) {
						$Event->className  .= ' nonpeak';
					} else {
						
					}

					if ($slotDetails->closed === 1 || $slotDetails->blckday == 1   || $slotdate  < $slotDetails->barr  && $facgrp->group == '18' ) {
						$url = '';
					} elseif ($slotdate == date("Y-m-d") && $cRules->time2To3($slotDetails->end) < date('H:i:s')) {
						$url = '';
					} elseif ($slotDetails->canReserve === 1) {
						$url = 'index.php?r=fb-booking-booked/create&facid=' . $facID . '&tid=' . $tid . '&hash=' . md5($facID . $tid);
					} else {
						$url = '';
					}

					if($slotDetails->chkRoom > 0 && $slotDetails->chkRoom != 0 ){
						$url = '';
					}

					//$url= '';	
					//$Event->id = $time->id;
					//$Event->title = $slottime;
					$Event->url = $url;
					$Event->start = $slotdate . 'T' . $cRules->time2To3($slottime) . 'Z'; //date('Y-m-d\TH:i:s\Z',strtotime($time->slot_from));
					$Event->end = $slotdate . 'T' .  $cRules->time2To3($slotDetails->end) . 'Z'; //date('Y-m-d\TH:i:s\Z',strtotime($time->slot_from));
					$events[] = $Event;
				}
			}
		}
		
		$calendar['events'] = $events;
		// print_r($events);
		// exit();
		// echo '<script>console.log("Calendar: ");</script>';
		// echo '<script>console.log(' . json_encode($calendar) . ');</script>';
		return $calendar;
	}

	public function actionJsoncalendar($start = NULL, $end = NULL, $_ = NULL)
	{

		//Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		//echo Yii::$app->getBasePath();;
		$facID = Yii::$app->request->get('facid');
		$facID = $facID ? $facID : 1;
		$userId = Yii::$app->user->identity->id;

		if ($facID < 1 || $userId < 1) exit;
		$calendar = new BookingRules();
		$allSlots = $calendar->getCalendar($facID, $userId);

		//print_r($allSlots); 
		//exit;

		$events = array();

		foreach ($allSlots as $slotdate => $daySlot) {
			//echo $slotdate;
			//print_r($daySlot); 
			if (is_array($daySlot)) {
				foreach ($daySlot as $slottime => $slotDetails) {
					//	print_r($box); 
					$Event = new \yii2fullcalendar\models\Event();
					$tid =  strtotime($slotdate . ' ' . $slottime);

					if ($slotDetails->alreadyReserved == 1) {
						$Event->title = 'BO';
						$Event->className  = ' boslot';
					} elseif ($slotDetails->canReserve == 1) {
						$Event->title = 'AV';
						$Event->className  = ' avslot';
					} else {
						$Event->title = 'CL';
						$Event->className  = ' naslot';
					}

					if ($slotDetails->peak == 1) {
						$Event->className  .= ' peak';
					} else {
						$Event->className  .= ' nonpeak';
					}

					if ($slotDetails->closed === 1) {
						$url = '';
					} elseif ($slotDetails->canReserve === 1) {
						$url = 'index.php?r=fb-booking-booked/create&facid=' . $facID . '&tid=' . $tid . '&hash=' . md5($facID . $tid);
					} else {
						$url = '';
					}

					//$Event->id = $time->id;
					//$Event->title = $slottime;
					$Event->url = $url;
					$Event->description = 'qq';
					$Event->start = $slotdate . 'T' . $slottime . ':00Z'; //date('Y-m-d\TH:i:s\Z',strtotime($time->slot_from));
					$Event->end = $slotdate . 'T' . $slotDetails->end . 'Z'; //date('Y-m-d\TH:i:s\Z',strtotime($time->slot_from));
					$events[] = $Event;
				}
			}
		}
		// var_dump($events);
		// exit();
		return $events;
	}

	public function actionQuery($id = NULL)
	{
		Yii::$app->response->format = 'json';

		if (Yii::$app->request->isAjax) {
			$data = Yii::$app->request->get();
			//print_r($data);
			$id = explode(":", $data['id']);
			if (($model = FbBookingFacility::findOne($id)) !== null) {
				return $model;
			}
		}
	}
}

<?php

namespace app\controllers;
use Yii;
use common\models\FbBookingBooked;
use common\models\BookingRules;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class BookingController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['GET'],
                ],
            ],
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
		$calendar = $this->actionCalendar();
	//print_r($events);
        return $this->render('index', [
			 'calendar' => $calendar,
			 'groups' => $groups,
			 'model' => $model,
		]);
    }
	
  public function actionCalendar($start=NULL,$end=NULL,$_=NULL){

		//Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		//echo Yii::$app->getBasePath();;
		$facID = Yii::$app->request->get('facid');
		$facID = $facID ? $facID : 1;
		$userId = Yii::$app->request->get('uid');
		
		if($facID < 1 || $userId < 1) exit;
		$cRules = new BookingRules();
		$allSlots = $cRules->getCalendar($facID,$userId);
		
//		print_r($allSlots); 
//		exit;
		$calendar = array();
		$calendar['slotDuration'] = sprintf('%02d', $allSlots['unitTime']/60) . ':' . sprintf('%02d', $allSlots['unitTime']%60) . ':00';
		$calendar['dateStart'] = $allSlots['dateStart'];
		$calendar['dateEnd'] = $allSlots['dateEnd'];
		$calendar['timeStart'] = $cRules->time2To3($allSlots['timeStart']);
		$calendar['timeEnd'] = $cRules->time2To3($allSlots['timeEnd']);
	
		$events = array();
	
		foreach ($allSlots as $slotdate => $daySlot){
			//echo $slotdate;
			//print_r($daySlot); 
			if(is_array($daySlot)){
				foreach ($daySlot as $slottime => $slotDetails){
				//	print_r($box); 
					$Event = new \yii2fullcalendar\models\Event();
					$tid =  strtotime($slotdate . ' ' . $slottime);
				
					if( $slotDetails->alreadyReserved == 1) {
					  $Event->title = 'BO';
					  $Event->className  = ' boslot';
					} elseif( $slotDetails->canReserve == 1) {
					  $Event->title = 'AV';
					  $Event->className  = ' avslot';
					} else {
					  $Event->title = 'NA';
					  $Event->className  = ' naslot';
					}
					
					if ($slotDetails->peak > 0 && $slotDetails->peak != 0) {
						$Event->className  .= ' peak';
					} elseif($slotDetails->nonPeak > 0 && $slotDetails->nonPeak != 0) {
						$Event->className  .= ' nonpeak';
					} else {
						
					}
					
					if( $slotDetails->canReserve === 1) {
					  $url = 'index.php?r=fb-booking-booked/create&facid=' . $facID . '&tid=' . $tid . '&uid=' . $userId . '&hash=' . md5($facID.$tid);
					} else {
					  $url = '';
					}
					
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
		return $calendar;
		//return $events;
  }

  public function actionJsoncalendar($start=NULL,$end=NULL,$_=NULL){

		//Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		//echo Yii::$app->getBasePath();;
		$facID = Yii::$app->request->get('facid');
		$facID = $facID ? $facID : 14;
		$userId = Yii::$app->request->get('uid');
		
		if($facID < 1 || $userId < 1) exit;
		$calendar = new BookingRules();
		$allSlots = $calendar->getCalendar($facID,$userId);
		
//		print_r($allSlots); 
//		exit;
	
		$events = array();
	
		foreach ($allSlots as $slotdate => $daySlot){
			//echo $slotdate;
			//print_r($daySlot); 
			if(is_array($daySlot)){
				foreach ($daySlot as $slottime => $slotDetails){
				//	print_r($box); 
					$Event = new \yii2fullcalendar\models\Event();
					$tid =  strtotime($slotdate . ' ' . $slottime);
				
					if( $slotDetails->alreadyReserved == 1) {
					  $Event->title = 'BO';
					  $Event->className  = ' boslot';
					} elseif( $slotDetails->canReserve == 1) {
					  $Event->title = 'AV';
					  $Event->className  = ' avslot';
					} else {
					  $Event->title = 'NA';
					  $Event->className  = ' naslot';
					}
					
					if( $slotDetails->peak == 1) {
					  $Event->className  .= ' peak';
					} else {
					  $Event->className  .= ' nonpeak';
					}
					
					if( $slotDetails->canReserve === 1) {
					  $url = 'index.php?r=fb-booking-booked/create&facid=' . $facID . '&tid=' . $tid . '&hash=' . md5($facID.$tid);
					} else {
					  $url = '';
					}
					
					//$Event->id = $time->id;
					//$Event->title = $slottime;
					$Event->url = $url;
					$Event->start = $slotdate . 'T' . $slottime . ':00Z'; //date('Y-m-d\TH:i:s\Z',strtotime($time->slot_from));
					$Event->end = $slotdate . 'T' . $slotDetails->end . 'Z'; //date('Y-m-d\TH:i:s\Z',strtotime($time->slot_from));
					$events[] = $Event;
				}
			}
		}
	
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

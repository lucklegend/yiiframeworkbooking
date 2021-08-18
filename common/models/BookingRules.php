<?php
namespace common\models;
 
use Yii;
use common\models\FbBookingRules;
use common\models\FbBookingFacility;
use common\models\FbBookingGroup;
use common\models\FbBookingRulesSearch;
use common\models\FbBookingClosingday;
use common\models\FbBookingClosingdayFacility;

use yii\db\Query;

error_reporting(0);

class BookingRules extends \yii\db\ActiveRecord
{
	function errNotAllow($errno = NULL){
		switch ($errno) {
			case 1:
				return 'Booking date is not in range';
				break;
			case 2:
				return 'Booking Limit reached';
				break;
			case 3:
				return 'Not Allow';
				break;
			case 4:
				return 'Closed';
				break;
		}
		
	}
	
	function facility($facilityID){
		$modelFacility = FbBookingFacility::find()->where(['id' => $facilityID, 'published' => 1])->one();
		if($modelFacility->unit_time == 0){
			$modelFacility->unit_time = 60;
		} 
//		if($modelFacility->bookday_start == 0){
//			$modelFacility->bookday_start = 3;
//		} 
		if($modelFacility->bookday_end == 0){
			$modelFacility->bookday_end = 60;
		} 
		if($modelFacility->cancel_date == 0){
			$modelFacility->cancel_date = 24;
		} 

		return $modelFacility;
	}
	
	function allFacilities($facilityID = 0, $idOnly = false){
		$facility = $this->facility($facilityID);
		$allFacilities = FbBookingFacility::find()->where(['group' => $facility->group, 'published' => 1])->all();
		if($idOnly == false){
			return $allFacilities;
		} else {
			$facIDs = array();
			foreach($allFacilities as $fac){
				$facIDs[] = $fac->id;
			}
			return $facIDs;
		}
	}
	
	function canStatus(){
		$where = array();
		$where['can_book'] = '0';
		$canStatus = FbBookingStatus::find()->where($where)->all();
		$canIDs = array();
		foreach($canStatus as $can){
			$canIDs[] = $can->id;
		}
		return $canIDs;
	}
	
	function allRules($facilityID){
		
		$facility = $this->facility($facilityID);
		
		$where = array();
		if($facility->rulestype == 1){
			$where['facility'] = $facilityID;
		} elseif ($facility->rulestype == 0){
			$where['group'] = $facility->group;
		} else {
			$where['facility'] = $facilityID;
			$where['group'] = $facility->group;
		} 
		
		$AllRules = FbBookingRules::find()->where($where)->all();

		return $AllRules;

    }
	
	function countBooked($facilityID = 0, $user = NULL, $date = ''){
		$facility 	= $this->facility($facilityID);
		$count 		= array();
		$connection = \Yii::$app->db;
		$weekdays 	= $this->weekStartEnd($date);
		$monthdays	= $this->monthStartEnd($date);

		$where 		 = " `user_id` = '" . $user . "'";
		
		if($facility->rulestype == 1){
			$where .= ' and `facility_id` = ' . $facilityID;
		} elseif(count($this->allFacilities($facilityID, true)) > 0){
			$where .= ' and `facility_id` IN (' . implode(',', $this->allFacilities($facilityID, true)) . ')';
		} 
		
		$where .= ' and `status` IN (' . implode(',', $this->canStatus()) . ')';
		$sqlPeak = array();
		$sqlPeak['nonpeak'] .= ' and `peak` = 0';
		$sqlPeak['peak']	.= ' and `peak` = 1';
		$sqlPeak['total']	.= '';

		$nonpeak = 0;
		$peak = 1;
		$total = 2;
		
		$day = 1;
		$week = 2;
		$month = 3;
		
		$sqlType = array();
		$sqlType['day'] 	= " and `slot_from` like '%" . $date . "%'";
		$sqlType['week'] 	= " and `slot_from` between '" . $weekdays['start'] . " 00:00:00' and '" . $weekdays['end'] . " 23:59:00'";
		$sqlType['month'] 	= " and `slot_from` between '" . $monthdays['start'] . " 00:00:00' and '" . $monthdays['end'] . " 23:59:00'";
		
		//print_r($sqlType);
		foreach($sqlType as $tkey => $type){		// day, week, month
			foreach($sqlPeak as $pkey => $pValue){	// Peak, non peak
				$sql = 'SELECT count(`id`) as total FROM `fb_booking_booked` WHERE ' . $where . $type . $pValue;
				//echo $sql . "<br>\n"; 
				// exit;
				$model = $connection->createCommand($sql);
				$count[$$tkey][$$pkey] = $model->queryScalar();
			}
		}
		
		return $count;
		
	}
	
	
	function ckeckRules($facilityID, $user=NULL, $date){
		
		$facility = $this->facility($facilityID);
		 
        $modelRules 	= new FbBookingRules();
        $modelFacility 	= new FbBookingFacility();
		$blocklimit = array('nonpeak' => 0, 'peak' => 0, 'allday' => 0, 0 => 0, 1 => 0, 2 => 0);
		
		$allRules = $this->allRules($facilityID);
		$countBooked = $this->countBooked($facilityID, $user, $date);
		//print_r($allRules); 
		//print_r($countBooked); 
		//exit;
		if(is_array($allRules)){
			foreach($allRules as $rule){
				//print_r($countBooked)."<br>";
				//echo $countBooked[$rule->range_type][$rule->peak] ." >= " .$rule->range_limit ."<br>";
		
				if($countBooked[$rule->range_type][$rule->peak] >= $rule->range_limit){
					//$blocklimit[$rule->peak] = 1;

					if($rule->peak == 0){
						$blocklimit['nonpeak'] = 1;
					} elseif($rule->peak == 1){
						$blocklimit['peak'] = 1;
					} elseif($rule->peak == 2){
						$blocklimit['allday'] = 1;
					}
					
					if($rule->condition == 'or' && $facility->group == 18 ){
						$blocklimit['allday'] = 1;
					}
					
				}
			}
			
			if($blocklimit['allday'] == 1) {
				$blocklimit['nonpeak'] = 1;
				$blocklimit['peak'] = 1;
				$blocklimit[0] = 1;
				$blocklimit[1] = 1;
			}
			
		}
		//print_r($blocklimit);
		return $blocklimit;

	}
	
	function chkRoom($fac, $date = '' , $stime , $etime){
	 
	 
		$st = date("H:i:s", strtotime($stime));
		$et = date("H:i:s", strtotime($etime));

		$dtime = " AND date(`slot_from`) = '". $date ."'  ";
		
		if($fac == '18'){

			$fty = '24 , 26';
			$tme = " AND CAST(time(`slot_from`) as time) >= '".  $st ."' AND CAST(time(`slot_to`) as time) <= '". $et ."' ";
			 
		} elseif( $fac == '24' || $fac == '26') {


			if($st == '15:00:00' && $et == '16:00:00'){
				$st = '14:00:00';
				$et = '15:00:00';
			}
		
			$fty = '18';
			$tme = " AND CAST(time(`slot_from`) as time) <= '". $st ."' AND CAST(time(`slot_to`) as time) >= '". $et ."' ";

		}  else {
			$fty = '1';
			$tme = '' ;
		}
 
		
		$usr = Yii::$app->user->identity->id;
		$connection = \Yii::$app->db; 
		$status = ' AND status IN ("1" , "2") ';

		//$sql = 'SELECT COUNT(*) FROM `fb_booking_booked` WHERE `user_id` =  '. $usr .' AND  `facility_id` IN ( '.$fty.' )  ' . $dtime . $tme . $status ; 
		
		$sql = 'SELECT COUNT(*) FROM `fb_booking_booked` WHERE    `facility_id` IN ( '.$fty.' )  ' . $dtime . $tme . $status ; 
	 
		
		 

		$model = $connection->createCommand($sql); 
		$count = $model->queryScalar();  
		
		return $count;
 
	}

	
	function getBarr($fac, $user , $date){
	 
	  
	  
		$facility 		= $this->facility($fac); 
		$connection = \Yii::$app->db; 

		  $sql = "SELECT `expiry` FROM `fb_barring` WHERE `group_id` =  '". $facility->group ."'  AND  `user_id` =  '". $user ."'    " ; 
		 
		$model = $connection->createCommand($sql); 
		$count = $model->queryScalar();  
		 
		return $count;
 
	}

	function alreadyBookedUsd($fac, $date = '' , $user  , $stime , $etime ){
	 
	 
		 
		 
		$st = date("H:i:s", strtotime($stime));
		$et = date("H:i:s", strtotime($etime));

		$dtime = " AND `user_id` = '".  $user ."' AND date(`slot_from`) = '". $date ."'  AND CAST(time(`slot_from`) as time) = '".  $st ."' AND CAST(time(`slot_to`) as time) = '". $et ."' ";
		 
 
		
		 
		$connection = \Yii::$app->db; 
		$status = ' AND status IN ("1" , "2") ';

		$sql = 'SELECT COUNT(*) FROM `fb_booking_booked` WHERE `facility_id` IN ( '.$fac.' )  ' . $dtime .  $status ; 
	  

		$model = $connection->createCommand($sql); 
		$count = $model->queryScalar();  
		
		return $count;
 
	}



	
    function getCalendar($facilityID, $user = 0, $dateStart = '', $dateEnd = '', $isAdmin = false){
		//exit;
		//$time_start = microtime(true);  //for time debug
		
		$facility 		= $this->facility($facilityID);
		$slotTimes 		= $this->slotTimes($facilityID);
		$bookday_start 	= $facility->bookday_start;
		$bookday_end 	= $facility->bookday_end;
		
//		print_r($slotTimes);
//		exit;
		
		$facDayStart 	= date('Y-m-d', strtotime("+$bookday_start days", strtotime(date('Y-m-d'))));
		$facDayEnd 		= date('Y-m-d', strtotime("+$bookday_end days", strtotime(date('Y-m-d'))));
		if($dateStart == '' || $dateStart == '0000-00-00' || $dateStart < $facDayStart) $dateStart = $facDayStart;
		if($dateEnd == '' || $dateEnd == '0000-00-00' || $dateEnd > $facDayEnd) $dateEnd = $facDayEnd;
		
		$boxes = array();
		for($date = $dateStart;$date <= $dateEnd; $date = date('Y-m-d', strtotime('+1 days', strtotime($date)))){
			//echo $date;
			$closed 		= $this->closingFac($facilityID, $date); 
		
			$countBooked 	= $this->countBooked($facilityID, $user, $date);
			$ckeckRules 	= $this->ckeckRules($facilityID, $user, $date);
			
			foreach($slotTimes as $skey => $slot){
				$slotTime 	= $date . ' ' . $this->floatToTime($slot['start']);
				$room	 	= $this->chkRoom($facilityID, $date , $this->floatToTime($slot['start']) , $this->floatToTime($slot['end']) );  
				$booked 	= $this->alreadyBooked($facilityID, $slotTime);
				$bkduser 	= $this->alreadyBookedUsd($facilityID, $date, $user , $this->floatToTime($slot['start']) , $this->floatToTime($slot['end']));
				$getPeak 	= $this->getPeak($facilityID, $date, $this->floatToTime($slot['start']));
				$getNonPeak = $this->getNonPeak($facilityID, $date, $this->floatToTime($slot['start']));
				$barr		= $this->getBarr($facilityID, $user ,$date);
				//print_r($getPeak);
				//print_r($slot);
				 
				$box = new \stdClass();
				$box->start 				= $this->floatToTime($slot['start']);
				$box->end 					= $this->floatToTime($slot['end']);
				$box->closed 				= $closed['closeday'];
				$box->closedText 			= $closed['closetext'];
				$box->peak 					= $getPeak;
				$box->nonPeak				= $getNonPeak;
				$box->blocknonpeak 			= $ckeckRules['nonpeak'];
				$box->blockpeak 			= $ckeckRules['peak'];
				$box->blockallday 			= $ckeckRules['allday'];
				$box->alreadyReserved 		= $booked;
				$box->alreadyReservedUser 	= $bkduser;
				$box->chkRoom 				= $room;
				$box->barr	 				= $barr;
				$box->reserveLimit 	= 1;


				
				if( $box->alreadyReserved){
					$box->canReserve 	= 0;
				} elseif($box->blockpeak == 1 && $box->peak == 1  ){
					$box->reserveLimit 	= 0;
					$box->canReserve 	= 0;
				} elseif($box->blocknonpeak == 1  && $box->nonPeak == 1  ){
					$box->reserveLimit 	= 0;
					$box->canReserve 	= 0;
				} elseif($box->blockallday == 1){
					$box->reserveLimit 	= 0;
					$box->canReserve 	= 0;
				}   else {
					$box->canReserve 	= 1;
					
				} 



				
			/*	if( $box->alreadyReserved){
					$box->canReserve 	= 0;
				} elseif($box->blockpeak   ){
					$box->reserveLimit 	= 0;
					$box->canReserve 	= 0;
				} elseif($box->blocknonpeak  ){
					$box->reserveLimit 	= 0;
					$box->canReserve 	= 0;
				} elseif($box->blockallday == 1){
					$box->reserveLimit 	= 0;
					$box->canReserve 	= 0;
				} else {
					$box->canReserve 	= 1;
					
				} 


			if($box->alreadyReserved){
					$box->canReserve 	= 0; 
				} elseif(Yii::$app->user->identity->role == 'superadmin') {
				 $box->canReserve 	= 1;	
				}elseif($box->blockpeak && $box->peak == 1){
					$box->reserveLimit 	= 0;
				} elseif($box->blocknonpeak && $box->peak == 1){
					$box->reserveLimit 	= 0;
				} elseif($box->blockallday == 1){
					$box->reserveLimit 	= 0;
				} else {
					$box->canReserve 	= 1;
				}*/
//				$box->boxClass
//				$box->boxText
//				$box->boxTips
				$boxes[$date][$this->floatToTime($slot['start'])] = $box;
			}
//			echo $date .'<br>';
//			$i++;
//			if($i > 10) break;
			//echo '<br>Total execution time in seconds: ' . (microtime(true) - $time_start);

		}
		$totalSlot			= count($slotTimes) - 1;
		$boxes['unitTime']  = $facility->unit_time;
		$boxes['dateStart'] = $dateStart;
		$boxes['dateEnd'] 	= $dateEnd;
		$boxes['timeStart'] = $this->floatToTime($slotTimes[0]['start']);
		$boxes['timeEnd'] 	= $this->floatToTime($slotTimes[$totalSlot]['end']);
		//print_r($boxes);
		//echo '<br>Total execution time in seconds: ' . (microtime(true) - $time_start);
		return $boxes;
		
	}
   
    function checkSave($facilityID, $user = 0, $date = '', $isAdmin = false){
		//exit;
		$created_by		= Yii::$app->user->identity->id;
		$facility 		= $this->facility($facilityID);
		$bookDate		= date('Y-m-d', strtotime($date));
		$bookTime		= date('H:i:s', strtotime($date));

		$getPeak 		= $this->getPeak123($facilityID, $bookDate, $bookTime);
		$closed 		= $this->closingFac($facilityID, $bookDate);
		$countBooked 	= $this->countBooked($facilityID, $user, $date);
		$ckeckRules 	= $this->ckeckRules($facilityID, $user, $date);
		$booked 		= $this->alreadyBooked($facilityID, $date);
		
		$peak 			= $getPeak['peak']?1:0;
		$unit_time		= $facility->unit_time;
		$lapse_date		= $facility->lapse_date;
		
		//print_r($facility);
		//print_r($slot);
		//		exit;
		$data = array();
		$data['user_id'] 		= $user;
		$data['facility_id'] 	= $facilityID;
		$data['slot_from'] 		= $date;
		$data['slot_to'] 		= date('Y-m-d H:i:s', strtotime("+$unit_time minute", strtotime($date)));
		$data['lapse_date'] 	= $lapse_date ? date('Y-m-d H:i:s', strtotime("+$lapse_date days", strtotime($date))) : NULL;
		$data['lasttime_book'] 	= 0;
		$data['peak'] 			= $peak;
		$data['created'] 		= date('Y-m-d H:i:s');
		$data['created_by'] 	= $created_by;
		$data['status'] 		= $facility->default_status;
		
		if($closed['closeday'] || $ckeckRules['allday'] || $booked){
			$data['can'] 	= 0;
		} elseif($ckeckRules['peak'] && $peak){
			$data['can'] 	= 0;
		} elseif($ckeckRules['nonpeak'] && $peak == 0){
			$data['can'] 	= 0;
		} else {
			$data['can'] 	= 1;
		}
		return $data;
		
	}
	
	function getPeak123($facilityID, $date, $slotTime){
		$connection = \Yii::$app->db;
		$facility = $this->facility($facilityID);
		
		if($facility->slottype == 1){
			$where = "and `facility` = '" . $facilityID . "'";
		} else {
			$where = "and `group` = '" . $facility->group . "'";
		} 
		
		$dText = date('l', strtotime($date));
		$where .= ' and `' . strtolower($dText) . '` = "1"';
		$sql = "SELECT * FROM `fb_booking_slot` WHERE '$slotTime' >= `time_from` AND '$slotTime' < `time_to` " . $where;
		$model = $connection->createCommand($sql);
		return $model->queryOne();
	}

	function getPeak($facilityID, $date, $slotTime){
		$connection = \Yii::$app->db;
		$facility = $this->facility($facilityID);
		
		if($facility->slottype == 1){
			$where = "and `facility` = '" . $facilityID . "' and peak = '1' ";
		} else {
			$where = "and `group` = '" . $facility->group . "'  and peak = '1' ";
		} 
		
		$dText = date('l', strtotime($date));
		$where .= ' and `' . strtolower($dText) . '` = "1"';
		$sql = "SELECT COUNT(*) FROM `fb_booking_slot` WHERE '$slotTime' >= `time_from` AND '$slotTime' < `time_to` " . $where;
		$model = $connection->createCommand($sql); 
	 	 
		$count = $model->queryScalar();  
		
		return $count; 
	}

	function getNonPeak($facilityID, $date, $slotTime){
		$connection = \Yii::$app->db;
		$facility = $this->facility($facilityID);
		
		if($facility->slottype == 1){
			$where = "and `facility` = '" . $facilityID . "' and peak = '0' ";
		} else {
			$where = "and `group` = '" . $facility->group . "'  and peak = '0' ";
		} 
		
		$dText = date('l', strtotime($date));
		$where .= ' and `' . strtolower($dText) . '` = "1"';
		$sql = "SELECT COUNT(*) FROM `fb_booking_slot` WHERE '$slotTime' >= `time_from` AND '$slotTime' < `time_to` " . $where;
		$model = $connection->createCommand($sql); 
	 	 
		$count = $model->queryScalar();  
		
		return $count; 
	}


	
	function checkRulesLimit($facilityID = 0, $user = NULL, $date = '', $peak = 0, $type = 1){
		
		//print_r($subject); exit;
		if(is_object($subject)) {
			$subjects = $subject->id;
		} elseif(is_array($subject)) {
			$subjects = implode(',', $subject);
		} else {
			$subjects = $subject;
		}
		
		if($peak == 0){
				$wheresql[] = "fb_booking_reservation_items.`peak` = 0";
		} elseif($peak == 1){
				$wheresql[] = "fb_booking_reservation_items.`peak` = 1";
		}
		
		switch ($type) {
			case 1:
				$wheresql[] = "DATE(fb_booking_reservation_items.`from`) = DATE('$date')";
				break;
			case 2:
				$wheresql[] = "YEARWEEK(fb_booking_reservation_items.`from`) = YEARWEEK('$date')";
				break;
			case 3:
				$wheresql[] = "YEAR(fb_booking_reservation_items.`from`) = YEAR('$date') and MONTH(fb_booking_reservation_items.`from`) = MONTH('$date')";
				break;
		}
		
		$where		= implode(' and ', $wheresql);
		$sql 		= "SELECT count(*) FROM fb_booking_reservation
						INNER JOIN fb_booking_reservation_items ON fb_booking_reservation_items.reservation_id = fb_booking_reservation.id
						WHERE
						fb_booking_reservation.customer = '$customer' AND
						fb_booking_reservation_items.`subject` in (" . $subjects . ") AND $where";
						
		$db->setQuery($sql);
		$items = $db->loadResult();
		//echo $sql . ' = = ' . $items . '<br><br>';
		return $items;

    }
	
	
	
	function timeLimits($facilityID){
		$connection = \Yii::$app->db;
		$facility = $this->facility($facilityID);

		if($facility->slottype == 1){
			$where = "`facility` = '" . $facilityID . "'";
		} else {
			$where = "`group` = '" . $facility->group . "'";
		} 
	
		$model = $connection->createCommand('SELECT min(`time_from`) as min, max(`time_to`) as max FROM `fb_booking_slot` WHERE ' . $where);

		return $model->queryOne();
	}
	
	function slotTimes($facilityID){
		$facility = $this->facility($facilityID);
		$allSlots = $this->allSlots($facilityID);	
		//print_r($facility);
		//print_r($allSlots);
		 //exit;
		$i = 0;
		$slotDec = array();
		foreach($allSlots as $slot){
			if($slot->time_to == '00:00:00') {
				$slot->time_to = '24:00:00'; 
			} else {
				$slot->time_to = $slot->time_to;
			}
			$start = $this->timeToFloat($slot->time_from);
			do{
				if($start + $facility->unit_time <= $this->timeToFloat($slot->time_to)){
					$slotDec[$i]['start'] = $start;
					$start	 += $facility->unit_time;
					$slotDec[$i]['end'] = $start;
					$i++;
				}
				//if($i <= 10) print_r($slotDec); exit;
			} while($start < $this->timeToFloat($slot->time_to) && $start != $this->timeToFloat($slot->time_to));
		}
				
		return $slotDec;
	}
	
	function allSlots($facilityID){
		
		$facility = $this->facility($facilityID);
		
		$where = array();
		if($facility->slottype == 1){
			$where['facility'] = $facilityID;
		} else {
			$where['group'] = $facility->group;
		} 
		
		$allSlots = FbBookingSlot::find()
							->where($where)
							->orderBy([
								   'time_from'=>SORT_ASC
								])
							->all();
		return $allSlots;
	}
	
	
	
	function countDayBooked($facilityID = 0, $user = NULL, $date = ''){
		$facility 	= $this->facility($facilityID);
		$count 		= array();
		$connection = \Yii::$app->db;
		$where 		 = ' `user_id` = ' . $user;
		
		if($facility->rulestype == 1){
			$where .= ' and `facility_id` = ' . $facilityID;
		} elseif(count($this->allFacilities($facilityID, true)) > 0){
			$where .= ' and `facility_id` IN (' . implode(',', $this->allFacilities($facilityID, true)) . ')';
		} 
		$where .= " and `slot_from` = '" . $date . "'";
		
		$where .= ' and `status` IN (' . implode(',', $this->canStatus()) . ')';
		$sqlPeak = array();
		$sqlPeak['peak']	.= ' and `peak` = 1';
		$sqlPeak['nonpeak'] .= ' and `peak` = 0';
		
		
		foreach($sqlPeak as $pkey => $peak){
			$sql = 'SELECT count(`id`) as total FROM `fb_booking_booked` WHERE ' . $where . $type . $peak;
			//echo $sql . '<br>'; // exit;
			$model = $connection->createCommand($sql);
			$count[$pkey] = $model->queryScalar();
		}
		
		return $count;
		
	}
	
	function alreadyBooked($facilityID = 0, $date = ''){
		$where = array();
		$where['slot_from'] = $date;
		$where['status'] = $this->canStatus();
		
		$functionRooms = array(28,29,30,31,32,33);
		
		if(in_array($facilityID, $functionRooms)) {
			if($facilityID == 28) {
				$funRoom = array(28,32,33);
			} elseif($facilityID == 29) {
				$funRoom = array(29,31,32,33);
			} elseif($facilityID == 30) {
				$funRoom = array(30,32,33);
			} elseif($facilityID == 31) {
				$funRoom = array(28,29,31,32,33);
			} elseif($facilityID == 32) {
				$funRoom = array(29,30,31,32,33);
			} else {
				$funRoom = array(28,29,30,31,32,33);
			}
			$count = FbBookingBooked::find()
					->where($where)
					->andWhere(['in', 'facility_id', $funRoom])
					->count();
		} else {
			$where['facility_id'] = $facilityID;
			$count = FbBookingBooked::find()
					->where($where)
					->count();
		}
		   
		return $count;
		
	}
	
	function alreadyBookedUser($facilityID = 0, $date = '', $userID){
		$where = array();
		$where['slot_from'] = $date;
		$where['status'] = $this->canStatus();
		$where['user_id'] = $userID;
		
		$functionRooms = array(28,29,30,31,32,33);
		
		if(in_array($facilityID, $functionRooms)) {
			if($facilityID == 28) {
				$funRoom = array(28,32,33);
			} elseif($facilityID == 29) {
				$funRoom = array(29,31,32,33);
			} elseif($facilityID == 30) {
				$funRoom = array(30,32,33);
			} elseif($facilityID == 31) {
				$funRoom = array(28,29,31,32,33);
			} elseif($facilityID == 32) {
				$funRoom = array(29,30,31,32,33);
			} else {
				$funRoom = array(28,29,30,31,32,33);
			}
			$count = FbBookingBooked::find()
					->where($where)
					->andWhere(['in', 'facility_id', $funRoom])
					->count();
		} else {
			$where['facility_id'] = $facilityID;
			$count = FbBookingBooked::find()
					->where($where)
					->count();
		}
		   
		return $count;
		
	}
	
	function closingFac($facilityID = 0, $date = ''){
		$close 		= array();
		$close['closeday'] = 0;
		$connection = \Yii::$app->db;
		$sql = "SELECT * FROM `fb_booking_closingday` WHERE '$date' between `date_from` AND `date_to` and `facility` = '$facilityID'";
	
		$model = $connection->createCommand($sql);
		$closing = $model->queryOne();
		$cday_count = $model->queryScalar();

		if($cday_count > 0){
			$close['closeday'] = 1;
			if($closing->time_from == $closing->time_to){
				$close['closepart'] = 0;
			} else {
				$close['closepart'] = 1;
			}
			//echo 'fff';
		} else {
			$close['closeday'] = 0;
			$close['closepart'] = 0;
		}
		$close['closetext'] = $closing->title;

		return $close;
	}
	
	function bookedDetails($facilityID = 0, $user = NULL, $date = '', $peak = 0, $type = 1){
		$facility = $this->facility($facilityID);
		$where = NULL;
		$where .= '`user_id` = ' . $user;
		$where .= '`peak` = ' . $peak;
		
		if($facility->rulestype == 1){
			$where .= '`facility_id` = ' . $facilityID;
		} else{
			$where .= '`facility_id` IN ' . implode(',', $this->allFacilities($facilityID, true));
		} 

		if($type == 1){
			$where .= '`slot_from` = ' . $date;
		} elseif($type == 2){
			$where .= '`slot_from` = ' . $user;
		} else {
			$where .= '`slot_from` = ' . $user;
		}
		
		$where .= '`status` IN ' . implode(',', $this->canStatus());
		
		$allSlots = FbBookingBooked::find()
							->select('min(`time_from`) as min, max(`time_to`) as max')
							->where($where)
							->orderBy([
								   'time_from'=>SORT_ASC
								])
							->all();
		return $allSlots;
		
	}
	
	function weekStartEnd($date){
		$dto = new \DateTime();
		$week = date('W', strtotime($date));
		$year = date("Y",strtotime($date));
		$result['start'] = $dto->setISODate($year, $week, 0)->format('Y-m-d');
		$result['end'] = $dto->setISODate($year, $week, 6)->format('Y-m-d');
		//print_r($result);
		return $result;
	}
	
	function monthStartEnd($date){
		$result['start'] = date('Y-m-01', strtotime($date));
		$result['end'] = date('Y-m-t', strtotime($date));
		return $result;
	}
	
    function timeToFloat($time, $intervel=0) {
		$ta = split(':',$time);
		return $ta[0] * 60 + $ta[1] + $intervel;
	}

    function time2To3($time) {
		$ta = split(':',$time);
		return sprintf('%02d', $ta[0]) . ':' . sprintf('%02d', $ta[1]) . ':00';
	}
	
    function floatToTime($time) {
		$hrs = floor($time/60);
		$min = $time%60;
		//return $hrs . ':' . sprintf("%02d",$min) . ':00';
		return $hrs . ':' . sprintf("%02d",$min);
	}

}

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

$this->title = 'Booking';
?> 
		<div class="navbar-collapse in nav1">
      		<ul class="nav navbar-nav">
			<div class="page-title" style="margin: 10px 0px;">
				<img height="36" src="img/t/online.gif" width="263">
									<span class="line-h"></span>
				<p>Booking For less than 3 days is not allowed for the facilities BBQ Pit, Entertainment Room ,North Function Room, South Function Room </p>
				<h4>Please select the facilities for book.</h4>
			</div> 
					 <li class="dropdown dropdown4" id="moblst" style="color:  #FFF;margin-left: 5px;padding: 5px;width: 190px;">
        			<a class="dropdown-toggle" data-toggle="dropdown" href="#"  style="border-radius: 10px;background-color: #8c6238; color: #FFF;" >
							 Facility List
							<span class="caret"></span></a>
							
			 				<?php   
			 
							echo '<ul class="dropdown-menu">';
							foreach ($facly as $fav){
								echo '<li><a href="index.php?r=booking/index&facid='.$fav->id.'" style="color: #FFF;"> '.$fav->name.'</a></li>';
							}
							echo '</ul>';
							?>
				 </li>
				<?php
				// $groups came from BookingController.. 
				echo '<script>console.log('.json_encode($groups).');</script>';
				foreach($groups as $group){ 
				
					$groupid = $group['id'];
				
					$query = new Query;
					$query->select(['group'])
						->from('fb_booking_facility')
						->where(['group' => $groupid]);
					$command = $query->createCommand();
					$group_id = $command->queryScalar();
				
					if($groupid == $group_id){
				 	// if(count($group_id) > 0){
					  
						$query = new Query;
						$query->select(['*'])
							->from('fb_booking_facility')
							->orderby(['name' => 'ASC'])
							->where(['group' => $groupid]);
						$command = $query->createCommand();
						$facilities = $command->queryAll();
 
						foreach($facilities as $facility){  
							if($facility['group'] == $groupid  ){
								echo '<a class="btn btn deslstClass"  id="deslst" href="index.php?r=booking/index&facid='.$facility['id'].'"> '.$facility['name'].'</a> ';
							}
						}   
					}
				}
				 
				 
				 ?>
        </ul>

	</div> 

	<?php

		$model123 = FbBookingFacility::find()
			->select('notes')
			->where(['id' => Yii::$app->request->get('facid')])
			->one(); 
		
		$notes = $model123->notes;
		if(!empty(Yii::$app->request->get('facid')) && $model123->notes != ''){

			Modal::begin([
				'header' => '<h3>Operating Hours:</h3>',
				'toggleButton' => ['label' => 'click me', 'id'=>'btncls','style'=>"display:none;"],	
			]);

			echo $model123->notes;

			Modal::end();
		}
		if(empty(Yii::$app->request->get('facid'))){
			echo "<h4>Please select the facilities for book.</h4>";
		
		}
	?>

	<?php 	
		$query1 = new Query;	
		$query1->select(['*'])
			->from('fb_booking_facility')
			->orderby(['name' => 'ASC'])
			->where(['id' => Yii::$app->request->get('facid')]);

		$command1 = $query1->createCommand();	
		$facil = $command1->queryAll();	
			foreach($facil as $fa ) 	{  			       
	?>
	<div>
		<!-- showing the name of facility -->
		<h3 class="h3"> <?php  echo  $fa["name"];  }   ?> </h3>
	</div>
 
    <?php
	$facID = Yii::$app->request->get('facid');
	
	if($facID != '') {
		$facID = $facID ? $facID : 1; 
  
 
		foreach ($calendar['events'] as $eve){
			if($eve['title'] == 'MT') {
				$eve['description'].'<br/>';
			}
		}
 
		echo yii2fullcalendar\yii2fullcalendar::widget([ 
			'options' => [
			'lang' => 'en',
					//... more options to be defined here!
			],
			//'ajaxEvents' => Url::to(['booking/jsoncalendar']) . '&facid=' . $facIDtitle: eventObj.title,content: eventObj.description,
			'events'=> $calendar['events'],
			'eventRender' => 'function(eventObj, $el) { 
								$el.popover({
								title: eventObj.description,
								trigger: \'hover\',
								placement: \'top\',
								container: \'body\'
								}); 
							}',
				
			'clientOptions' => [
				'minTime' => $calendar['timeStart'],
				'maxTime' => $calendar['timeEnd'],
				'slotDuration' => $calendar['slotDuration'],
				'defaultView' => 'agendaWeek',
				// 'gotoDate' => $calendar['dateStart'],
				// 'maxTime' => $calendar['events'],
				// 'firstDay' => 'nextDay',
				// 'editable' => false,
				'contentHeight' => 'auto',
				'height' => 'auto',
				'allDaySlot' => false,
				'aspectRatio' => 2,
				// 'timeFormat' => 'h:mma',
				'now' =>  $calendar['dateStart'],
				'footer' => ['left' => 'prev',  'right' =>  'next'],
			],
		]);
	}
 		
	if($facID != ''){ ?>
      <div class="BOX_LEGEND"  ><br/>
            <h3 class="h3">Legends</h3>
				<br/>
						<div class="BOX_IN_LEGEND">
							<div class="BOX_AV LEGEND" style="background-color: #008000; color: white">  AV </div>
							<div class="BOX_LABEL"> Available for Booking </div>
						</div>
						<div class="BOX_IN_LEGEND">
							<div class="BOX_BO LEGEND" style="background-color: #ddd; color: black">  BO </div>
							<div class="BOX_LABEL"> Booked by Others </div>
						</div>
						<div class="BOX_IN_LEGEND">
							<div class="BOX_MT LEGEND" style="background-color: #FFCCCC; color: #D14646">  MT </div>
							<div class="BOX_LABEL"> Under Maintenance  </div>
						</div>
						<div class="BOX_IN_LEGEND">
							<div class="BOX_NA LEGEND" style="background-color: #f44336; color: #ffffff">  CL </div>
							<div class="BOX_LABEL"> Closed  </div>
						</div>
						<div class="BOX_IN_LEGEND">
							<div class="BOX_YB LEGEND" style="background-color: #7EABF5; color: #FFFFFF">  YB </div>
							<div class="BOX_LABEL"> Your Current Booking  </div>
						</div>
						<div class="BOX_IN_LEGEND">
							<div class="BOX_LE LEGEND" style="background-color: #DF7575; color: #FFFFFF">  LE </div>
							<div class="BOX_LABEL"> Limit Exceeded  </div>
						</div>

					 	<div class="BOX_IN_LEGEND">
							<div class="BOX_PH LEGEND" style="background-color: #cbe9c7; color: black">  AV </div>
							<div class="BOX_LABEL"> Non Peak Hours  </div>
						</div>
						<div class="BOX_IN_LEGEND">
							<div class="BOX_LM LEGEND" style="background-color: #fcddd8; color: black">  AV </div>
							<div class="BOX_LABEL"> Peak Hours  </div>
						</div>
						<div class="BOX_IN_LEGEND">
							<div class="BOX_LB LEGEND" style="background-color: #dc3333; color: #FFFFFF">  BR </div>
							<div class="BOX_LABEL"> User Barred  </div>
						</div> 
				</div>    
 			</div>
		</div> 
	<?php } ?>
<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<style>
  
.BOX_LABEL {
	float: right;
  background: #FFFFFF;
  font-size: 12px;	
  color: #333333;
  border: 0;
  width: 200px;
  text-align: left;
	display: block;		
	font-family: 'Montserrat', sans-serif;		
	border-radius: 0px 3px 3px 0px;
}

.BOX_IN_LEGEND .LEGEND {
  float: left;
  width: 66px;
  cursor: default;
  font-size: 12px;		
	font-weight:bold;		
	font-family: 'Montserrat', sans-serif;		
	border-radius: 3px 0px 0px 3px;	
}

.BOX_IN_LEGEND {
  border-right: 1px SOLID #000000;
  margin: 4px;
  width: 278px;
  display: inline-block;
  margin-right: 4px;
}
.BOX_AV, .BOX_BO, .BOX_MT, .BOX_NA, .BOX_LE, .BOX_YB, .BOX_LM, .BOX_PH, .BOX_LB, .BOX_PH_NA, .BOX_LABEL{
  padding-top: 5px;
  padding-bottom: 5px; 
  border: 1px SOLID #DFDFDF;
  margin: 1px;
  color: #333333;
  display: block;
  text-align: center;
}

.leslot {
  background-color: #DF7575 !important;
}
.mtslot {
  background-color: #FFCCCC !important;
  color: #D14646 !important;
}
.deslstClass{
	background-color:#8c6238;
	color: white;
	padding-top: 15px; 
	padding-bottom: 15px;
	padding-right: 15px;
	padding-left: 15px; 
	margin: 5px; 
}

.deslstClass:hover{
	background-color:#C8BC9B!important;
}
media only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {
	/* Force table to not be like tables anymore */
	table, thead, tbody, th, td, tr { 
		display: block; 
	}
}
</style>
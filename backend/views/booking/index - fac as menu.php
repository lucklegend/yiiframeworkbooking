<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use marekpetras\calendarview\CalendarView;
use yii\db\Query;
/* @var $this yii\web\View */
/* @var $searchModel common\models\AttendanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Booking';
?>
<div class="booking-index">
   <nav class="navbar">
      <ul class="nav navbar-nav">

<?php
foreach($groups as $group){ 
 
  	$groupid = $group['id'];
 	$userId = Yii::$app->request->get('uid');
	
	$query = new Query;
	$query->select(['group'])
	    ->from('fb_booking_facility')
		//->orderby(['name' => 'ASC'])
	    ->where(['group' => $groupid]);
	$command = $query->createCommand();
	$group_id = $command->queryScalar();
		//echo $group_id;
	//print_r($facilities);
 ?>
  <?php
		if($groupid == $group_id){
				 // if(count($group_id) > 0){
					  
					 $query = new Query;
					$query->select(['*'])
						->from('fb_booking_facility')
						->orderby(['name' => 'ASC'])
						->where(['group' => $groupid]);
					$command = $query->createCommand();
					$facilities = $command->queryAll();

					 // foreach($facilities as $facility){ 
				?>
                      <li class="dropdown" style="background-color:#25aae2; margin-right:10px; border-radius:5px; color:#fff;">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:#fff"><?php echo $group['name']; ?>
        <span class="caret"></span></a>

                  <?php  
				  //echo $facility['name'];
				  echo '<ul class="dropdown-menu">';
				  foreach($facilities as $facility){  
				     if($facility['group'] == $groupid){
						echo '<li><a href="index.php?r=booking/index&facid='.$facility['id'].'&uid=' . $userId . '"> '.$facility['name'].'</a></li>';
					 }
				  }
				  echo '</ul>';
				?>
                </li>
				<?php } else { ?>
				 <li style="background-color:#25aae2; margin-right:10px; border-radius:5px;"><a href="#" style="color:#fff"><?php echo $group['name']; ?></a></li>
	<?php }	}?>
            </ul>
</nav>


    <?php
	$facID = Yii::$app->request->get('facid');
	$facID = $facID ? $facID : 1;
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

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
<div class="dropdown" style="margin-bottom:20px;">
<?php
foreach($groups as $group){ 
 
 $groupid = $group['id'];
 
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
                   <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $group['name']; ?>
                  <span class="caret"></span></button>

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
                  <?php  
				  //echo $facility['name'];
				  echo '<ul class="dropdown-menu">';
				  foreach($facilities as $facility){  
				     if($facility['group'] == $groupid){
					echo '<li><a href="#"> '.$facility['name'].'</a></li>';
					 }else{
						 echo '<li><a href="#"> No Facility</a></li>';
					 }
				  }
				  echo '</ul>';
				} ?>
				<?php 
				
		}?>
</div>


    <?= yii2fullcalendar\yii2fullcalendar::widget([ 
      'options' => [
        'lang' => 'en',
        //... more options to be defined here!
      ],
      'ajaxEvents' => Url::to(['booking/jsoncalendar'])
    ]);
?>
</div>

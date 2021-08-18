<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\db\Query;

$this->title = 'Booking Management Statistics';
//$this->params['breadcrumbs'][] = ['label' => 'Fb Booking Bookeds', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fb-booking-booked-view" style="margin:30px">
<?php
 //$year = $_GET[year] ;
 $month_caption=date("M Y");	
 
// echo $month_caption;
  $m =  date('m');
    $y =  date('Y');
    $numDays = cal_days_in_month (CAL_GREGORIAN, $m,$y);

 
 $day_start = date("Y-m-01");
 $day_end = date("Y-m-" .$numDays);
 
	//print_r($pending);
?>
<center>
<h1><?php echo $month_caption; ?></h1>
</center>
<table class="table table-striped">
<tr>
<th>Facility name</th>
<?php 

foreach($status as $status1){
	foreach($status1 as $sta){
		echo "<th> ".$sta." </th>";
		}
}?>
</tr>
<?php //$rows = count($status)+1; 
//for($i=0; $i<=$rows; $i++){
	echo "<tr>";
	foreach($facilities as $facility){
	//echo $facility['name'];
	$sql= "select * from fb_booking_booked where slot_from >= '$day_start' AND slot_to <= '$day_end' and status =1 and facility_id ='".$facility['id']."' and user_id ='".Yii::$app->user->getId()."'";
	$cmd =	Yii::$app->db->createCommand($sql);
	$query = $cmd->queryAll();
	$pending = count($query);
	
	$sql1= "select * from fb_booking_booked where slot_from >= '$day_start' AND slot_to <= '$day_end' and status =2 and facility_id ='".$facility['id']."' and user_id ='".Yii::$app->user->getId()."'";
	$cmd1 =	Yii::$app->db->createCommand($sql1);
	$query1 = $cmd1->queryAll();
	$confirm = count($query1);
	
	$sql2= "select * from fb_booking_booked where slot_from >= '$day_start' AND slot_to <= '$day_end' and status =3 and facility_id ='".$facility['id']."' and user_id ='".Yii::$app->user->getId()."'";
	$cmd2 =	Yii::$app->db->createCommand($sql2);
	$query2 = $cmd2->queryAll();
	$cancel = count($query2);
	
	$sql3= "select * from fb_booking_booked where slot_from >= '$day_start' AND slot_to <= '$day_end' and status =4 and facility_id ='".$facility['id']."' and user_id ='".Yii::$app->user->getId()."'";
	$cmd3 =	Yii::$app->db->createCommand($sql3);
	$query3 = $cmd3->queryAll();
	$lapsed = count($query3);
	
  echo "<td> ".$facility['name']." </td>";
  ?>
  <td>
  <?php
  if($pending==0){
	  echo "0";
  }else{
	  //echo $pending;
	  echo Html::a($pending, ['pending'], ['data-pjax' => 0]);
  }
  ?>
  </td>
   <td>
  <?php
  if($confirm==0){
	  echo "0";
  }else{
	  //echo $confirm;
	  echo Html::a($confirm, ['confirm'], ['data-pjax' => 0]);
  }
  ?>
  </td>
   <td>
  <?php
  if($cancel==0){
	  echo "0";
  }else{
	 // echo $cancel;
	  echo Html::a($cancel, ['cancel'], ['data-pjax' => 0]);
  }
  ?>
  </td>
   <td>
  <?php
  if($lapsed==0){
	  echo "0";
  }else{
	 //echo $lapsed;
	  echo Html::a($lapsed, ['lapsed'], ['data-pjax' => 0]);
  }
  ?>
  </td>
  </tr>
<?php  }
//}
?>
</table>
</div>
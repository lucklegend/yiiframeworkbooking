<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\db\Query;
use \fruppel\googlecharts\GoogleCharts;

$this->title = 'Booking Management Statistics';
//$this->params['breadcrumbs'][] = ['label' => 'Fb Booking Bookeds', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="fb-booking-booked-view" style="margin:30px">
<?php
 //$year = $_GET[year] ;
 $month_caption=date("F Y");	
// echo $month_caption;
  $m =  date('m');
    $y =  date('Y');
    $numDays = cal_days_in_month (CAL_GREGORIAN, $m,$y);
 $day_start = date("Y-m-01");
 $day_end = date("Y-m-" .$numDays);
	//print_r($pending);
	$sql= "select * from fb_booking_booked where status =1";
	$cmd =	Yii::$app->db->createCommand($sql);
	$query = $cmd->queryAll();
	$pending = count($query);

	$sql1= "select * from fb_booking_booked where status =2";
	$cmd1 =	Yii::$app->db->createCommand($sql1);
	$query1 = $cmd1->queryAll();
	$confirm = count($query1);

	$sql2= "select * from fb_booking_booked where status =3";
	$cmd2 =	Yii::$app->db->createCommand($sql2);
	$query2 = $cmd2->queryAll();
	$cancel = count($query2);
	
	$sql3= "select * from fb_booking_booked where status =4";
	$cmd3 =	Yii::$app->db->createCommand($sql3);
	$query3 = $cmd3->queryAll();
	$lapsed = count($query3);
?>

<div class="row">
   <div class="col-sm-6">
                                         <?= GoogleCharts::widget([
											'id' => 'donutchart1',
											'visualization' => 'PieChart',
											'data' => [
												'cols' => [
													[
														'id' => 'topping',
														'label' => 'Topping',
														'type' => 'string'
													],

													[
														'id' => 'slices',
														'label' => 'Slices',
														'type' => 'number'
													]
												],

												'rows' => [

													[
														'c' => [
															['v' => 'Lapsed'],
															['v' => $lapsed]
														],
													],

													[
														'c' => [
															['v' => 'Cancelled'],
															['v' => $cancel]
														]
													],

													[
														'c' => [
															['v' => 'Pending'],
															['v' => $pending]
														]
													],

													[
														'c' => [
															['v' => 'Confirm'],
															['v' => $confirm]
														]
													],
												]
											],

											'options' => [
												'title' => 'Booking Status',
												'width' => 400,
				 								'height' => 350,
												//'is3D' => true,
												'pieHole' => 0.5,
												'colors' => ['#f47119', '#8d8d8d', '#eaa60f', '#7ec141', '#647e9b'],
											],
											'responsive' => true,
										]) ?>
   </div>
   
    <div class="col-sm-6">
  <?php  foreach($facilities as $facility){
	$sql1= "select * from fb_booking_booked where slot_from >= '$day_start' AND slot_to <= '$day_end' and status =2 and facility_id ='".$facility['id']."'";
	$cmd1 =	Yii::$app->db->createCommand($sql1);
	$query1 = $cmd1->queryAll();
	$confirm = count($query1);
	$name[] = $facility['name'];
 }

// echo $name1 = $facility['name']; exit;
//$fac = explode(',', $name);
	  ?>
                                         <div id="_byCase" style="height:350px"></div>
<?php // } ?>
   </div>
</div>

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
	$sql= "select * from fb_booking_booked where slot_from >= '$day_start' AND slot_to <= '$day_end' and status =1 and facility_id ='".$facility['id']."'";
	$cmd =	Yii::$app->db->createCommand($sql);
	$query = $cmd->queryAll();
	$pending = count($query);
	
	$sql1= "select * from fb_booking_booked where slot_from >= '$day_start' AND slot_to <= '$day_end' and status =2 and facility_id ='".$facility['id']."'";
	$cmd1 =	Yii::$app->db->createCommand($sql1);
	$query1 = $cmd1->queryAll();
	$confirm = count($query1);
	
	$sql2= "select * from fb_booking_booked where slot_from >= '$day_start' AND slot_to <= '$day_end' and status =3 and facility_id ='".$facility['id']."'";
	$cmd2 =	Yii::$app->db->createCommand($sql2);
	$query2 = $cmd2->queryAll();
	$cancel = count($query2);

	$sql3= "select * from fb_booking_booked where slot_from >= '$day_start' AND slot_to <= '$day_end' and status =4 and facility_id ='".$facility['id']."'";
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
	  echo Html::a($pending, ['pending', 'facility_id' => $facility['id']], ['data-pjax' => 0]);
  }
  ?>
 </td>

   <td>
  <?php
  if($confirm==0){
	  echo "0";
  }else{
	  //echo $confirm;
	  echo Html::a($confirm, ['confirm', 'facility_id' => $facility['id']], ['data-pjax' => 0]);
  }
  ?>
  </td>

   <td>
  <?php
  if($cancel==0){
	  echo "0";
  }else{
	 // echo $cancel;
	  echo Html::a($cancel, ['cancel', 'facility_id' => $facility['id']], ['data-pjax' => 0]);
  }
  ?>
  </td>

   <td>
  <?php
  if($lapsed==0){
	  echo "0";
  }else{
	 //echo $lapsed;
	  echo Html::a($lapsed, ['lapsed', 'facility_id' => $facility['id']], ['data-pjax' => 0]);
  }
  ?>
  </td>
  </tr>
<?php  }

//}
?>
</table>
</div>


<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {
	var data = google.visualization.arrayToDataTable([
	  ['Title', 'Count'],
	<?php  foreach($facilities as $facility){
	$sql1= "select * from fb_booking_booked where slot_from >= '$day_start' AND slot_to <= '$day_end' and status =2 and facility_id ='".$facility['id']."'";
	$cmd1 =	Yii::$app->db->createCommand($sql1);
	$query1 = $cmd1->queryAll(); ?>
	  ['<?= $facility['name'] ?>', <?= count($query1) ?>],
	<?php } ?>
	]);
   var view = new google.visualization.DataView(data);
   view.setColumns([0, 1]);

   var options = {title:"Booking Approved",
   pieHole: 0.5,
	   // width:600, height:400,
   colors: ['#f47119', '#eaa60f', '#7ec141', '#8d8d8d', '#647e9b', '#1ca8dd', '#e64759', '#9f86ff', '#e4d836'],
   };
   var chart = new google.visualization.PieChart( 
	   document.getElementById('_byCase'));
   chart.draw(view, options);

   var selectHandler = function(e) {
	  window.location = data.getValue(chart.getSelection()[0]['row'], 1 );
   }

   google.visualization.events.addListener(chart, 'select', selectHandler);
  }
</script>
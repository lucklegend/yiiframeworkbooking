<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Profiles;
use common\models\Locations;

?>
<div align="left" style="width:40%"> </div>
 
	
<div id="w3" class="grid-view" data-krajee-grid="kvGridInit_9fa4b3bc">
     <table class="kv-grid-table table table-bordered table-striped kv-table-wrap">
       <thead>

		<tr>
        <th style="width: 1%;">#</th>
        <th data-col-seq="1" style="width: 20%;">Facility </th>
        <th data-col-seq="2" style="width: 15%;">Date </th>
        <th data-col-seq="3" style="width: 15%;">From Time</th>
        <th data-col-seq="4" style="width: 15%;">To Time</th>
        <th data-col-seq="5" style="width: 15%;">Resident</th> 
        <th data-col-seq="6" style="width: 19%;"> Status </th> 
        </tr>

       </thead>
<tbody>
<?php 
$id = 0;
foreach($dataProvider->models as $booked){  
$id++;
?>
<tr id="186"  style="cursor:pointer;" data-key="186">
<td width="10%">
	<?php echo $id; ?>
</td>

<td data-col-seq="1">
<?php 
	$sql= "select name from fb_booking_facility where id =".$booked->facility_id;
	$cmd =	Yii::$app->db->createCommand($sql);
	$name = $cmd->queryScalar();
	echo $name; ?>

</td>
<td data-col-seq="2">
 
<?php 

echo date('Y-m-d', strtotime($booked->slot_from));
 
	?>


</td>
<td data-col-seq="3">
<?php 
 
echo date('h:ia', strtotime($booked->slot_from));
 
	?>
</td>
<td data-col-seq="4">
	<?php 
	

	echo date('h:ia', strtotime($booked->slot_to));
	?>
     
<td data-col-seq="5">

<?php 
	$sql= "select username from users where id = ".$booked->user_id;
	$cmd =	Yii::$app->db->createCommand($sql);
	$username = $cmd->queryAll();
	if( $username[0]['username'] != '' ) {
		echo $username[0]['username'];
	} else {
		echo '-';
	} 
 	?>

 </td>
 


<td data-col-seq="6">
<?php 
	$sql= "select title from `fb_booking_status` where id = ".$booked->status;
	$cmd =	Yii::$app->db->createCommand($sql);
	$stat = $cmd->queryScalar();
	echo $stat; 
 	?>
</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>

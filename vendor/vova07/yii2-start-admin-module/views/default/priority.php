<?php

/**
 * Backend main page view.
 *
 * @var yii\base\View $this View
 */

use vova07\admin\Module;
use yii\helpers\Html;
use yii\db\Query;
use \fruppel\googlecharts\GoogleCharts;


$this->title = Module::t('admin', 'INDEX_TITLE');
$this->params['subtitle'] = Module::t('admin', 'INDEX_SUBTITLE'); ?>
<nav class="navbar navbar-default" style="background-color:#f8f8f8">
			<?= $this->render('/default/dashboard-menu') ?>
</nav>

<div class="row">
<div class="col-sm-6">
                						<?php        		
					$sql= "select * from defect_description where priority =1";
					$cmd =	Yii::$app->db->createCommand($sql);
					$query = $cmd->queryAll();
					$pri1 = count($query);
					
					$sql= "select * from defect_description where priority =2";
					$cmd =	Yii::$app->db->createCommand($sql);
					$query = $cmd->queryAll();
					$pri2 = count($query);
					

                ?>
                                      <?= GoogleCharts::widget([
											'id' => 'donutchart',
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
															['v' => 'Major'],
															['v' => $pri1]
														],
													],
													[
														'c' => [
															['v' => 'Minor'],
															['v' => $pri2]
														]
													],
												]
											],
											'options' => [
												'title' => 'Defects by Priority',
												'width' => 400,
												'height' => 300,
												//'is3D' => true,
												'colors' => ['#ef3e36', '#25aae2', '#fcb040', '#2768af', '#7ec142'],
												'pieHole' => 0.4

											],
											'responsive' => true,
										]) ?>
 </div>
     <div class="col-sm-6">
     <img src="../statics/web/apart.jpeg" />
     </div>
 </div>
<div class="row" style="margin-top:10px;">
<?php
   					$sql= "select * from users_block";
					$cmd =	Yii::$app->db->createCommand($sql);
					$blocks = $cmd->queryAll();
					
				//	print_r($blocks);
?>
 <table class="table table-striped">
    <thead>
      <tr class="well well-sm">
        <th width="20%">Block</th>
        <th width="20%">Total Units</th>
        <th width="20%">Major Priority Defects</th>
        <th width="20%">Minor Priority Defects</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($blocks as $block){ ?>
      <tr>
        <?php 
		$sql= "select * from users_unit where unit_block=".$block['id']."";
		$cmd =	Yii::$app->db->createCommand($sql);
		$units = $cmd->queryAll();
		foreach($units as $unit){
		$sql= "select id from users where user_unit=".$unit['id']."";
		$cmd =	Yii::$app->db->createCommand($sql);
		$users = $cmd->queryScalar();
		//foreach($users as $user){
		$sql= "select * from defect_description where submited_by='".$users."' and priority=1";
		$cmd =	Yii::$app->db->createCommand($sql);
		$major = $cmd->queryAll();
		
		$sql= "select * from defect_description where submited_by='".$users."' and priority=2";
		$cmd =	Yii::$app->db->createCommand($sql);
		$minor = $cmd->queryAll();

		$majordefect[] = count($major);
		$minordefect[] = count($minor);
		// echo "<td>".$majordefect."</td>";
		  //echo "<td>".$minordefect."</td>";
		 // $major1[] = implode('+', $majordefect);
		//  $minor1[] = implode('+', $minordefect);
		//}
			}
		?>
      <td><?php echo $block['name']; ?></td>
      <td><?php echo count($units); ?></td>
      <td><?php echo array_sum($majordefect); ?></td>
      <td><?php echo array_sum($minordefect); ?></td>

      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
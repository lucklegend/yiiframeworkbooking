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
										    $m =  date('m');
											$y =  date('Y');
											$numDays = cal_days_in_month (CAL_GREGORIAN, $m,$y);
										
										 
										 $day_start = date("Y-m-01");
										 $day_end1 = date("Y-m-14");
										 $day_end2 = date("Y-m-30");
												
					$sql= "select * from defect_description where status=1";
					$cmd =	Yii::$app->db->createCommand($sql);
					$query = $cmd->queryAll();
					$opened = count($query);
					
					$sql= "select * from defect_description where status=0 or status=2";
					$cmd =	Yii::$app->db->createCommand($sql);
					$query = $cmd->queryAll();
					$without = count($query);
					
					$sql= "select * from defect_description";
					$cmd =	Yii::$app->db->createCommand($sql);
					$query = $cmd->queryAll();
					$all = count($query);
					
					$sql= "select * from defect_description where status=1 and submited_date between ".$day_start." and ".$day_end1." group by submited_by";
					$cmd =	Yii::$app->db->createCommand($sql);
					$query = $cmd->queryAll();
					$days14 = count($query);
					
					$sql= "select * from defect_description where status=1 and submited_date between ".$day_end1." and ".$day_end2." group by submited_by";
					$cmd =	Yii::$app->db->createCommand($sql);
					$query = $cmd->queryAll();
					$days30 = count($query);
					
					$others = $all-$days14-$days30-$without;

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
															['v' => 'With open Defects < 14 days'],
															['v' => $days14]
														],
													],
													[
														'c' => [
															['v' => 'With open Defects > 30 days'],
															['v' => $days30]
														]
													],
													[
														'c' => [
															['v' => 'Without WIP Defects'],
															['v' => $without]
														]
													],
													[
														'c' => [
															['v' => 'Others'],
															['v' => $others]
														]
													],
												]
											],
											'options' => [
												'title' => 'Unit Count by Status',
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
          <div class="well  well-sm"><b>Action</b></div>
          <div class="col-sm-4">
           <p style="border-left:5px solid #ef3e36; font-size: larger;">&nbsp; Units With open Defects < 14 days <br />&nbsp;&nbsp;<b><?php echo $days14; ?></b></p>
          </div>
          <div class="col-sm-4">
           <p style="border-left:5px solid #25aae2; font-size: larger;">&nbsp; Unit With open Defects > 30 days <br />&nbsp;&nbsp;<b><?php echo $days30; ?></b></p>
          </div>
          <div class="col-sm-4">
           <p style="border-left:5px solid #fcb040; font-size: larger;">&nbsp; Units With open Defects <br />&nbsp;&nbsp;<b><?php echo $opened; ?></b></p>
          </div>
</div>
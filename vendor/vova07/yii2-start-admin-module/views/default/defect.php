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
					$sql= "select * from defect_description where status =1";
					$cmd =	Yii::$app->db->createCommand($sql);
					$query = $cmd->queryAll();
					$opened = count($query);
					
					$sql1= "select * from defect_description where status =0";
					$cmd1 =	Yii::$app->db->createCommand($sql1);
					$query1 = $cmd1->queryAll();
					$draft = count($query1);
					
					$sql2= "select * from defect_description where status =2";
					$cmd2 =	Yii::$app->db->createCommand($sql2);
					$query2 = $cmd2->queryAll();
					$closed = count($query2);

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
															['v' => 'WP'],
															['v' => $draft]
														],
													],
													[
														'c' => [
															['v' => 'Opened'],
															['v' => $opened]
														]
													],
													[
														'c' => [
															['v' => 'Closed'],
															['v' => $closed]
														]
													],
												]
											],
											'options' => [
												'title' => 'Defects by Status',
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
           <p style="border-left:5px solid #ef3e36; font-size: larger;">&nbsp; Waiting Defects <br />&nbsp;&nbsp;<b><?php echo $draft; ?></b></p>
          </div>
          <div class="col-sm-4">
           <p style="border-left:5px solid #25aae2; font-size: larger;">&nbsp; Work in progress Defects <br />&nbsp;&nbsp;<b><?php echo $opened; ?></b></p>
          </div>
          <div class="col-sm-4">
           <p style="border-left:5px solid #fcb040; font-size: larger;">&nbsp; Completed Defects <br />&nbsp;&nbsp;<b><?php echo $closed; ?></b></p>
          </div>
</div>
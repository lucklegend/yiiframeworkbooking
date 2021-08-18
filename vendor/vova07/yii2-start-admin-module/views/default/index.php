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
					$sql= "select * from defect where status =1";
					$cmd =	Yii::$app->db->createCommand($sql);
					$query = $cmd->queryAll();
					$opened = count($query);
					
					$sql= "select * from defect where status =0";
					$cmd =	Yii::$app->db->createCommand($sql);
					$query = $cmd->queryAll();
					$draft = count($query);
					
					$sql= "select * from defect where status =2";
					$cmd =	Yii::$app->db->createCommand($sql);
					$query = $cmd->queryAll();
					$closed = count($query);

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
												'title' => 'Cases by Status',
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
                                   
<div class="row">
                <div class="col-sm-6">
					<?php                    		
                            $query = new Query;
                        $query->select(['defect_type.name As Type, COUNT(defect_description.type) AS DefectType'])
                            ->from('defect_description')
							->leftJoin('defect_type', 'defect_description.type=defect_type.id')
                            ->groupby(['name'])
							->orderby(['type' => SORT_DESC])
							->limit(10);
                        $command = $query->createCommand();
                        $types = $command->queryAll();
						foreach($types as $type) {
								$defect_type[] = implode('</div><div class="col-sm-4">', $type);
							}
							?>
                              <h3 style="background-color:#ffffff; padding:10px; border:1px solid #e0e0e1; margin-top:20px;">Defect on Items</h3>
                           <div class="row">
								<div class="col-sm-8" style="padding:10px;"><?php echo implode("</div></div><div class='row'><div class='col-sm-8' style='padding:10px;'>",$defect_type); ?>
                  </div>
                  </div>
                  </div>
                  <div class="col-sm-6">
					<?php                    		
                            $query = new Query;
                        $query->select(['defect_type_desc.name As Type, COUNT(defect_description.type_desc) AS DefectTypeDesc'])
                            ->from('defect_description')
							->leftJoin('defect_type_desc', 'defect_description.type_desc=defect_type_desc.id')
                            ->groupby(['name'])
							->orderby(['type_desc' => SORT_ASC])
							->limit(10);
                        $command = $query->createCommand();
                        $typedesc = $command->queryAll();
						foreach($typedesc as $desc) {
								$defect_desc[] = implode('</div><div class="col-sm-4">', $desc);
							}
							?>
                            	<h3 style="background-color:#ffffff; padding:10px; border:1px solid #e0e0e1; margin-top:20px;">Defect Type </h3>
                            <div class="row">
								<div class="col-sm-8" style="padding:10px;"><?php echo implode("</div></div><div class='row'><div class='col-sm-8' style='padding:10px;'>",$defect_desc); ?>
                    
</div>
</div>
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
<?php
   					$sql= "select * from users_block";
					$cmd =	Yii::$app->db->createCommand($sql);
					$blocks = $cmd->queryAll();
					
				//	print_r($blocks);
?>
    <?php foreach($blocks as $block){ ?>
        <?php 
		$sql= "select * from users_unit where unit_block=".$block['id']."";
		$cmd =	Yii::$app->db->createCommand($sql);
		$units1 = $cmd->queryAll();
		
		foreach($units1 as $unit1){
		$sql= "select id from users where user_unit=".$unit1['id']."";
		$cmd =	Yii::$app->db->createCommand($sql);
		$users1 = $cmd->queryScalar();
		//foreach($users as $user){

		$sql1= "select * from defect where user_id='".$users1."'  limit 1";
		$cmd1 =	Yii::$app->db->createCommand($sql1);
		$unit_hand1 = $cmd1->queryAll();
							//print_r ($unit_hand1); exit;
			
		$sql1= "select * from defect where user_id='".$users1."' and status = 1 limit 1";
		$cmd1 =	Yii::$app->db->createCommand($sql1);
		$unit_handopen1 = $cmd1->queryAll();
		
		$sql1= "select * from defect where user_id='".$users1."'";
		$cmd1 =	Yii::$app->db->createCommand($sql1);
		$total1 = $cmd1->queryAll();
		
		$sql1= "select * from defect where user_id='".$users1."' and status = 1";
		$cmd1 =	Yii::$app->db->createCommand($sql1);
		$open1 = $cmd1->queryAll();
		
		$sql1= "select * from defect where user_id='".$users1."' and status = 2";
		$cmd1 =	Yii::$app->db->createCommand($sql1);
		$closed1 = $cmd1->queryAll();
		
		$unit_handedover1[] = count($unit_hand1);
		$unit_handedopened1[] = count($unit_handopen1);
		$total_case1[] = count($total1);
		$total_open1[] = count($open1);
		$total_closed1[] = count($closed1);
			}
	  $total_unit_handover1[] = array_sum($unit_handedover1); 
	  $total_units1[] = count($units1); 
	  $total_closed_case[] = array_sum($total_closed1);
	  $total_cases1[] = array_sum($total_case1);
	  } ?>

<div class="row">
<div class="col-sm-6" style="margin:5% auto">
                						<?php        		
					//echo array_sum($total_unit_handover1);
	  				//echo array_sum($total_units1) ;
					
					/*echo array_sum($total_closed_case);
	  				echo array_sum($total_case) ;
					*/
					$foo2 = array_sum($total_unit_handover1)/array_sum($total_units1) * 100;
					//$per_unit_handover = number_format((float)$foo2, 2, '.', '');
					 $foo1 = array_sum($total_closed_case)/array_sum($total_cases1) * 100;
					  $per_case_signed = number_format((float)$foo1, 2, '.', '');
                ?>
            <div class="col-sm-6">
           <p style="border-left:5px solid #ef3e36; font-size: larger;">&nbsp; % Units Handed Over <br />&nbsp;&nbsp;<b><?php echo $foo2. '%'; ?></b></p>
          </div>
          <div class="col-sm-6">
           <p style="border-left:5px solid #25aae2; font-size: larger;">&nbsp; % Cases Signed Off <br />&nbsp;&nbsp;<b><?php echo $per_case_signed.'%'; ?></b></p>
          </div>

 </div>
     <div class="col-sm-6">
      <img src="../statics/web/apart.jpeg" />
     </div>
 </div>
<div class="row" style="margin-top:10px;">
 <table class="table table-striped">
    <thead>
      <tr class="well well-sm">
        <th>Block</th>
        <th>Total Units</th>
        <th>Unit Handed Over</th>
        <th>Unit with Open Cases</th>
        <th>Total Cases</th>
        <th>Open Cases</th>
        <th>Closed Cases</th>
        <th>% Cases Signed off</th>
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
			
		$sql1= "select * from defect where user_id='".$users."' limit 1";
		$cmd1 =	Yii::$app->db->createCommand($sql1);
		$unit_hand = $cmd1->queryAll();
		
			
		$sql1= "select * from defect where user_id='".$users."' and status = 1 limit 1";
		$cmd1 =	Yii::$app->db->createCommand($sql1);
		$unit_handopen = $cmd1->queryAll();
		
		$sql1= "select * from defect where user_id='".$users."'";
		$cmd1 =	Yii::$app->db->createCommand($sql1);
		$total = $cmd1->queryAll();
		
		$sql1= "select * from defect where user_id='".$users."'and status = 1";
		$cmd1 =	Yii::$app->db->createCommand($sql1);
		$open = $cmd1->queryAll();
		
		$sql1= "select * from defect where user_id='".$users."' and status = 2";
		$cmd1 =	Yii::$app->db->createCommand($sql1);
		$closed = $cmd1->queryAll();
		
		$unit_handedover[] = count($unit_hand);
		$unit_handedopened[] = count($unit_handopen);
		$total_case[] = count($total);
		$total_open[] = count($open);
		$total_closed[] = count($closed);
			}
		?>
      <td><?php echo $block['name']; ?></td>
      <td><?php echo count($units); ?></td>
      <td><?php echo array_sum($unit_handedover); ?></td>
      <td><?php echo array_sum($unit_handedopened); ?></td>
      <td><?php echo array_sum($total_case); ?></td>
	  <td><?php echo array_sum($total_open); ?></td>
      <td><?php echo array_sum($total_closed); ?></td>
      <td><?php 
	  $foo = array_sum($total_closed)/ array_sum($total_case) * 100;
	  echo number_format((float)$foo, 2, '.', '').'%'; ?></td>
      </tr>
      
      <?php 
	  $total_unit_handover[] = array_sum($unit_handedover); 
	  $total_units[] = count($units); 
	  } ?>
    </tbody>
  </table>
</div>
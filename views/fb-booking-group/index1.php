<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use vova07\themes\admin\widgets\Box;
use yii\grid\CheckboxColumn;
use yii\helpers\ArrayHelper;
use common\models\FbBookingGroup;
use yii\db\Query;
/* @var $this yii\web\View */
/* @var $searchModel app\models\FbBookingGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Facilities';
//$this->params['subtitle'] = 'Facilities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row facility_list">
<?= $this->render('//layouts/sidebar') ?>
<div class="col-sm-9">
    
    <?php 
                //echo Html::activeDropDownList($searchModel, 'name', ArrayHelper::map(FbBookingGroup::find()->asArray()->all(), 'id', 'name'),['class'=>'form-control','prompt' => 'Select Group']);
                 $query = new Query;
                        $query->select(['*'])
                            ->from('fb_booking_group')
                            ->orderby(['name' => 'ASC']);
                            //->where(['group' => $groupid]);
                        $command = $query->createCommand();
                        $groups = $command->queryAll();
    
        ?>
		 <div class="page-title">
                    <h1>Facilities</h1>
                    <span class="line-h"></span>
                  </div> 
        
    <div class="navbar-collapse in" style="margin-bottom:20px;">
          <ul class="nav navbar-nav">
                          <li class="dropdown" style="background-color:#01456c; margin-right:10px; border-radius:5px; color:#fff;">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:#fff">Select a facility
            <span class="caret"></span></a>
    
                      <?php  
                      echo '<ul class="dropdown-menu">';
                      foreach($groups as $group){  
                        echo '<li><a href="index.php?r=fb-booking-group/facility&id='.$group['id'].'"> '.$group['name'].'</a></li>';
                      }
                      echo '</ul>';
                    ?>
                    </li>
                </ul>
    </div>
        <img class="img-responsive" src="backend/web/uploads/contacts/fac000.jpg" width="700" />
</p>
</div>
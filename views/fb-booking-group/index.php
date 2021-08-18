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
                          <li class="dropdown dropdown1">
            <a class="dropdown-toggle dropdown2" data-toggle="dropdown" href="#" style="color: white;">Select a facility
            <span class="caret"></span></a>
    
                      <?php  
                      echo '<ul class="dropdown-menu">';
                      foreach($groups as $group){  
                        echo '<li><a href="index.php?r=fb-booking-group/facility&id='.$group['id'].'"  style="color:#fff"> '.$group['name'].'</a></li>';
                      }
                      echo '</ul>';
                    ?>
                    </li>
                </ul>
    </div>
        <!--<img class="img-responsive" src="backend/web/uploads/contacts/fac000.jpg" width="700" />-->
        <img class="img-responsive" src="statics/web/groups/5f4e3ee9de8bc.jpeg" width="700" />
</p> 
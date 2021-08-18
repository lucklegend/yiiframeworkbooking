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

$this->title = 'Facilities >>' .$model->name;
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
    <?//= $this->render('//layouts/sidebar') ?>
 
        <h1 style="color:#ac7339;">Facilities</h1>
            <div class="navbar-collapse in" style="margin-bottom:20px;">
                <ul class="nav navbar-nav">
                    <li class="dropdown dropdown3">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="border-radius: 10px;color:#fff"><?php echo $model->name; ?>
                            <span class="caret"></span>
                        </a>
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
			<?php echo $model->description; ?> 
         
            <?php 
                if($model->image !=''){
                    echo "<img class='img-responsive' src='statics/web/groups/".$model->image."' width=700 style='border:1px solid #000'>";
                } else{
                    echo "<img class='img-responsive' src='backend/web/uploads/groups/noimg.jpg' width=700 style='border:1px solid #000'>";
                }
            ?> 
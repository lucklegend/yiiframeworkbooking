<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\FbBookingGroup;
use common\models\FbBookingFacility;

/* @var $this yii\web\View */
/* @var $model common\models\FbBookingSlot */

$this->title = date('h:ia', strtotime($model->time_from)) .'-' .date('h:ia', strtotime($model->time_to));
$this->params['breadcrumbs'][] = ['label' => 'Fb Booking Slots', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fb-booking-slot-view">


    <p>
   
        <?= Html::a('Back', ['/fb-booking-group/view', 'id' => $model->group], ['class' => 'btn btn-info']); ?>
         
        <?= Html::a('Update', ['update1', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
        <?= Html::a('Delete', ['delete1', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'GET',
            ],
        ]) ?>
    </p>

    <?= \gamitg\detailview4cols\DetailView4Col::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'facility',
			/*[
            'attribute' => 'facility',
			'value' => $model->facility1->name,
			],*/
            'time_from',
            'time_to',
           // 'monday',
			[
		    'attribute'=>'monday',
			'format'=>'raw',
			'value' => $model->monday == 0 ? Html::checkBox("monday",$model->monday,array("id"=>"chkPublish_".$model->id,'disabled' => true)) : Html::checkBox("monday",$model->monday,array("id"=>"chkPublish_".$model->id,'disabled' => true))
			],
            //'tuesday',
			[
		    'attribute'=>'tuesday',
			'format'=>'raw',
			'value' => $model->tuesday == 0 ? Html::checkBox("tuesday",$model->tuesday,array("id"=>"chkPublish_".$model->id,'disabled' => true)) : Html::checkBox("tuesday",$model->tuesday,array("id"=>"chkPublish_".$model->id,'disabled' => true))
			],
            //'wednesday',
			[
		    'attribute'=>'wednesday',
			'format'=>'raw',
			'value' => $model->wednesday == 0 ? Html::checkBox("wednesday",$model->wednesday,array("id"=>"chkPublish_".$model->id,'disabled' => true)) : Html::checkBox("wednesday",$model->wednesday,array("id"=>"chkPublish_".$model->id,'disabled' => true))
			],
            //'thursday',
			[
		    'attribute'=>'thursday',
			'format'=>'raw',
			'value' => $model->thursday == 0 ? Html::checkBox("thursday",$model->thursday,array("id"=>"chkPublish_".$model->id,'disabled' => true)) : Html::checkBox("thursday",$model->thursday,array("id"=>"chkPublish_".$model->id,'disabled' => true))
			],
            //'friday',
			[
		    'attribute'=>'friday',
			'format'=>'raw',
			'value' => $model->friday == 0 ? Html::checkBox("friday",$model->friday,array("id"=>"chkPublish_".$model->id,'disabled' => true)) : Html::checkBox("friday",$model->friday,array("id"=>"chkPublish_".$model->id,'disabled' => true))
			],
            //'saturday',
			[
		    'attribute'=>'saturday',
			'format'=>'raw',
			'value' => $model->saturday == 0 ? Html::checkBox("saturday",$model->saturday,array("id"=>"chkPublish_".$model->id,'disabled' => true)) : Html::checkBox("saturday",$model->saturday,array("id"=>"chkPublish_".$model->id,'disabled' => true))
			],
           // 'sunday',
			[
		    'attribute'=>'sunday',
			'format'=>'raw',
			'value' => $model->sunday == 0 ? Html::checkBox("monday",$model->sunday,array("id"=>"chkPublish_".$model->id,'disabled' => true)) : Html::checkBox("sunday",$model->sunday,array("id"=>"chkPublish_".$model->id,'disabled' => true))
			],
            //'peak',
			 //'price',
			 [	
                'attribute'=>'price',		
                'value' =>   $model->price == '' ? 'NA' :  'SGD '.Yii::$app->formatter->asDecimal($model->price), 
            ],
			[
		    'attribute'=>'peak',
			'value' => $model->peak1,
			],
        ],
    ]) ?>

</div>

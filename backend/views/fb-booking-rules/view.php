<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\FbBookingGroup;
use common\models\FbBookingFacility;

/* @var $this yii\web\View */
/* @var $model common\models\FbBookingRules */

$this->title = 'Rules' .$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fb Booking Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fb-booking-rules-view">

    <p>
    <?php 
	$modelGroup = new FbBookingFacility();
	//print_r($modelGroup->id); 
	if($model->facility == $modelGroup->id  ){  ?>
        <?= Html::a('Back', ['fb-booking-group/view', 'id' => $model->group], ['class' => 'btn btn-info']) ?>
    <?php }else { ?>
         <?= Html::a('Back', ['fb-booking-facility/view', 'id' => $model->facility], ['class' => 'btn btn-info']) ?>
    <?php }?>
    <?php if($model->group == NULL){  ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?php }else { ?>
        <?= Html::a('Update', ['update1', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
      <?php }?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'get',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'facility',
            //'group'
			/*[
            'attribute' => 'facility',
			'value' => $model->facility1->name,
			],
			[
            'attribute' => 'group',
			'value' => $model->group1->name,
			],*/
           // 'peak',
			[
            'attribute' => 'peak',
		   'value'=>$model->peak1,
        ],
           // 'range_type',
			[
            'attribute' => 'range_type',
			'value'=>$model->rangetype1,
        ],
            'range_limit',
            'rules_order',
            'condition',
        ],
    ]) ?>

</div>

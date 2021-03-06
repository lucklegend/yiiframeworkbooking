<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UnitLocation */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Unit Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-location-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
           //'unit_type',
		   [
            'attribute' => 'unit_type',
			'value' => $model->type->name,
			],

           /* [
		    'attribute'=>'published',
			'value' => $model->published == 0 ? 'InActive' : 'Active'
			],*/
        ],
    ]) ?>

</div>

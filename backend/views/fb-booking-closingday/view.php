<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use vova07\themes\admin\widgets\Box;
use yii\grid\CheckboxColumn;


/* @var $this yii\web\View */
/* @var $model common\models\FbBookingClosingday */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Fb Booking Closingdays', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fb-booking-closingday-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'POST',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
            'attribute' => 'facility',
			'value' => $model->facility0->name,
			],
            'title',
            //'notes:ntext',
            [
		    'attribute'=>'date_from',
			'format' => ['date', 'php:d M Y']
			],
            //'amc_end',
			[
		    'attribute'=>'date_to',
			'format' => ['date', 'php:d M Y']
			],
            [
		    'attribute'=>'time_from',
			'format' => ['date', 'php:h:ia']
			],
            //'end_time',
			[
		    'attribute'=>'time_to',
			'format' => ['date', 'php:h:ia']
			],
			[
			'attribute' => 'notes',
			'format' => 'raw',
			]
           // 'published',
			/*[
		    'attribute'=>'published',
			'value' => $model->published == 0 ? 'InActive' : 'Active'
			],*/
           // 'p
        ],
    ]) ?>

</div>
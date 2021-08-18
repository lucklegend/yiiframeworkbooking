<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Asset */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Assets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
		<?= Html::a('Back', ['/asset/index' ], ['class'=>'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            'model',
           // 'category',
			[
            'attribute' => 'category',
			'value' => $model->category1->name,
			],
            'brand',
            'code',
            'purchase_from',
            //'purchase_date',
			[
		    'attribute'=>'purchase_date',
			'format' => ['date', 'php:d M Y']
			],
            //'warranty_end_date',
			[
		    'attribute'=>'warranty_end_date',
			'format' => ['date', 'php:d M Y']
			],
           // 'amc_by',
			[
		    'attribute'=>'amc_by',
			'value' => $model->contacts->fname,
			],
            //'amc_start',
			[
		    'attribute'=>'amc_start',
			'format' => ['date', 'php:d M Y']
			],
            //'amc_end',
			[
		    'attribute'=>'amc_end',
			'format' => ['date', 'php:d M Y']
			],
            //'notes:ntext',
			[
			'attribute' => 'notes',
			'format' => 'raw',
			],
            //'user_unit',
			[
		    'attribute'=>'user_unit',
			'value' => $model->unit->unit_name,
			],
           // 'user_id',
			[
		    'attribute'=>'user_id',
			'value' => $model->profiles->name,
			],
           /*[
		    'attribute'=>'status',
			'value' => $model->status == 0 ? 'InActive' : 'Active'
			],*/
        ],
    ]) ?>

</div>

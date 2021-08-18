<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pages */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
		<?= Html::a('Back', ['/pages/index' , 'PagesSearch[category]' => $model->category ,'data' =>  $model->category ], ['class'=>'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'title',
           // 'category',
			[
		    'attribute'=>'category',
			'value' => $model->category0->category
			],
            [
				'attribute'=>'image',
				'value' => $model->image != '' ? ('<img src ="../statics/web/pages/'. $model->image . '" height="100" width="100">'): '-',
				'format'=>'raw'
			],
            'attachment',
           // 'type',
			[
		    'attribute'=>'type',
			'value' => $model->type0->type
			],
            //'created_by',
			[
		    'attribute'=>'created_by',
			'value' => $model->userid->name
			],
            //'created_on',
			[
		    'attribute'=>'created_on',
			'format' => ['date', 'php:d M Y h:ia']
			],
            //'status',
			[
            'attribute' => 'status',
			'value' => $model->status == 0 ? 'InActive' : 'Active',
			],
			//'content:ntext',
			[
			'attribute' => 'content',
			'format' => 'raw',
			]

        ],
    ]) ?>

</div>

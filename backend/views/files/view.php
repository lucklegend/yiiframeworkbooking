<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Files */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="files-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
		<?= Html::a('Back', ['/files/index' ], ['class'=>'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'title',
            'file_name',
            //'file_type',
			[
            'attribute' => 'file_type',
			'value' => $model->file_type == NULL ? '-' : $model->type->name,
			],
            'file_icon',
           // 'category',
			[
            'attribute' => 'category',
			'value' => $model->category == NULL ? '-' : $model->category1->name,
			],
           // 'notes:ntext',
            //'uploaded_by',
			[
            'attribute' => 'uploaded_by',
			'value' => $model->uploaded_by == NULL ? '-' : $model->profiles->name,
			],
			[
			'attribute' => 'uploaded_for',
			'value' => $model->uploaded_for == NULL ? '-' : $model->uploaded_for,
			],
            //'access',
			[
            'attribute' => 'access',
			'value' => $model->access == NULL ? '-' : $model->access1->name,
			],
			[
			'attribute' => 'notes',
			'format' => 'raw',
			],

           /* [
		    'attribute'=>'published',
			'value' => $model->published == 0 ? 'InActive' : 'Active'
			],*/
        ],
    ]) ?>

</div>

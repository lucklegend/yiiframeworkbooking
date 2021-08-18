<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\FilesCategory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Files Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="files-category-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
		<?= Html::a('Back', ['/files-category/index' ], ['class'=>'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
           /* [
		    'attribute'=>'published',
			'value' => $model->published == 0 ? 'InActive' : 'Active'
			],*/
        ],
    ]) ?>

</div>

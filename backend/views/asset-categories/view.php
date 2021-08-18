<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Assetcategories */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Asset Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assetcategories-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
		<?= Html::a('Back', ['/asset-categories/index' ], ['class'=>'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            //'is_serviceable',
			[
		    'attribute'=>'is_serviceable',
			'value' => $model->is_serviceable == 0 ? 'No' : 'Yes'
			],
        ],
    ]) ?>

</div>

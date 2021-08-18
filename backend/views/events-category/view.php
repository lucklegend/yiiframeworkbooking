<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\EventsCategory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Events Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="events-category-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
		<?= Html::a('Back', ['/events-category/index' ], ['class'=>'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            //'published',
			/*[
		    'attribute'=>'published',
			'value' => $model->published == 0 ? 'InActive' : 'Active'
			],*/
        ],
    ]) ?>

</div>

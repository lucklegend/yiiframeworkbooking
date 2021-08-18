<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\EventsNotes */

$this->title = 'Notes' .$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Events Notes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="events-notes-view">

    <p>
        <?= Html::a('Back', ['events/view', 'id' => $model->event_id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= \gamitg\detailview4cols\DetailView4Col::widget([
        'model' => $model,
        'attributes' => [
            //'id',
           // 'event_id',
			[
            'attribute' => 'event_id',
			'value' => $model->event->title,
			],
			
            'agenda',
            'minutes:ntext',
            'resolution:ntext',
            //'updated_by',
			[
            'attribute' => 'updated_by',
			'value' => $model->updated_by == NULL ? '-' : $model->profiles->fname,
			],
           // 'updated_on',
			[
		    'attribute'=>'updated_on',
			'format' => ['date', 'php:d M Y h:ia']
			],
        ],
    ]) ?>

</div>

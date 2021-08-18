<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Visitors */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Visitors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visitors-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'phone',
           // 'meet_whom',
		   [
            'attribute' => 'meet_whom',
			'value' => $model->users->fname,
			],
            'meet_for',
            'relationship',
           // 'entry_time',
           // 'exit_time',
			[
		    'attribute'=>'entry_time',
			'format' => ['date', 'php:d M Y h:ia']
			],
            //'amc_end',
			[
		    'attribute'=>'exit_time',
			'format' => ['date', 'php:d M Y h:ia']
			],
            'gate_no',
            //'updated_by',
			[
            'attribute' => 'updated_by',
			'value' => $model->profiles->name,
			],
        ],
    ]) ?>

</div>

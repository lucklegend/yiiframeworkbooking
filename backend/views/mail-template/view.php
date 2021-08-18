<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MailTemplate */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = ['label' => 'Mail Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mail-template-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
		<?= Html::a('Back', ['/mail-template/index' ], ['class'=>'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            'mail_for',
            'subject',
            //'message:ntext',
			[
			'attribute' => 'message',
			'format' => 'raw',
			],
            'attachment',
            //'updated_by',
			[
            'attribute' => 'updated_by',
			'value' => $model->updatedby->name,
			],
           // 'updated_on',
			[
		    'attribute'=>'updated_on',
			'format' => ['date', 'php:d M Y h:ia']
			],
        ],
    ]) ?>

</div>

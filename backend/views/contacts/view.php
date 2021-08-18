<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Contacts */

$this->title = $model->fname;
$this->params['breadcrumbs'][] = ['label' => 'Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
		<?= Html::a('Back', ['/contacts/index' ], ['class'=>'btn btn-info']) ?>
    </p>

    <?= \gamitg\detailview4cols\DetailView4Col::widget([
        'model' => $model,
        'attributes' => [ 
		     'fname',
            'lname',
            'cname',

		   [
            'attribute' => 'type',
			'value' => $model->type1->name,
			],
            'email:email',
            'mobile',
            'fax',
            'address',
            'city',
            'zip',
            //'service_start',
            //'service_end',
			[
		    'attribute'=>'service_start',
			'format' => ['date', 'php:d M Y']
			],
            //'warranty_end_date',
			[
		    'attribute'=>'service_end',
			'format' => ['date', 'php:d M Y']
			],
            'bank_account_name',
            'bank_account_no',
            'bank_name',
            'bank_ifsc',
            //'notes:ntext',
			[
			'attribute' => 'notes',
			'format' => 'raw',
			],
			[
		    'attribute'=>'created',
			'format' => ['date', 'php:d M Y h:ia']
			],

            //'image',
			[
				'attribute'=>'image',
				'value' => $model->image != '' ? ('<img src ="../statics/web/contacts/'. $model->image . '" height="100" width="100">'): '-',
				'format'=>'raw'
			],
            //'active',
            //'status',
			/*[
		    'attribute'=>'status',
			'value' => $model->status == 0 ? 'InActive' : 'Active'
			],*/
        ],
    ]) ?>

</div>

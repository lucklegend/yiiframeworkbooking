<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use vova07\themes\admin\widgets\Box;
use yii\grid\GridView;
use yii\grid\ActionColumn;
/* @var $this yii\web\View */
/* @var $model common\models\Events */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="events-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
		<?= Html::a('Back', ['/events/index' ], ['class'=>'btn btn-info']) ?>
    </p>

    <?= \gamitg\detailview4cols\DetailView4Col::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'title',
           // 'category',
		   [
            'attribute' => 'category',
			'value' => $model->event->name,
			],
           // 'start_date',
           // 'end_date',
			[
		    'attribute'=>'start_date',
			'format' => ['date', 'php:d M Y']
			],
            //'amc_end',
			[
		    'attribute'=>'end_date',
			'format' => ['date', 'php:d M Y']
			],
            [
		    'attribute'=>'start_time',
			'format' => ['date', 'php:h:ia']
			],
            //'end_time',
			[
		    'attribute'=>'end_time',
			'format' => ['date', 'php:h:ia']
			],
			//'image:image',
            'attachment',
            'location',
           // 'album_id',
			 [
            'attribute' => 'album_id',
			'value' => $model->gallery == NULL ? '-' : $model->gallery->name,
			],
            'album_url:url',
            'event_for',
            //'image',
			[
				'attribute'=>'image',
				'value' => $model->image != '' ? ('<img src ="../statics/web/events/'. $model->image . '" height="100" width="100">'): '-',
				'format'=>'raw'
			],
					//	'description:ntext',
            [
			'attribute' => 'description',
			'format' => 'raw',
			]

            /* [
		    'attribute'=>'status',
			'value' => $model->status == 0 ? 'InActive' : 'Active'
			],*/
           // 'publish',
        ],
    ]) ?>

</div>

<?php 
$boxButtons = $actions = [];
$showActions = false;

if (Yii::$app->user->can('BCreateUsers')) {
    $boxButtons[] = '{create}';
}
if (Yii::$app->user->can('BUpdateUsers')) {
    $actions[] = '{update}';
    $showActions = $showActions || true;
}
/*if (Yii::$app->user->can('BDeleteUsers')) {
    $boxButtons[] = '{batch-delete}';
    $actions[] = '{delete}';
    $showActions = $showActions || true;
}
*/
if ($showActions === true) {
    $gridConfig['columns'][] = [
        'class' => ActionColumn::className(),
        'template' => implode(' ', $actions)
    ];
}
$boxButtons = !empty($boxButtons) ? implode(' ', $boxButtons) : null; ?>
<div class="row">
    <div class="col-xs-12">
        <?php Box::begin(
            [
                //'title' => $this->params['subtitle'],
                'bodyOptions' => [
                    'class' => 'table-responsive'
                ],
                'buttonsTemplate' => $boxButtons,
                //'grid' => $gridId
            ]
        ); ?>
     <p>
        <?= Html::a('Add Note', ['events-notes/create', 'id' => $model['id']], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
		'rowOptions'   => function ($model, $index, $widget, $grid) {
								return [
									'id' => $model['id'], 
									'onclick' => 'location.href="'
										. Yii::$app->urlManager->createUrl('events-notes/view') 
										. '&id="+(this.id);',
									'style' =>'cursor:pointer;', 
								];
						 },	
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			 /* [
            'class' => CheckboxColumn::classname()
        ],
            'id',*/
			/*[
            'attribute' => 'event_id',
			'value' => 'event.title',
			],*/

            'agenda',
            'minutes:ntext',
            'resolution:ntext',
            // 'updated_by',
            // 'updated_on',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
        <?php Box::end(); ?>
    </div>
</div>

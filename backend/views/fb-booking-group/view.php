<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\grid\GridView;
use yii\grid\ActionColumn;
use vova07\themes\admin\widgets\Box;
use yii\grid\CheckboxColumn;


/* @var $this yii\web\View */
/* @var $model common\models\FbBookingGroup */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fb-booking-group-view">

    <p>
        <?= Html::a('Back', ['index', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
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
			[
            'attribute' => 'calendars',
			'value'=>$model->calendar1,
        ],
		[
				'attribute'=>'image',
				'value' => $model->image != '' ? ('<img src ="../statics/web/groups/'.$model->image.'" height="100" width="100">'): '-',
				'format'=>'raw'
			],
			[
				'attribute'=>'album_id',
				'value' => $model->album_id != '' ? $model->gallery->name: '-',
				'format'=>'raw'
			],
			//'bookable',
			[
				'attribute'=>'bookable',
				'value' => $model->bookable == 0 ? 'No': 'Yes',
				'format'=>'raw'
			],

           // 'calendars',
           // 'published',
						[
            'attribute' => 'published',
            'format' => 'raw',
           // 'value' => function ($model) {
				'value'=>$model->published ? 
            '<span class="label label-success">Yes</span>' : 
            '<span class="label label-danger">No</span>',
        ],
		//	'description:ntext',
			[
			'attribute' => 'description',
			'format' => 'raw',
			]


        ],
    ]) ?>

</div>
<?php if($model->bookable == 1){ ?>
<div class="fb-booking-slot-index">
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
                'title' => 'Facility Booking Slot',
                'bodyOptions' => [
                    'class' => 'table-responsive'
                ],
               // 'buttonsTemplate' => $boxButtons,
                //'grid' => $gridId
            ]
        ); ?>
       <p>
        <?= Html::a('Add Slot', ['fb-booking-slot/create1', 'id' => $model['id']], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider1,
        //'filterModel' => $searchModel,
		'rowOptions'   => function ($model, $index, $widget, $grid) {
								return [
									'id' => $model['id'], 
									'onclick' => 'location.href="'
										. Yii::$app->urlManager->createUrl('fb-booking-slot/view1') 
										. '&id="+(this.id);',
									'style' =>'cursor:pointer;', 
								];
						 },	
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			/*  [
            'class' => CheckboxColumn::classname()
        ],*/
            //'id',
			/*[
            'attribute' => 'id',
			//'value' => 'type1.name',
			 'format' => 'html',
			 'value' => function ($model) {
             return Html::a($model['id'], ['fb-booking-slot/view', 'id' => $model['id']], ['data-pjax' => 0]);
            }
			],*/

			/*[
            'attribute' => 'facility',
			'value' => 'facility1.name',
			],*/
           // 'time_from',
			[
            'attribute' => 'time_from',
			 'format' => ['date', 'php:h:ia']
			],
			[
            'attribute' => 'time_to',
			 'format' => ['date', 'php:h:ia']
			],
            //'time_to',
			'price',
            // 'monday',
            // 'tuesday',
            // 'wednesday',
            // 'thursday',
            // 'friday',
            // 'saturday',
            // 'sunday',
           // 'peak',
			[
			 'attribute' => 'peak',
            'format' => 'html',
            'value' => 'peak1'
        ],


           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
        <?php Box::end(); ?>
    </div>
</div>

<div class="fb-booking-rules-index">
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
                'title' => 'Facility Booking Rules',
                'bodyOptions' => [
                    'class' => 'table-responsive'
                ],
                //'buttonsTemplate' => $boxButtons,
                //'grid' => $gridId
            ]
        ); ?>
     <p>
        <?= Html::a('Add Rules', ['fb-booking-rules/create1', 'id' => $model['id']], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
				'rowOptions'   => function ($model, $index, $widget, $grid) {
								return [
									'id' => $model['id'], 
									'onclick' => 'location.href="'
										. Yii::$app->urlManager->createUrl('fb-booking-rules/view') 
										. '&id="+(this.id);',
									'style' =>'cursor:pointer;', 
								];
						 },	

       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
/*			  [
            'class' => CheckboxColumn::classname()
        ], 
*/          // 'id',
			/*[
            'attribute' => 'facility',
			'value' => 'facility1.name',
			],*/
			/*[
            'attribute' => 'group',
			'value' => 'group1.name',
			],*/
		[
            'attribute' => 'range_type',
            'format' => 'html',
            'value' => 'rangetype1'
        ],
         		[
            'attribute' => 'peak',
            'format' => 'html',
            'value' => 'peak1'
        ],
           'range_limit',
            //'rules_order',

            // 'rules_order',
            // 'condition',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
        <?php Box::end(); ?>
    </div>
</div>

<?php } ?>

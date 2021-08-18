<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\grid\GridView;
use yii\grid\ActionColumn;
use vova07\themes\admin\widgets\Box;
use yii\grid\CheckboxColumn;


/* @var $this yii\web\View */
/* @var $model common\models\FbBookingFacility */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Fb Booking Facilities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$GIB = array(0 => 'Group', 1 => 'Individual', 2 => 'Both');
?>
<div class="fb-booking-facility-view">

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

    <?= \gamitg\detailview4cols\DetailView4Col::widget([
        'model' => $model,
        'attributes' => [
            'name',
           // 'group',
		   [
            'attribute' => 'group',
			'value' => $model->group1->name,
			],
            'bookday_start',
            'bookday_end',
            'cancel_date',
			'lapse_date',
            'unit_time',
           // 'rulestype',
             [
            'attribute' => 'rulestype',
			'value' => $GIB[$model->rulestype],
			],
           // 'group_share',
			[
            'attribute' => 'group_share',
			'value' => $model->group_share == 0 ? 'No': 'Yes',
			],
			//'slottype',
			[
            'attribute' => 'slottype',
			'value' => $GIB[$model->slottype],
            ],
            [	
                'attribute'=>'deposit',		
                'value' =>   $model->deposit == '' ? 'NA' :  'SGD '.Yii::$app->formatter->asDecimal($model->deposit), 
            ],   
 
            [
                'attribute' => 'attachment',
                'value' => $model->attachment == '' ? 'NA': $model->attachment,
            ],

           [
                    'attribute' => 'album_url',
                    'value' => $model->album_url == '' ? 'NA': $model->album_url,
            ], 
           // 'album_id',
			[
            'attribute' => 'album_id',
			'value' => $model->album_id == '' ? 'NA': $model->gallery->name,
            ], 
                
            //'published',
			[
            'attribute' => 'published',
            'format' => 'raw',
           // 'value' => function ($model) {
				'value'=>$model->published ? 
            '<span class="label label-success">Yes</span>' : 
            '<span class="label label-danger">No</span>',
        ],
		[
            'attribute' => 'default_status',
			'value' => $model->status1->title,
			],
            //			'notes:ntext',
            
            [
				'attribute'=>'image',
				'value' => $model->image != '' ? ('<img src ="../statics/web/facility/'. $model->image . '" height="100" width="100">'): 'NA',
				'format'=>'raw'
            ],
            
            
			[
			'attribute' => 'notes',
			'format' => 'raw',
			],
           // 'image',
		


        ],
    ]) ?>

</div>
<?php //if($model->slottype != 0){ ?>
 

<div class="fb-booking-barring">
    <div class="row">
        <div class="col-xs-12">
            <?php Box::begin(
                [
                    'title' => 'Barring Rules',
                    'bodyOptions' => [
                        'class' => 'table-responsive'
                    ],
                ]
            ); ?>
            <p>

            </p>

            <?= \gamitg\detailview4cols\DetailView4Col::widget([
                'model' => $model,
                'attributes' => [


                    [
                        'attribute' => 'b_facmon',
                    ],

                    [
                        'attribute' => 'b_absent',
                    ],
                    [
                        'attribute' => 'b_period',
                    ],


                ],
            ]) ?>
            <?php Box::end(); ?>
        </div>


    </div>
</div>
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
        <?= Html::a('Add Slot', ['fb-booking-slot/create', 'id' => $model['id']], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
		'rowOptions'   => function ($model, $index, $widget, $grid) {
								return [
									'id' => $model['id'], 
									'onclick' => 'location.href="'
										. Yii::$app->urlManager->createUrl('fb-booking-slot/view') 
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
			],
			[
            'attribute' => 'time_to', 
			],
            //'time_to', 
			//'price',
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
			/*function ($model) {
                if ($model->peak == 0) {
                    $class = 'label-success';
                
				  return '<span class="label ' . $class . '">Non-Peak</span>';
				}
				elseif ($model->peak == 1){
                    $class = 'label-warning';
                
				  return '<span class="label ' . $class . '">Peak</span>';
				}
				elseif ($model->peak == 2){
                    $class = 'label-info';
                
				  return '<span class="label ' . $class . '">Both</span>';
				}
			}*/
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
        <?= Html::a('Add Rules', ['fb-booking-rules/create', 'id' => $model['id']], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider1,
        //'filterModel' => $searchModel,
		'rowOptions'   => function ($model, $index, $widget, $grid) {
								return [
									'id' => $model['id'], 
									'onclick' => 'location.href="'
										. Yii::$app->urlManager->createUrl('fb-booking-rules/view') 
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
            'attribute' => 'facility',
			'value' => 'facility1.name',
			],*/
			//'rules_order',
			/*[
            'attribute' => 'group',
			'value' => 'group1.name',
			],*/
            //'range_type',
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
						/*[
            'attribute' => 'rules_order',
			//'value' => 'type1.name',
			],

            'condition',*/
			//'peak',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
        <?php Box::end(); ?>
    </div>
</div> 

 

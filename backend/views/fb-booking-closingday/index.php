<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use vova07\themes\admin\widgets\Box;
use yii\grid\CheckboxColumn;


/* @var $this yii\web\View */
/* @var $searchModel common\models\FbBookingClosingdaySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Closingdays';
$this->params['subtitle'] = 'Booking Closingdays list';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fb-booking-closingday-index">
<?php 
$boxButtons = $actions = [];
$showActions = false;

// if (Yii::$app->user->can('BCreateUsers')) {
//     $boxButtons[] = '{create}';
// }
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

<?= Html::a('CREATE NEW', ['/fb-booking-closingday/create'], ['class'=>'btn btn-success btn-small']) ?>
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
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'rowOptions'   => function ($model, $index, $widget, $grid) {
								return [
									'id' => $model['id'], 
									'onclick' => 'location.href="'
										. Yii::$app->urlManager->createUrl('fb-booking-closingday/view') 
										. '&id="+(this.id);',
									'style' =>'cursor:pointer;', 
								];
						 },	
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
           // 'facility',
			[
            'attribute' => 'facility',
			'value' => 'facility0.name',
			],
            'title',
           // 'notes:ntext',
            /*'date_from',
             'date_to',
             'time_from',
            'time_to',*/
			[
		    'attribute'=>'date_from',
			'format' => ['date', 'php:d M Y']
			],
            //'amc_end',
			[
		    'attribute'=>'date_to',
			'format' => ['date', 'php:d M Y']
			],
            [
		    'attribute'=>'time_from',
			'format' => ['date', 'php:h:ia']
			],
            //'end_time',
			[
		    'attribute'=>'time_to',
			'format' => ['date', 'php:h:ia']
			],
            // 'published',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
        <?php Box::end(); ?>
    </div>
</div>


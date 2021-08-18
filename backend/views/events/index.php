<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use vova07\themes\admin\widgets\Box;
use yii\grid\CheckboxColumn;


/* @var $this yii\web\View */
/* @var $searchModel common\models\EventsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Events';
$this->params['subtitle'] = 'Events list';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="events-index">

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
               // 'title' => $this->params['subtitle'],
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
										. Yii::$app->urlManager->createUrl('events/view') 
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
            'title',
			[
            'attribute' => 'category',
			'value' => 'event.name',
			],

            [
		    'attribute'=>'start_date',
			'format' => ['date', 'php:d M Y']
			],
            //'amc_end',
			[
		    'attribute'=>'end_date',
			'format' => ['date', 'php:d M Y']
			],
            // 'start_time',
            // 'end_time',
            // 'description:ntext',
            // 'image',
            // 'attachment',
            // 'location',
            // 'album_id',
            // 'album_url:url',
            // 'event_for',
            // 'status',
            // 'publish',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
        <?php Box::end(); ?>
    </div>
</div>

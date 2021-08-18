<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use vova07\themes\admin\widgets\Box;
use yii\grid\CheckboxColumn;


/* @var $this yii\web\View */
/* @var $searchModel common\models\FbBookingGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Groups';
$this->params['subtitle'] = 'Groups list';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fb-booking-group-index">

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


<?= Html::a('CREATE NEW', ['/fb-booking-group/create'], ['class'=>'btn btn-success btn-small']) ?>
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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			/*  [
            'class' => CheckboxColumn::classname()
        ],*/
           // 'id',
            //'name',
			[
            'attribute' => 'name',
			//'value' => 'type1.name',
			 'format' => 'html',
			 'value' => function ($model) {
             return Html::a($model['name'], ['fb-booking-group/view', 'id' => $model['id']], ['data-pjax' => 0]);
            }
			],


           // 'calendars',
			[
            'attribute' => 'calendars',
            'format' => 'html',
            'value' => function ($model) {
                if ($model->calendars == 0) {
				  return '<span>Day Calendar</span>';
				}
				if ($model->calendars == 1){
				  return '<span>Week Calendar</span>';
				}
				if ($model->calendars == 2){
				  return '<span>Month Calendar</span>';
				}
			}
        ],
           // 'published',
			[
            'attribute' => 'published',
            'format' => 'html',
            'value' => function ($model) {
                if ($model->published == 0) {
                    $class = 'label-warning';
                
				  return '<span class="label ' . $class . '">InActive</span>';
				}
				if ($model->published == 1){
                    $class = 'label-success';
                
				  return '<span class="label ' . $class . '">Active</span>';
				}
			}
        ],

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
        <?php Box::end(); ?>
    </div>
</div>

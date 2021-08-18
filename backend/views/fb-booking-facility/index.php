<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use vova07\themes\admin\widgets\Box;
use yii\grid\CheckboxColumn;
use yii\helpers\ArrayHelper;
use common\models\FbBookingGroup;


/* @var $this yii\web\View */
/* @var $searchModel common\models\FbBookingFacilitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Facilities';
$this->params['subtitle'] = 'Booking Facilities list';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fb-booking-facility-index">
<?php 
$boxButtons = $actions = [];
$showActions = false;
/*
if (Yii::$app->user->can('BCreateUsers')) {
    $boxButtons[] = '{create}';
}
*/
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
<?= Html::a('CREATE NEW', ['/fb-booking-facility/create'], ['class'=>'btn btn-success btn-small']) ?>
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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			  /*[
            'class' => CheckboxColumn::classname()
        ],*/
           // 'id',
           // 'name',
			[
            'attribute' => 'name',
            'format' => 'html',
            'value' => function ($model) {
                return Html::a($model['name'], ['view', 'id' => $model['id']], ['data-pjax' => 0]);
            }
            ],

			/*[
            'attribute' => 'group',
			'value' => 'group1.name',
			],*/
			[
            'attribute' => 'group',
			'value' => 'group1.name',
			'filter' => Html::activeDropDownList($searchModel, 'group', ArrayHelper::map(FbBookingGroup::find()->asArray()->all(), 'id', 'name'),['class'=>'form-control','prompt' => 'Select Group']),
			], 
            'bookday_start',
            'bookday_end',
            // 'cancel_date',
            // 'unit_time:datetime',
            // 'rulestype',
            // 'rulescondition',
            // 'deposit',
            // 'notes:ntext',
            // 'attachment',
            // 'image',
            // 'album_id',
            // 'album_url:url',
            // 'published',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
        <?php Box::end(); ?>
    </div>
</div>

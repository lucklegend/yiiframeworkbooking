 <?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use vova07\themes\admin\widgets\Box;
use yii\grid\CheckboxColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AssetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Assets';
$this->params['subtitle'] = 'Assets list';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-index">
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
                'title' => $this->params['subtitle'],
                'bodyOptions' => [
                    'class' => 'table-responsive'
                ],
                'buttonsTemplate' => $boxButtons,
                //'grid' => $gridId
            ]
        ); ?>
        <?= GridView::widget(['dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
              [
            'class' => CheckboxColumn::classname()
        ],
            'id',
            'name',
            'model',
			[
            'attribute' => 'category',
			'value' => 'category1.name',
			],
            'brand',
            // 'code',
            // 'purchase_from',
            // 'purchase_date',
            // 'warranty_end_date',
            // 'amc_by',
            // 'amc_start',
            // 'amc_end',
            // 'notes:ntext',
            // 'user_unit',
            // 'user_id',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
        <?php Box::end(); ?>
    </div>
</div>

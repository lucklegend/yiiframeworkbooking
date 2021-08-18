<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use vova07\themes\admin\widgets\Box;
use yii\grid\CheckboxColumn;
use common\models\PagesType;
use common\models\PagesCategories;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pages';
$this->params['subtitle'] = 'Pages list';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index">
<?php 
$boxButtons = $actions = [];
$showActions = false;

 
        echo Html::a('Create', ['pages/create',"id" => $_GET['data']], ['class' => 'btn btn-primary']);
 
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
										. Yii::$app->urlManager->createUrl('pages/view') 
										. '&id="+(this.id);',
									'style' =>'cursor:pointer;', 
								];
						 },	
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            //'content:ntext',
            //'category',
			[
		    'attribute'=>'category',
			'value' => 'category0.category',
			'filter' => Html::activeDropDownList($searchModel, 'category', ArrayHelper::map(PagesCategories::find()->asArray()->all(), 'id', 'category'),['class'=>'form-control','prompt' => 'Select Category']),
            
			],
            //'image',
            // 'attachment',
             [
		    'attribute'=>'type',
			'value' => 'type0.type',
            'filter' => Html::activeDropDownList($searchModel, 'type', ArrayHelper::map(PagesType::find()->asArray()->all(), 'id', 'type'),['class'=>'form-control','prompt' => 'Select Type']),
         
			],
            // 'created_by',
            // 'created_on',
            // 'status',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

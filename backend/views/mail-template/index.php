<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use vova07\themes\admin\widgets\Box;
use yii\grid\CheckboxColumn;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MailTemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mail Templates';
$this->params['subtitle'] = 'Mail Templates list';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mail-template-index">
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
										. Yii::$app->urlManager->createUrl('mail-template/view') 
										. '&id="+(this.id);',
									'style' =>'cursor:pointer;', 
								];
						 },	

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'mail_for',
            'subject',
           //'message:ntext',
			[
			'attribute' => 'message',
			'format' => 'raw',
			],
            'attachment',
            // 'updated_by',
            // 'updated_on',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

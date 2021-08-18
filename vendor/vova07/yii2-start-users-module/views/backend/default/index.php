<?php

/**
 * Users list view.
 *
 * @var \yii\base\View $this View
 * @var \yii\data\ActiveDataProvider $dataProvider Data provider
 * @var \vova07\users\models\backend\UserSearch $searchModel Search model
 * @var array $roleArray Roles array
 * @var array $statusArray Statuses array
 */

use vova07\themes\admin\widgets\Box;
//use vova07\themes\admin\widgets\GridView;
use vova07\users\Module;
use yii\grid\ActionColumn;
use yii\grid\CheckboxColumn;
use yii\helpers\Html;
use yii\jui\DatePicker;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

$this->title = Module::t('users', 'BACKEND_INDEX_TITLE');
$this->params['subtitle'] = Module::t('users', 'BACKEND_INDEX_SUBTITLE');
$this->params['breadcrumbs'] = [
    $this->title
];

$roleArray = ['user' => 'Resident' , 'admin' => 'Club' , 'superadmin' => 'Manager'];
$gridId = 'users-grid';
$gridColumns =[
        [
            'class' => CheckboxColumn::classname()
        ],
        'id',
        [
		
            'attribute' => 'username',
            'format' => 'html',
            'value' => function ($model) {
                return Html::a($model['username'], ['update', 'id' => $model['id']], ['data-pjax' => 0]);
            }
        ],
        'email',
        [
            'attribute' => 'fname', 
        ],
        [
            'attribute' => 'lname' 	
        ],
        [
            'attribute' => 'status_id',
            'format' => 'html',
            'value' => function ($model) {
                if ($model->status_id === $model::STATUS_ACTIVE) {
                    $class = 'label-success';
                } elseif ($model->status_id === $model::STATUS_INACTIVE) {
                    $class = 'label-warning';
                } else {
                    $class = 'label-danger';
                }

                return '<span class="label ' . $class . '">' . $model->status . '</span>';
            },
            'filter' => Html::activeDropDownList(
                $searchModel,
                'status_id',
                $statusArray,
                ['class' => 'form-control', 'prompt' => Module::t('users', 'BACKEND_PROMPT_STATUS')]
            )
        ],
        [
            'attribute' => 'role',
            'value' => function ($model) {
                if ($model->role == 'user' ) {
                    $data = 'Resident';
                } elseif ($model->role == 'admin') {
                    $data = 'Club';
                } else {
                    $data = 'Manager';
                }

                return $data;
            },
            'filter' => Html::activeDropDownList(
                $searchModel,
                'role',
                $roleArray,
                ['class' => 'form-control', 'prompt' => Module::t('users', 'BACKEND_PROMPT_ROLE')]
            )
        ],
        /*[
            'attribute' => 'created_at',
            'format' => 'date',
            'filter' => DatePicker::widget(
                [
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                    'options' => [
                        'class' => 'form-control'
                    ],
                    'clientOptions' => [
                        'dateFormat' => 'dd.mm.yy',
                    ]
                ]
            )
        ],
        [
            'attribute' => 'updated_at',
            'format' => 'date',
            'filter' => DatePicker::widget(
                [
                    'model' => $searchModel,
                    'attribute' => 'updated_at',
                    'options' => [
                        'class' => 'form-control'
                    ],
                    'clientOptions' => [
                        'dateFormat' => 'dd.mm.yy',
                    ]
                ]
            )
        ]*/
];

$gridConfig = [
    'id' => $gridId,
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns
];

$boxButtons = $actions = [];
$showActions = false;
if(  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->identity->role == 'admin' ) {
if (Yii::$app->user->can('BCreateUsers')) {
    $boxButtons[] = '{create}';
}
if (Yii::$app->user->can('BUpdateUsers')) {
    $actions[] = '{update}';
    //$showActions = $showActions || true;
}
if (Yii::$app->user->can('BDeleteUsers')) {
    $boxButtons[] = '{batch-delete}';
    $actions[] = '{delete}';
   // $showActions = $showActions || true;
}

if ($showActions === true) {
    $gridConfig['columns'][] = [
        'class' => ActionColumn::className(),
        'template' => implode(' ', $actions)
    ];
}
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
                'grid' => $gridId
            ]
        ); ?>
        <?php
			
echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
	'exportConfig'=>  [ 
	ExportMenu::FORMAT_TEXT => false,
    ExportMenu::FORMAT_PDF => false,
	ExportMenu::FORMAT_HTML => false,
	ExportMenu::FORMAT_EXCEL  => false,
	ExportMenu::FORMAT_EXCEL_X  => false, 
	
	]
]);
 
		?>
        <?= GridView::widget($gridConfig); ?>
        <?php Box::end(); ?>
    </div>
</div>
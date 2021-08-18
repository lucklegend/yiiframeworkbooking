<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\ArrayHelper;

use vova07\themes\admin\widgets\Box;
use yii\grid\CheckboxColumn;
use common\models\FbBookingFacility;
use common\models\FbBookingStatus;
use kartik\grid\GridView;
use kartik\export\ExportMenu;


/* @var $this yii\web\View */
/* @var $searchModel common\models\FbBookingBookedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Facility Booking';
$this->params['subtitle'] = 'Booked list';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fb-booking-booked-index">

<?//= $this->render('//layouts/sidebar') ?>
 
    <?php 
    $boxButtons = $actions = [];
    $showActions = false;

    // if (Yii::$app->user->can('BCreateUsers')) {
    //     $boxButtons[] = '{create}';
    //}
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
        $boxButtons = !empty($boxButtons) ? implode(' ', $boxButtons) : null; 

    }
    ?> 
		    <div class="page-title">
                <h2> My Booking </h2>
                <span class="line-h"></span> 
            </div>
            <?php Box::begin(
                [
                    
                    'bodyOptions' => [
                        'class' => 'table-responsive'
                    ],
                    //'buttonsTemplate' => $boxButtons,
                    //'grid' => $gridId
                ]
            ); ?>
            <?php 
                $gridColumns = [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    //'user_id',
                    //[
                    // 'attribute' => 'user_id',
                    //'value' => 'profile.name',
                    //],
                    //'facility_id',
                    [
                    'attribute' => 'facility_id',
                    'value' => 'facility0.name',
                    'filter' => Html::activeDropDownList($searchModel, 'facility_id', ArrayHelper::map(FbBookingFacility::find()->asArray()->all(), 'id', 'name'),['class'=>'form-control','prompt' => 'Select Facility']),
                    ],
                    // 'slot_from',
                    //'slot_to',
                    /*[
                    'attribute'=>'slot_from',
                    'format' => ['date', 'php:d M Y h:ia']
                    ],*/
                    //'amc_end',
                    /*[
                    'attribute'=>'slot_to',
                    'format' => ['date', 'php:d M Y h:ia']
                    ],*/
                    [
                    'attribute'=>'slot_from',
                    'label' => 'Date & Time',
                    'value' => function($searchModel){
                        if($searchModel->slot_to == '' || $searchModel->slot_to == '0000-00-00 00:00:00'){
                        return date('d M Y h:ia', strtotime($searchModel->slot_from));
                        } else {
                        if(date('d M Y', strtotime($searchModel->slot_from)) == date('d M Y', strtotime($searchModel->slot_to))){
                        return date('d M Y h:ia', strtotime($searchModel->slot_from)) . " \n - \n " . date('h:ia', strtotime($searchModel->slot_to));
                        } else{
                        return date('d M Y h:ia', strtotime($searchModel->slot_from)) . " \nto\n " . date('d M Y h:ia', strtotime($searchModel->slot_to));
                        }
                        }
                    },
                    //'format' => ['date', 'php:d M Y h:i'],
                    'filter' =>  \yii\jui\DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'slot_from',
                        //'format' => ['date', 'php:Y-m-d'],
                        'dateFormat' => 'yyyy-MM-dd',
                        'options' => [
                        'placeholder'=>'    Select Date',
                        ],
                    ]),
			    ],
			
                [
                'attribute' => 'status',
                'value' => 'status2.title',
                'filter' => Html::activeDropDownList($searchModel, 'status', ArrayHelper::map(FbBookingStatus::find()->asArray()->all(), 'id', 'title'),['class'=>'form-control','prompt' => 'Select Status']),
                ],


                // ['class' => 'yii\grid\ActionColumn'],

		    ];
		
            echo ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumns
            ]);

		?>
	 
    <?php Box::end(); ?> 
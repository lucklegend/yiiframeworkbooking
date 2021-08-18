<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

//use yii\grid\GridView;
use yii\grid\ActionColumn;
use vova07\themes\admin\widgets\Box;
use yii\grid\CheckboxColumn;
use yii\helpers\ArrayHelper;
use common\models\Profiles;
use common\models\Users;
use common\models\FbBookingFacility;
use common\models\FbBookingStatus;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FbBookingBookedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Facility Booking';
$this->params['subtitle'] = 'Today Booked list';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="fb-booking-booked-index"> 
<div class="row">
  <div class="col-xs-12">
    <?php Box::begin(
            [
                //'title' => $this->params['subtitle'],
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
 
			[
            'attribute' => 'user_id',
			'value' =>  function($searchModel){ 
                            $user = Users::findOne($searchModel->user_id);
                            return $user->username;
                        },
			'filter' => Html::activeDropDownList($searchModel, 'user_id', ArrayHelper::map(Users::find()->asArray()->all(), 'id', 'username'),['class'=>'form-control','prompt' => 'Select User']),
			],
            
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
                    if(date('Y-m-d', strtotime($searchModel->slot_from)) == date('Y-m-d', strtotime($searchModel->slot_to))){
                        
                        return date('d M Y h:ia', strtotime($searchModel->slot_from)) . " \nto\n " . date('h:ia', strtotime($searchModel->slot_to));
                    
                    } else {

                        return date('d M Y h:ia', strtotime($searchModel->slot_from));

                    }

				},
				//'format' => ['date', 'php:d M Y h:i'],
             	'filter' =>  \yii\jui\DatePicker::widget([
					'model' => $searchModel,
					'attribute' => 'slot_from',
					//'format' => ['date', 'php:Y-m-d'],
					'dateFormat' => 'yyyy-MM-dd',
           		]),
			], 
		];
		
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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'rowOptions'   => function ($model, $index, $widget, $grid) {
								return [
									'id' => $model['id'], 
									'onclick' => 'location.href="'
										. Yii::$app->urlManager->createUrl('fb-booking-booked/view') 
										. '&id="+(this.id);',
									'style' =>'cursor:pointer;', 
								];
						 },	
         'columns' => $gridColumns
    ]); 
	?>
    <?php Box::end(); ?>
  </div>
</div>

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
$this->params['subtitle'] = 'Booked list';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="fb-booking-booked-index">
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
<?php if(  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->identity->role == 'admin'  ) { ?>
<div class="row">
  <div class="col-xs-3">
    <?php $form = ActiveForm::begin(['action' => Url::to(['/booking/index']), 'method' => 'get']);
		  echo Html::dropDownList('uid', '', ArrayHelper::map(Users::find()->asArray()->all(), 'id', 'username'),['class'=>'form-control','prompt' => 'Select User', 'required' => 'required']);
		  //Html::activeDropDownList($searchModel, 'facility_id', ArrayHelper::map(FbBookingFacility::find()->asArray()->all(), 'id', 'name'),['class'=>'form-control','prompt' => 'Select Facility'])
	?>
  </div>
  <div class="col-xs-3">
    <?php echo Html::dropDownList('facid', '', ArrayHelper::map(FbBookingFacility::find()->asArray()->all(), 'id', 'name'),['class'=>'form-control','prompt' => 'Select Facility', 'required' => 'required']);
	?>
  </div>
  <div class="col-xs-3">
    <?php //= Html::a('New Booking', ['booking/index'], ['class' => 'btn btn-success']) ?>
    <?= Html::submitButton('New Booking', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>
  </div>
</div>
<?php } ?>
<br /> 
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
			/*[
            'label' => 'Review',
            'format' => 'html',
            'value' => function ($model) {
                return Html::a('view', ['review', 'id' => $model['id']], ['data-pjax' => 0]);
            }
            ],*/
			/*[
				'header'=>'Plan Info',
				'value'=> function($model)
						  { 
							   return  Html::a(Yii::t('app', ' {modelClass}', [
									  'modelClass' => 'details',
									  ]), ['review','id'=>$model->id], ['class' => 'btn btn-success', 'id' => 'popupModal']);      
						  },
				 'format' => 'raw'
			],*/
            // 'price',
            // 'deposit',
            // 'total_amount',
            // 'paid_amount',
            // 'payment_method_id',
            // 'payment_details',
            // 'payment_status',
            // 'returned_amount',
            // 'returned_by',
            // 'returned_date',
            // 'returned_details',
            // 'cancelled_time',
            // 'cancelled_by',
            // 'cancelled_reason',
            // 'lapse_date',
            // 'lasttime_book:datetime',
            // 'peak',
            // 'notes:ntext',
            // 'created',
            // 'created_by',
            // 'status',
			/*[
            'attribute' => 'status',
			'value' => 'status2.title',
			],*/
            [
            'attribute' => 'status',
			'value' => 'status2.title',
			'filter' => Html::activeDropDownList($searchModel, 'status', ArrayHelper::map(FbBookingStatus::find()->asArray()->all(), 'id', 'title'),['class'=>'form-control','prompt' => 'Select Status']),
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

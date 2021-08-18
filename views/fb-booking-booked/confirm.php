<?php



use yii\helpers\Html;

use yii\grid\GridView;

use yii\grid\ActionColumn;

use vova07\themes\admin\widgets\Box;

use yii\grid\CheckboxColumn;





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

<div class="row">

    <div class="col-xs-12">

        <?php Box::begin(

            [

                'title' => $this->params['subtitle'],

                'bodyOptions' => [

                    'class' => 'table-responsive'

                ],

               // 'buttonsTemplate' => $boxButtons,

                //'grid' => $gridId

            ]

        ); ?>

    <?= GridView::widget([

        'dataProvider' => $dataProvider,

        //'filterModel' => $searchModel,

		'rowOptions'   => function ($model, $index, $widget, $grid) {

								return [

									'id' => $model['id'], 

									'onclick' => 'location.href="'

										. Yii::$app->urlManager->createUrl('fb-booking-booked/view') 

										. '&id="+(this.id);',

									'style' =>'cursor:pointer;', 

								];

						 },	

        'columns' => [

            ['class' => 'yii\grid\SerialColumn'],



            //'id',

            //'user_id',

			/*[

            'attribute' => 'user_id',

			'value' => 'profile.name',

			],*/

            //'facility_id',

			[

            'attribute' => 'facility_id',

			'value' => 'facility0.name',

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

				'value' => function($dataProvider){

								if($dataProvider->slot_to == '' || $dataProvider->slot_to == '0000-00-00 00:00:00'){

									return date('d M Y h:ia', strtotime($dataProvider->slot_from));

								} else {

									if(date('d M Y', strtotime($dataProvider->slot_from)) == date('d M Y', strtotime($dataProvider->slot_to))){

									return date('d M Y h:ia', strtotime($dataProvider->slot_from)) . " \nto\n " . date('h:ia', strtotime($dataProvider->slot_to));

									} else{

								    return date('d M Y h:ia', strtotime($dataProvider->slot_from)) . " \nto\n " . date('d M Y h:ia', strtotime($dataProvider->slot_to));

									}

								}

				},

				//'format' => ['date', 'php:d M Y h:i'],

             	'filter' =>  \yii\jui\DatePicker::widget([

					'model' => $dataProvider,

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

			[

            'attribute' => 'status',

			'value' => 'status2.title',

			],



           // ['class' => 'yii\grid\ActionColumn'],

        ],

    ]); 

	?>

        <?php Box::end(); ?>

    </div>

</div>


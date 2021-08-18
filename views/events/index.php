<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use vova07\themes\admin\widgets\Box;
use yii\grid\CheckboxColumn;


/* @var $this yii\web\View */
/* @var $searchModel app\models\EventsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//var_dump(Yii::$app->params['dateControlDisplay']); 



$this->title = 'Events';
$this->params['subtitle'] = 'Events list';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="events-index">

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
$boxButtons = !empty($boxButtons) ? implode(' ', $boxButtons) : null; 
//print_r(Yii::$app->user->identity->role);

?>
<div class="row">
<?//= $this->render('//layouts/sidebar') ?>

    <div class="col-sm-12"> 
    <div class="page-title">
      <h1 style="color:#ac7339;">Social Events</h1>
      <span class="line-h"></span> </div>

 
        <?php Box::begin(
            [
                //'title' => $this->params['subtitle'],
                'bodyOptions' => [
                    'class' => 'table-responsive'
                ],
               // 'buttonsTemplate' => $boxButtons,
                //'grid' => $gridId
            ]
        ); ?>
     <p>
        <?php //Html::a('Add Items', ['events/create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'rowOptions'   => function ($model, $index, $widget, $grid) {
								return [
									'id' => $model['id'], 
									'onclick' => 'location.href="'
										. Yii::$app->urlManager->createUrl('events/view') 
										. '&id="+(this.id);',
									'style' =>'cursor:pointer;', 
								];
						 },	
        'columns' => [
			 [
			    'label' => 'Event Name',
				'attribute'=>'title',
				'filterInputOptions' => [
                'class'       => 'form-control',
                'placeholder' => 'Search Events'
             ],
				'format' => 'raw',
				'value' => function($searchModel){
									return "<b>" .$searchModel->title . "</b> <br> " . $searchModel->category ? $searchModel->event->name : '';
				},
			],	
           
		    [
			    'label' => 'Date',
				'attribute'=>'start_date',
				'format' => 'raw',
				 
				'value' => function($searchModel){
								if($searchModel->end_date == '' || $searchModel->end_date == '0000-00-00 00:00:00'){
									return date('d M Y', strtotime($searchModel->start_date)) . "<br>" . date('h:ia', strtotime($searchModel->start_time));
								} else {
									if(date('d M Y', strtotime($searchModel->start_date)) == date('d M Y', strtotime($searchModel->end_date))){
									return date('d M Y', strtotime($searchModel->start_date)) . " \n-\n " . date('d M Y', strtotime($searchModel->end_date)) . "<br>". date('h:ia', strtotime($searchModel->start_time)) . " \n-\n " . date('h:ia', strtotime($searchModel->end_time));
									} else{
								    return date('d M Y', strtotime($searchModel->start_date)) . " \n-\n " . date('d M Y', strtotime($searchModel->end_date)) ."<br>". date('h:ia', strtotime($searchModel->start_time)) . " \n-\n " . date('h:ia', strtotime($searchModel->end_time));
									}
								}
				},
				//'format' => ['date', 'php:d M Y h:i'],
             	'filter' =>  \yii\jui\DatePicker::widget([
					'model' => $searchModel,
					'attribute' => 'start_date',
					//'format' => ['date', 'php:Y-m-d'],
					'dateFormat' => 'yyyy-MM-dd',
           		]),
			],		
			
        ],
    ]); ?>
        <?php Box::end(); ?>
    </div>
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use common\models\UsefulType;


/* @var $this yii\web\View */
/* @var $searchModel common\models\UsefulSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contractors Info';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="useful-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php //print_r($services); 

	foreach($services as $key => $service){
		echo '<h3>' . $key . '</h3>';
		foreach($service as $k => $value){
			if($k == 0){
				echo '<div class="onScroll-x">
							<table class="table table-striped table-bordered">';
			}
			echo '<tr><td width="20">' . ++$i . '</td>
						<td width="20%">' . $value->name . '</td>
						<td width="35%">' . $value->service . '</td>
						<td width="35%">' . $value->address . '</td>
						<td width="10%">' . $value->tel . '</td></tr>';
			if(($k+1) == count($service)){
				echo '</table> </div>';
			}
		}
	}
	?>

<?php 
//	Pjax::begin(); ?>    <?php 
//			echo GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'name',
//			[
//				'attribute' => 'type',
//				'label' 	=> 'Category',
//				'value' 	=> 'type.name',
//                'filter' => Html::activeDropDownList($searchModel, 'type', ArrayHelper::map(UsefulType::find()->orderBy(['name' => SORT_ASC])->asArray()->all(), 'id', 'name'),['class'=>'form-control','prompt' => '']),
//			],
//				
//            'service',
//			[
//				'attribute' => 'address',
//				'label' 	=> Yii::t('app', 'Contacts'),
//			],
//            //'address',
//            //'tel',
//            // 'email:email',
//            // 'url:url',
//            // 'status',
//        ],
//    ]); 
	?>
<?php //Pjax::end(); ?></div>

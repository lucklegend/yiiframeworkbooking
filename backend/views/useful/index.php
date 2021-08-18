<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\UsefulType;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UsefulSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contractor / Supplier';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="useful-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Contractor / Supplier', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
			[
				'attribute' => 'type',
				'label' 	=> 'Category',
				'value' 	=> 'type.name',
                'filter' => Html::activeDropDownList($searchModel, 'type', ArrayHelper::map(UsefulType::find()->orderBy(['name' => SORT_ASC])->asArray()->all(), 'id', 'name'),['class'=>'form-control','prompt' => '']),
			],
				
            'service',
			[
				'attribute' => 'address',
				'label' 	=> Yii::t('app', 'Contacts'),
			],
            // 'tel',
            // 'email:email',
            // 'url:url',
            // 'status',

            //['class' => 'yii\grid\ActionColumn'],
			[
				'class' 		=> 'kartik\grid\ActionColumn',
				'headerOptions' => ['style' => 'width:200px'],
				'options'		=> ['class' => 'listaction'],
				'width' 		=> '120px',
			],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

<?php

use yii\helpers\Html; 
use yii\widgets\Pjax;
 
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
use common\models\FbBookingGroup;
use common\models\FbBookingStatus;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FbBarringSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Barrings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fb-barring-index"> 
    <p>
    
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
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
                    'value' =>  function($searchModel){ 
                        $user = FbBookingFacility::findOne($searchModel->facility_id);
                        return $user->name;
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'facility_id', ArrayHelper::map(FbBookingFacility::find()->asArray()->all(), 'id', 'name'),['class'=>'form-control','prompt' => 'Select Facility']),
                    ],
                    [
                        'attribute' => 'group_id',
                        'value' =>  function($searchModel){ 
                            $grp = FbBookingGroup::findOne($searchModel->group_id);
                            return $grp->name;
                        },
                        'filter' => Html::activeDropDownList($searchModel, 'group_id', ArrayHelper::map(FbBookingGroup::find()->asArray()->all(), 'id', 'name'),['class'=>'form-control','prompt' => 'Select Group']),
                        ],
            'last_book',
            'expiry',

            ['class' => 'yii\grid\ActionColumn', 'header'=>"Actions"],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

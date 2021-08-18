<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use vova07\themes\admin\widgets\Box;

/* @var $this yii\web\View */
/* @var $model common\models\FbBarring */

$usr = $model->user->username;
$this->title = 'Barred User: '. $usr;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Barrings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fb-barring-view"> 
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        
        <?= Html::a('Back', ['index' ], ['class' => 'btn btn-info']) ?>
    </p>

    
<div class="fb-booking-barring">
    <div class="row">
        <div class="col-xs-12">
            <?php Box::begin(
                [
                    'title' => 'Facility Barring',
                    'bodyOptions' => [
                        'class' => 'table-responsive'
                    ],
                ]
            ); ?>
            <p>

            </p>

            <?= \gamitg\detailview4cols\DetailView4Col::widget([
                'model' => $model,
                'attributes' => [

                    [
                        'attribute' => 'user_id', 
                        'label' => 'User',
                        'value' => $model->user->username,
                    ],
                    
                    [
                        'attribute' => 'facility_id', 
                        'label' => 'Facility',
                        'value' => $model->fac->name,
                    ], 
                    
                    [
                        'attribute' => 'group_id', 
                        'label' => 'Group',
                        'value' => $model->grp->name,
                    ], 
                    'last_book',
                    'expiry',


                ],
            ]) ?>
            <?php Box::end(); ?>
        </div>


    </div>
</div>
 
</div>

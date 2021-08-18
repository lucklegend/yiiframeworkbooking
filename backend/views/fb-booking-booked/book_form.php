<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\FbBookingFacility;
use common\models\FbBookingStatus;
use common\models\Users;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\AttendanceWorkers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="Booking-Report"> 

    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
           <div class="col-sm-8">
    			<?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(Users::find()->asArray()->all(), 'id', 'username'),  ['prompt'=>'All Users']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
    			<?= $form->field($model, 'facility_id')->dropDownList(ArrayHelper::map(FbBookingFacility::find()->orderBy(['name'=> SORT_ASC])->all(),'id','name'),  ['prompt'=>'All Facility']); ?>
            </div>
        </div>
        
        <div class="row" >
           <div class="col-sm-8">
						 <?= $form->field($model, 'slot_from')->widget(
                'trntv\yii\datetime\DateTimeWidget',
                [
                    'phpDatetimeFormat' => 'yyyy-MM-dd',
                    'clientOptions' => [
                        'minDate' => new \yii\web\JsExpression('new Date("2016-01-01")'),
                        'allowInputToggle' => false,
                        'sideBySide' => true,
                        'locale' => 'en',
                        'widgetPositioning' => [
                           'horizontal' => 'auto',
                           'vertical' => 'bottom'
                        ]
                ]
            ])->label('Date From'); ?>
           </div>
         </div>
           <div class="row">
                      <div class="col-sm-8">
						 <?= $form->field($model, 'slot_to')->widget(
                'trntv\yii\datetime\DateTimeWidget',
                [
                    'phpDatetimeFormat' => 'yyyy-MM-dd',
                    'clientOptions' => [
                        'minDate' => new \yii\web\JsExpression('new Date("2016-01-01")'),
                        'allowInputToggle' => true,
                        'sideBySide' => true,
                        'locale' => 'en',
                        'widgetPositioning' => [
                           'horizontal' => 'auto',
                           'vertical' => 'bottom'
                        ]
                ]
            ])->label('Date To'); ?>
           </div>

        </div>
        <div class="row">
            <div class="col-sm-8">
    			<?= $form->field($model, 'status')->dropDownList(ArrayHelper::map(FbBookingStatus::find()->orderBy(['title'=> SORT_ASC])->all(),'id','title'),  ['prompt'=>'All Status']); ?>
            </div>
        </div>
        
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Search' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


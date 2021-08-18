<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\FbBookingGroup;
use app\models\FbBookingFacility;


/* @var $this yii\web\View */
/* @var $model app\models\FbBookingRules */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fb-booking-rules-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'facility')->dropDownList(ArrayHelper::map(FbBookingFacility::find()->all(),'id','name'),  ['prompt'=>'Select from list']); ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'group')->dropDownList(ArrayHelper::map(FbBookingGroup::find()->all(),'id','name'),  ['prompt'=>'Select from list']); ?>
            </div>
           </div>
           
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'peak')->textInput() ?>
            </div>
            <div class="col-sm-6">
    			<?= $form->field($model, 'range_type')->dropDownList([ 1 => '1', 2 => '2', 3 => '3', ], ['prompt' => '']) ?>
            </div>
         </div>
         
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'range_limit')->textInput() ?>
            </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'rules_order')->textInput() ?>
           </div>
        </div>   
        
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'condition')->dropDownList([ 'or' => 'Or', 'and' => 'And', ], ['prompt' => '']) ?>
            </div>
         </div>
      </div>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\FbBookingGroup;
use common\models\FbBookingFacility;


/* @var $this yii\web\View */
/* @var $model common\models\FbBookingRules */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fb-booking-rules-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6" style="display:none">
    			<?= $form->field($model, 'group')->dropDownList($group,['options' =>[$id => ['selected' => true]]], array('disabled' => 'disabled')); ?>
            </div>
           </div>
                   <div class="row">
            <div class="col-sm-6">
    			<?= $form->field($model, 'range_type')->dropDownList([ 1 => 'Days', 2 => 'Weeks', 3 => 'Months', ], ['prompt' => 'Select...']) ?>
            </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'range_limit')->textInput() ?>
            </div>
         </div>
         
        <div class="row">
          <div class="col-sm-6">
    			<?= $form->field($model, 'rules_order')->textInput() ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'condition')->dropDownList([ 'or' => 'Or', 'and' => 'And', ], ['prompt' => 'Select...']) ?>
            </div>
        </div>   
        
           <div class="row">
               <div class="col-sm-6">
    			<?= $form->field($model, 'peak')->dropDownList([ '0'=>'Non-peak', '1'=>'peak', '2'=>'Both', ], ['prompt' => 'Select...']) ?>
            </div>
           </div>

        
      </div>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

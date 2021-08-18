<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\FbBookingFacility;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;
use kartik\widgets\TimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\FbBookingSlot */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fb-booking-slot-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6"  style="display:none">
    			<?= $form->field($model, 'group')->dropDownList($group,['options' =>[$id => ['selected' => true]]], array('disabled' => 'disabled')); ?>
            </div>
         </div>
         
        <div class="row">
           <div class="col-sm-6">
          <?=
			 $form->field($model, 'time_from')->widget(TimePicker::className(), [
     'pluginOptions' => [
        'showSeconds' => true,
        'showMeridian' => false,
        'minuteStep' => 1,
        'secondStep' => 5,
    ]
]); ?>
            </div>
          <div class="col-sm-6">
          <?=
			 $form->field($model, 'time_to')->widget(TimePicker::className(), [
    'pluginOptions' => [
        'showSeconds' => true,
        'showMeridian' => false,
        'minuteStep' => 1,
        'secondStep' => 5,
    ]
]);
            ?>
           </div>
        </div>
        
        <div class="row">
           <div class="col-sm-1">
    			<?= $form->field($model, 'monday')->checkBox() ?>
           </div>
           <div class="col-sm-1">
               <?= $form->field($model, 'tuesday')->checkBox() ?>
            </div>
            <div class="col-sm-1">
    			<?= $form->field($model, 'wednesday')->checkBox() ?>
           </div>
           <div class="col-sm-1">
    			<?= $form->field($model, 'thursday')->checkBox() ?>
           </div>
           <div class="col-sm-1">
    			<?= $form->field($model, 'friday')->checkBox() ?>
           </div>
           <div class="col-sm-1">
    			<?= $form->field($model, 'saturday')->checkBox() ?>
           </div>
            <div class="col-sm-1">
    			<?= $form->field($model, 'sunday')->checkBox() ?>
           </div>

        </div>
        
<!--        <div class="row">
           <div class="col-sm-6">
    			<?php //= $form->field($model, 'wednesday')->checkBox() ?>
           </div>
           <div class="col-sm-6">
    			<?php //= $form->field($model, 'thursday')->checkBox() ?>
           </div>
        </div>
        
        <div class="row">
           <div class="col-sm-6">
    			<?php //= $form->field($model, 'friday')->checkBox() ?>
           </div>
           <div class="col-sm-6">
    			<?php //= $form->field($model, 'saturday')->checkBox() ?>
           </div>
       </div>
-->       
        <div class="row">
             <div class="col-sm-6">
    			<?= $form->field($model, 'price')->textInput(['value' => 0]) ?>
            </div>

          <!-- <div class="col-sm-6">
    			<?php //= $form->field($model, 'sunday')->checkBox() ?>
           </div>-->
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

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\FbBookingFacility;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\FbBookingSlot */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fb-booking-slot-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'facility')->dropDownList(ArrayHelper::map(FbBookingFacility::find()->all(),'id','name'),  ['prompt'=>'Select from list']); ?>
            </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'price')->textInput() ?>
            </div>
         </div>
         
        <div class="row">
           <div class="col-sm-6">
   				<?= $form->field($model, 'time_from')->textInput() ?>
            </div>
          <div class="col-sm-6">
    			<?= $form->field($model, 'time_to')->textInput() ?>
           </div>
        </div>
        
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'monday')->textInput() ?>
           </div>
           <div class="col-sm-6">
               <?= $form->field($model, 'tuesday')->textInput() ?>
            </div>
        </div>
        
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'wednesday')->textInput() ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'thursday')->textInput() ?>
           </div>
        </div>
        
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'friday')->textInput() ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'saturday')->textInput() ?>
           </div>
       </div>
       
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'sunday')->textInput() ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'peak')->dropDownList([ '0', '1', '2', ], ['prompt' => '']) ?>
           </div>
         </div>
      </div>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

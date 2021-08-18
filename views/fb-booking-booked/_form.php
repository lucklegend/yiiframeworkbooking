<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use common\models\FbBookingPaymentMethod;
use common\models\Profiles;
use common\models\FbBookingStatus;
use common\models\FbBookingFacility;
use common\models\FbBookingPaymentStatus;
use kartik\datecontrol\DateControl;
/* @var $this yii\web\View */
/* @var $model common\models\FbBookingBooked */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fb-booking-booked-form">

    <?php $form = ActiveForm::begin(); ?>
          <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(Profiles::find()->all(),'user_id','name'),  ['prompt'=>'Select from list']); ?>
            </div>
            <div class="col-sm-6">
    			<?= $form->field($model, 'facility_id')->dropDownList(ArrayHelper::map(FbBookingFacility::find()->all(),'id','name'),  ['prompt'=>'Select from list']); ?>
            </div>
        </div>
        
    <div class="row">
           <div class="col-sm-6">
                				<?php
			echo $form->field($model, 'slot_from')->widget(DateControl::classname(), [
					'displayFormat' => 'php:d-M-y h:ia',
					'type'=>DateControl::FORMAT_DATETIME,
					//'saveOptions' => 'php:Y-m-d',
				]);
            ?>

           </div>
           <div class="col-sm-6">
                				<?php
			echo $form->field($model, 'slot_to')->widget(DateControl::classname(), [
					'displayFormat' => 'php:d-M-y h:ia',
					'type'=>DateControl::FORMAT_DATETIME,
					//'saveOptions' => 'php:Y-m-d',
				]);
            ?>

           </div>
   </div>
   
    <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'price')->textInput() ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'deposit')->textInput() ?>
           </div>
     </div>
     
    <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'total_amount')->textInput() ?>
            </div>
            <div class="col-sm-6">
    			<?= $form->field($model, 'paid_amount')->textInput() ?>
             </div>
     </div>
     
   <div class="row">
           <div class="col-sm-6">
   				 <?= $form->field($model, 'payment_method_id')->dropDownList(ArrayHelper::map(FbBookingPaymentMethod::find()->all(),'id','title'),  ['prompt'=>'Select from list']); ?>
            </div>
            <div class="col-sm-6">
    			<?= $form->field($model, 'payment_details')->textInput(['maxlength' => true]) ?>
             </div>
    </div>
    
    <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'payment_status')->dropDownList(ArrayHelper::map(FbBookingPaymentstatus::find()->all(),'id','title'),  ['prompt'=>'Select from list']); ?>
            </div>
            <div class="col-sm-6">
    			<?= $form->field($model, 'returned_amount')->textInput() ?>
             </div>
     </div>        
           
    <div class="row">
           <div class="col-sm-6">
     			<?= $form->field($model, 'returned_by')->textInput() ?>
            </div>
            <div class="col-sm-6">
    			<?= $form->field($model, 'returned_date')->textInput() ?>
            </div>
     </div>
     
    <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'returned_details')->textInput(['maxlength' => true]) ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'cancelled_time')->textInput() ?>
           </div>
    </div>
    
   <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'cancelled_by')->textInput() ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'cancelled_reason')->textInput() ?>
            </div>
    </div>
    
    <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'lapse_date')->textInput() ?>
            </div>
            <div class="col-sm-6">
    			<?= $form->field($model, 'lasttime_book')->textInput() ?>
            </div>
    </div>
    
    <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'peak')->dropDownList([ '0'=>'Non-peak', '1'=>'peak', '2'=>'Both', ], ['prompt' => 'Select...']) ?>
           </div>
           <div class="col-sm-6">
   				 <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>
           </div>
     </div>
     
    <div class="row">
            <div class="col-sm-6">
    			<?= $form->field($model, 'created_by')->dropDownList(ArrayHelper::map(Profiles::find()->all(),'user_id','name'),  ['prompt'=>'Select from list']); ?>
            </div>
                       <div class="col-sm-6">
    			<?= $form->field($model, 'status')->dropDownList(ArrayHelper::map(FbBookingStatus::find()->all(),'id','title'),  ['prompt'=>'Select from list']); ?>
            </div>

     </div>
       </div> 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

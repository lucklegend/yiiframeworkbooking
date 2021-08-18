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
use yii\widgets\DetailView;
use vova07\imperavi\Widget as Imperavi;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\FbBookingBooked */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fb-booking-booked-form">

    <?php $form = ActiveForm::begin(); ?>
          <div class="box-body table-responsive">
    <?= \gamitg\detailview4cols\DetailView4Col::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
            'attribute' => 'user_id',
			'value' => $model->profile->name,
			],
            //'facility_id',
			[
            'attribute' => 'facility_id',
			'value' => $model->facility0->name,
			],
            [
		    'attribute'=>'slot_from',
			'value' =>   date('d M Y h:ia', strtotime($model->slot_from)),
			],
            //'amc_end',
			[
		    'attribute'=>'slot_to',
			'value' =>   date('d M Y h:ia', strtotime($model->slot_to)),
			],
            'price',
            'deposit',
            'total_amount',
            'paid_amount',

        ],
    ]);
	
	?>
     
   <div class="row">
           <div class="col-sm-6">
   				 <?= $form->field($model, 'payment_method_id')->dropDownList(ArrayHelper::map(FbBookingPaymentMethod::find()->all(),'id','title'), ['prompt'=>'Select from list']); ?>
            </div>
            <div class="col-sm-6">
    			<?= $form->field($model, 'payment_details')->textInput(['maxlength' => true]) ?>
             </div>
    </div>
    
    <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'payment_status')->dropDownList(ArrayHelper::map(FbBookingPaymentstatus::find()->all(),'id','title'), ['options' => [1 => ['selected'=>'selected']]], ['prompt'=>'Select from list']); ?>
            </div>
            <div class="col-sm-6">
    			<?= $form->field($model, 'returned_amount')->textInput() ?>
             </div>
     </div>        
           
    <div class="row">
           <div class="col-sm-6">
                <?php
			echo $form->field($model, 'returned_date')->widget(DateControl::classname(), [
					'displayFormat' => 'php:d-M-Y h:ia',
					'type'=>DateControl::FORMAT_DATETIME,
					//'saveOptions' => 'php:Y-m-d',
				]);
            ?>
           </div>
            <div class="col-sm-6">
    			<?= $form->field($model, 'returned_details')->textInput(['maxlength' => true]) ?>
            </div>
     </div>
     
   <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'cancelled_reason')->textInput() ?>
            </div>
             <div class="col-sm-6">
                <?php
			echo $form->field($model, 'lapse_date')->widget(DateControl::classname(), [
					'displayFormat' => 'php:d-M-y h:ia',
					'type'=>DateControl::FORMAT_DATETIME,
					//'saveOptions' => 'php:Y-m-d',
				]);
            ?>
            </div>

    </div>
    
    <div class="row">
    </div>
    
    <div class="row">
             <div class="col-sm-6">
    			<?= $form->field($model, 'status')->dropDownList(ArrayHelper::map(FbBookingStatus::find()->all(),'id','title'),  ['prompt'=>'Select from list']); ?>
            </div>
           <div class="col-sm-6">
                  <?= $form->field($model, 'notes')->widget(
                Imperavi::className(),
                [
                    'settings' => [
                        'minHeight' => 150,
                        'imageGetJson' => Url::to(['/fb-booking-booked/imperavi-get']),
                        'imageUpload' => Url::to(['/fb-booking-booked/imperavi-image-upload']),
                        'fileUpload' => Url::to(['/fb-booking-booked/imperavi-file-upload'])
                    ]
                ]
            ) ?>
           </div>
     </div>
     
 </div> 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		<?= Html::a('Cancel', ['/fb-booking-booked/view','id'=>$model->id], ['class'=>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use common\models\FbBookingFacility;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use vova07\imperavi\Widget as Imperavi;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\FbBookingClosingday */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fb-booking-closingday-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-6">
   				 <?= $form->field($model, 'published')->dropDownList(['0' => 'InActive', '1' => 'Active']); ?>
            </div>
          </div>
          
        <div class="row">
           <div class="col-sm-6">
				<?php
			echo $form->field($model, 'date_from')->widget(DateControl::classname(), [
					'displayFormat' => 'php:d-M-Y',
					'type'=>DateControl::FORMAT_DATE,
					//'saveOptions' => 'php:Y-m-d',
				]);
            ?>
          </div>
          <div class="col-sm-6">
				<?php
			echo $form->field($model, 'date_to')->widget(DateControl::classname(), [
					'displayFormat' => 'php:d-M-Y',
					'type'=>DateControl::FORMAT_DATE,
					//'saveOptions' => 'php:Y-m-d',
				]);
            ?>
            </div>
         </div>
         
        <div class="row">
           <div class="col-sm-6">
                <?php
			echo $form->field($model, 'time_from')->widget(DateControl::classname(), [
					'displayFormat' => 'php:h:ia',
					'type'=>DateControl::FORMAT_TIME,
					//'saveOptions' => 'php:Y-m-d',
				]);
            ?>
            </div>
          <div class="col-sm-6">
                <?php
			echo $form->field($model, 'time_to')->widget(DateControl::classname(), [
					'displayFormat' => 'php:h:ia',
					'type'=>DateControl::FORMAT_TIME,
					//'saveOptions' => 'php:Y-m-d',
				]);
            ?>
          </div>
        </div>
        
        <div class="row">
           <div class="col-sm-6">
                <?= $form->field($model, 'notes')->widget(
                Imperavi::className(),
                [
                    'settings' => [
                        'minHeight' => 300,
                        'imageGetJson' => Url::to(['/fb-booking-closingday/imperavi-get']),
                        'imageUpload' => Url::to(['/fb-booking-closingday/imperavi-image-upload']),
                        'fileUpload' => Url::to(['/fb-booking-closingday/imperavi-file-upload'])
                    ]
                ]
            ) ?>
           </div>
           <div class="col-sm-6">
             <?php $data = ArrayHelper::map(FbBookingFacility::find()->all(),'id','name'); ?>
           		<?= $form->field($model, 'facility')->widget(Select2::classname(), [
					'data' => $data,
					'language' => 'de',
					'options' => ['placeholder' => 'Select a state ...'],
					'pluginOptions' => [
						'allowClear' => true,
						//'multiple' => true
					],
				]); ?>
           </div>
        </div>
      </div>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

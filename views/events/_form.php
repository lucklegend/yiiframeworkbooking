<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\EventsCategory;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use kartik\datecontrol\DateControl;
/* @var $this yii\web\View */
/* @var $model app\models\Events */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="events-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'category')->dropDownList(ArrayHelper::map(EventsCategory::find()->all(),'id','name'),  ['prompt'=>'Select from list']); ?>
           </div>
         </div>
         
        <div class="row">
           <div class="col-sm-6">
        	<?php
		echo $form->field($model, 'start_date')->widget(DateControl::classname(), [
					'displayFormat' => 'php:d-M-Y',
					'type'=>DateControl::FORMAT_DATE,
					//'saveOptions' => 'php:Y-m-d',
				]);
        ?>
          </div>
          <div class="col-sm-6">
    	<?php
		echo $form->field($model, 'end_date')->widget(DateControl::classname(), [
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
				echo $form->field($model, 'start_time')->widget(DateControl::classname(), [
					'displayFormat' => 'php:h:ia',
					'type'=>DateControl::FORMAT_TIME,
					//'saveOptions' => 'php:Y-m-d',
				]);
				?>
           </div>
           <div class="col-sm-6">
                <?php 
				echo $form->field($model, 'end_time')->widget(DateControl::classname(), [
					'displayFormat' => 'php:h:ia',
					'type'=>DateControl::FORMAT_TIME,
					//'saveOptions' => 'php:Y-m-d',
				]);
				?>
           </div>
       </div>
       
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'image')->widget(FileInput::classname(), ['options' => ['multiple' => true]]); ?>
           </div>
          <div class="col-sm-6">
    			<?= $form->field($model, 'attachment')->widget(FileInput::classname(), ['options' => ['multiple' => true]]); ?>
          </div>
      </div>
      
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>
           </div>
          <div class="col-sm-6">
    			<?= $form->field($model, 'album_id')->textInput() ?>
           </div>
        </div>
        
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'album_url')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-6">
    			<?= $form->field($model, 'event_for')->textInput(['maxlength' => true]) ?>
            </div>
         </div>
         
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'status')->dropDownList(['0' => 'InActive', '1' => 'Active']); ?>
            </div>
          <!--  <div class="col-sm-6">
    			< //?= $form->field($model, 'publish')->textInput() ?>
            </div>-->
         <!--</div>-->
         
        <!--<div class="row">-->
           <div class="col-sm-6">
                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
           </div>
       </div>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

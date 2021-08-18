<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Users;
use common\models\Profiles;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model common\models\Visitors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="visitors-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
         <div class="col-sm-6">
    			<?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
         </div>
      </div>
      
		<div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'meet_whom')->dropDownList(ArrayHelper::map(Users::find()->all(),'id','fname'),  ['prompt'=>'Select from list']); ?>
            </div>
            <div class="col-sm-6">
    			<?= $form->field($model, 'meet_for')->textInput() ?>
            </div>
        </div>
        
		<div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'relationship')->textInput(['maxlength' => true]) ?>
           </div>
           <div class="col-sm-6">
                <?php
				echo $form->field($model, 'entry_time')->widget(DateControl::classname(), [
					'displayFormat' => 'php:d-M-Y h:i:sa',
					'type'=>DateControl::FORMAT_DATETIME,
					//'saveOptions' => 'php:Y-m-d',
				]);
				?>
            </div>
         </div>
         
		<div class="row">
           <div class="col-sm-6">
                <?php 
				echo $form->field($model, 'exit_time')->widget(DateControl::classname(), [
					'displayFormat' => 'php:d-M-Y h:i:sa',
					'type'=>DateControl::FORMAT_DATETIME,
					//'saveOptions' => 'php:Y-m-d',
				]);
				?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'gate_no')->textInput() ?>
            </div>
        </div>
        
   		<div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'updated_by')->dropDownList(ArrayHelper::map(Profiles::find()->all(),'user_id','name'),  ['prompt'=>'Select from list']); ?>
           </div>
       </div>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

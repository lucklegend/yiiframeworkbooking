<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\FbBookingGroup;
use kartik\file\FileInput;


/* @var $this yii\web\View */
/* @var $model app\models\FbBookingFacility */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fb-booking-facility-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-6">
    			<?= $form->field($model, 'group')->dropDownList(ArrayHelper::map(FbBookingGroup::find()->all(),'id','name'),  ['prompt'=>'Select from list']); ?>
            </div>
            </div>
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'bookday_start')->textInput() ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'bookday_end')->textInput() ?>
           </div>
        </div>
            
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'cancel_date')->textInput() ?>
           </div>
          <div class="col-sm-6">
    			<?= $form->field($model, 'cancel_date')->textInput() ?>
           </div>
       </div>
       
      <div class="row">
          <div class="col-sm-6">
    			<?= $form->field($model, 'unit_time')->textInput() ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'rulestype')->dropDownList([ 1 => '1', 2 => '2', 3 => '3', ], ['prompt' => '']) ?>
           </div>
       </div>
       
     <div class="row">
            <div class="col-sm-6">
    			<?= $form->field($model, 'rulescondition')->textInput(['maxlength' => true]) ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'deposit')->textInput() ?>
           </div>
     </div>
     <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'attachment')->widget(FileInput::classname(), ['options' => ['multiple' => true]]); ?>
            </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'image')->widget(FileInput::classname(), ['options' => ['multiple' => true]]); ?>
           </div>
     </div>
     
      <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'album_id')->textInput() ?>
           </div>
           <div class="col-sm-6">
   				 <?= $form->field($model, 'album_url')->textInput(['maxlength' => true]) ?>
            </div>
     </div>
      <div class="row">
            <div class="col-sm-6">
    			<?= $form->field($model, 'published')->dropDownList(['0' => 'InActive', '1' => 'Active']); ?>
           </div>
           <div class="col-sm-6">
                <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>
            </div>
      </div>
   </div>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

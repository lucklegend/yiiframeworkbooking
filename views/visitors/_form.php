<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Users;



/* @var $this yii\web\View */
/* @var $model app\models\Visitors */
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
    			<?= $form->field($model, 'entry_time')->textInput() ?>
            </div>
         </div>
         
		<div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'exit_time')->textInput() ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'gate_no')->textInput() ?>
            </div>
        </div>
        
   		<div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'updated_by')->dropDownList(ArrayHelper::map(Users::find()->all(),'id','fname'),  ['prompt'=>'Select from list']); ?>
           </div>
       </div>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

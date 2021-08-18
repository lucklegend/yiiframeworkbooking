<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\FilesType;
use app\models\FilesCategory;
use app\models\Users;
use app\models\UsersType;
use kartik\file\FileInput;


/* @var $this yii\web\View */
/* @var $model app\models\Files */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="files-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
   			 	<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'file_name')->textInput(['maxlength' => true]) ?>
           </div>
        </div>
        
		<div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'file_type')->widget(FileInput::classname(), ['options' => ['multiple' => true]]); ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'file_icon')->widget(FileInput::classname(), ['options' => ['multiple' => true]]); ?>
           </div>
        </div>
        
		<div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'category')->dropDownList(ArrayHelper::map(FilesCategory::find()->all(),'id','name'),  ['prompt'=>'Select from list']); ?>
            </div>
          <div class="col-sm-6">
    			<?= $form->field($model, 'uploaded_by')->dropDownList(ArrayHelper::map(Users::find()->all(),'id','fname'),  ['prompt'=>'Select from list']); ?>
           </div>
         </div>
         
		<div class="row">
           <div class="col-sm-6">
               <?= $form->field($model, 'uploaded_for')->textInput() ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'access')->dropDownList(ArrayHelper::map(UsersType::find()->all(),'id','name'),  ['prompt'=>'Select from list']); ?>
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

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\UsersBlock;
use app\models\UsersLevel;
use app\models\UsersType;


/* @var $this yii\web\View */
/* @var $model app\models\UsersUnit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-unit-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'unit_name')->textInput(['maxlength' => true]) ?>
           </div>
         <div class="col-sm-6">
    			<?= $form->field($model, 'unit_block')->dropDownList(ArrayHelper::map(UsersBlock::find()->all(),'id','name'),  ['prompt'=>'Select from list']); ?>
         </div>
       </div>
       
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'unit_level')->dropDownList(ArrayHelper::map(UsersLevel::find()->all(),'id','level_name'),  ['prompt'=>'Select from list']); ?>
           </div>
           <div class="col-sm-6">
   				<?= $form->field($model, 'unit_type')->dropDownList(ArrayHelper::map(UsersType::find()->all(),'id','name'),  ['prompt'=>'Select from list']); ?>
           </div>
         </div>
         
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'bookable')->textInput() ?>
            </div>
             <div class="col-sm-6">
    			<?= $form->field($model, 'published')->dropDownList(['0' => 'InActive', '1' => 'Active']); ?>
             </div>
         </div>
      </div>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

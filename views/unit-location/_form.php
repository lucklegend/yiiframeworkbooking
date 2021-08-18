<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\UnitType;


/* @var $this yii\web\View */
/* @var $model app\models\UnitLocation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unit-location-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'id')->textInput() ?>
            </div>
            <div class="col-sm-6">
   				<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
             </div>
           </div>
             
 		<div class="row">
           <div class="col-sm-6">
   				 <?= $form->field($model, 'unit_type')->dropDownList(ArrayHelper::map(UnitType::find()->all(),'id','name'),  ['prompt'=>'Select from list']); ?>
            </div>
            <div class="col-sm-6">
    			 <?= $form->field($model, 'published')->dropDownList(['0' => 'InActive', '1' => 'Active']); ?>
            </div>
       </div>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

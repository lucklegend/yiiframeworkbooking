<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Assetcategories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="assetcategories-form">
 
    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive"> 
          <div class="row">
               <div class="col-sm-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'is_serviceable')->dropDownList(['0' => 'No', '1' => 'Yes']); ?>
                </div>
         </div>
     </div>
    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

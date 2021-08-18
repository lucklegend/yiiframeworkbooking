<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FbBookingGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fb-booking-group-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-6">
    			<?= $form->field($model, 'calendars')->textInput() ?>
             </div>
          </div>
          
          <div class="row">
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

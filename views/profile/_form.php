<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">
  <?php $form = ActiveForm::begin(); ?>
  <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>
  <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>
  <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
  <?= $form->field($model, 'contact_no')->textInput(['maxlength' => true]) ?>
  <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
  </div>
  <?php ActiveForm::end(); ?>
</div>

<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Useful */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="useful-form">
  <?php $form = ActiveForm::begin(); ?>
  <div class="row">
    <div class="col-xs-12 col-md-6">
      <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
      <?= $form->field($model, 'type')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\UsefulType::find()->orderBy(['name' => SORT_ASC])->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Type')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
      <?= $form->field($model, 'service')->textInput(['maxlength' => true]) ?>
      <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-xs-12 col-md-6">
      <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>
      <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
      <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
      <?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'Inactive' => 'Inactive', ], ['prompt' => '']) ?>
    </div>
  </div>
  <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
  </div>
  <?php ActiveForm::end(); ?>
</div>

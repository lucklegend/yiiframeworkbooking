<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\PagesType;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\PagesCategories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-categories-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-6">
    			<?= $form->field($model, 'type')->dropDownList(ArrayHelper::map(PagesType::find()->all(),'id','type'),  ['prompt'=>'Select from list']); ?>
            </div>
        </div>
         <div class="row">
            <div class="col-sm-6">
    			<?= $form->field($model, 'status')->textInput() ?>
            </div>
        </div>

      </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

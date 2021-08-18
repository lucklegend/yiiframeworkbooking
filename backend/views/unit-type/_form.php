<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UnitType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unit-type-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
      </div>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

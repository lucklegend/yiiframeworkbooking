<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FbBookingCancelReasons */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fb-booking-cancel-reasons-form">

    <?php $form = ActiveForm::begin(); ?>
              <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
         </div>
      </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

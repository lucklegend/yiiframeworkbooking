<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MailTemplate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mail-template-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'mail_for')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-6">
    			<?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>
             </div>
          </div>
          
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'attachment')->textInput(['maxlength' => true]) ?>
           </div>
        </div>

          <div class="row">
           <div class="col-sm-6">
  				<?= $form->field($model, 'updated_by')->textInput() ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'updated_on')->textInput() ?>
           </div>
        </div>
      </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

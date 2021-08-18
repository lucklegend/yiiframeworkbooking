<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Users;

/* @var $this yii\web\View */
/* @var $model app\models\UserEmail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-email-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(Users::find()->all(),'id','username'),  ['prompt'=>'Select from list']); ?>
            </div>
            <div class="col-sm-6">
    			<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            </div>
         </div>
            <div class="row">
               <div class="col-sm-6">		
                    <?= $form->field($model, 'token')->textInput(['maxlength' => true]) ?>
                </div>
             </div>
           </div>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

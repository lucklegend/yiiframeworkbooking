<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\UsersBlock;



/* @var $this yii\web\View */
/* @var $model app\models\UsersLevel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-level-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'id')->textInput() ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'level_name')->textInput(['maxlength' => true]) ?>
           </div>
        </div>
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'level_block')->dropDownList(ArrayHelper::map(UsersBlock::find()->all(),'id','name'),  ['prompt'=>'Select from list']); ?>
            </div>
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

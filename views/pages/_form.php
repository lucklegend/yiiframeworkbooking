<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-form">

    <?php $form = ActiveForm::begin(); ?>
          <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
           </div>
       </div>
       
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'category')->textInput() ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>
           </div>
        </div>
        
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'attachment')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-6">
   				<?= $form->field($model, 'type')->textInput() ?>
            </div>
        </div>
        
        <div class="row">
           <div class="col-sm-6">
   			 <?= $form->field($model, 'created_by')->textInput() ?>
           </div>
           <div class="col-sm-6">
    		<?= $form->field($model, 'created_on')->textInput() ?>
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

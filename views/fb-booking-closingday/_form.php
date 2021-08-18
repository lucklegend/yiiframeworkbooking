<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\FbBookingClosingday */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fb-booking-closingday-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-6">
   				 <?= $form->field($model, 'published')->dropDownList(['0' => 'InActive', '1' => 'Active']); ?>
            </div>
          </div>
          
        <div class="row">
           <div class="col-sm-6">
				<?php
            
            // usage without model
            echo '<label>Date From</label>';
            echo DatePicker::widget([
                'name' => 'date_from', 
                 'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'value' => date('d-M-Y'),
                'options' => ['placeholder' => 'Select date ...'],
                'pluginOptions' => [
                    'format' => 'dd-M-yyyy',
                    'todayHighlight' => true
                ]
            ]);
            echo "<br>";
            ?>
          </div>
          <div class="col-sm-6">
				<?php
            
            // usage without model
            echo '<label>Date To</label>';
            echo DatePicker::widget([
                'name' => 'date_to', 
                 'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'value' => date('d-M-Y'),
                'options' => ['placeholder' => 'Select date ...'],
                'pluginOptions' => [
                    'format' => 'dd-M-yyyy',
                    'todayHighlight' => true
                ]
            ]);
            echo "<br>";
            ?>
            </div>
         </div>
         
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'time_from')->textInput() ?>
            </div>
          <div class="col-sm-6">
    			<?= $form->field($model, 'time_to')->textInput() ?>
          </div>
        </div>
        
        <div class="row">
           <div class="col-sm-6">
                <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>
           </div>
        </div>
      </div>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

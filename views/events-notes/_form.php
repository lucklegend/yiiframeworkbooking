<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Events;
use app\models\Users;


/* @var $this yii\web\View */
/* @var $model app\models\EventsNotes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="events-notes-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'event_id')->dropDownList(ArrayHelper::map(Events::find()->all(),'id','title'),  ['prompt'=>'Select from list']); ?>
            </div>
            <div class="col-sm-6">
    			<?= $form->field($model, 'agenda')->textInput(['maxlength' => true]) ?>
            </div>
          </div>
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'minutes')->textarea(['rows' => 6]) ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'resolution')->textarea(['rows' => 6]) ?>
           </div>
        </div>
        
          <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'updated_by')->dropDownList(ArrayHelper::map(Users::find()->all(),'id','fname'),  ['prompt'=>'Select from list']); ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'updated_on')->textInput() ?>
            </div>
          </div>
  </div>
    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Events;
use common\models\Users;
use common\models\Profiles;


/* @var $this yii\web\View */
/* @var $model common\models\EventsNotes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="events-notes-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6" style="display:none">
    			<?= $form->field($model, 'event_id')->dropDownList($events,['options' =>[$id => ['selected' => true]]], array('disabled' => 'disabled')); ?>
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
           <div class="col-sm-6" style="display:none">
    			<?= $form->field($model, 'updated_by')->dropDownList(ArrayHelper::map(Profiles::find()->all(),'user_id','name'),  ['prompt'=>'Select from list']); ?>
           </div>
          </div>
  </div>
    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

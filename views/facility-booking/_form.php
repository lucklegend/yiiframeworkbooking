<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\FbBookingGroup;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\FbBookingBooked */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fb-booking-booked-form">

    <?php $form = ActiveForm::begin(); ?>
          <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($modelGro, 'name')->dropDownList(ArrayHelper::map(FbBookingGroup::find()->all(),'id','name'),  ['prompt'=>'Select from list']); ?>
            </div>
            <div class="col-sm-6">
    			<?= $form->field($modelFac, 'name')->textInput() ?>
            </div>
        </div>
        

    <div class="form-group">
        <?php //= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\FbBookingClosingday;
use common\models\FbBookingFacility;


/* @var $this yii\web\View */
/* @var $model common\models\FbBookingClosingdayFacility */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fb-booking-closingday-facility-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'closingday_id')->dropDownList(ArrayHelper::map(FbBookingClosingday::find()->all(),'id','title'),  ['prompt'=>'Select from list']); ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'facility_id')->dropDownList(ArrayHelper::map(FbBookingFacility::find()->all(),'id','name'),  ['prompt'=>'Select from list']); ?>
           </div>
         </div>
       </div>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

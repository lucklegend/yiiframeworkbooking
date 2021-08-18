<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use common\models\FbBookingPaymentMethod;
use common\models\Profiles;
use common\models\FbBookingStatus;
use common\models\FbBookingFacility;
use common\models\FbBookingPaymentStatus;
use kartik\datecontrol\DateControl;
/* @var $this yii\web\View */
/* @var $model common\models\FbBookingBooked */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fb-booking-booked-form">

    <?php $form = ActiveForm::begin(); ?>
	<div class="col-sm-12">
    			<?= $form->field($model, 'cancelled_reason')->textInput(['style' => 'width: 300px !important;'])->label('Cancel Reason'); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(
				'Back',
				['/fb-booking-booked/view', 'id' => $model->id],
				[  'class' => 'btn btn-primary']
			); ?>
  
    </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>

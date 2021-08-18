<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use common\models\FbBookingPaymentMethod;
use common\models\Profiles;
use common\models\Users;
use common\models\FbBookingStatus;
use common\models\FbBookingFacility;
use common\models\FbBookingGroup;
use common\models\FbBookingPaymentStatus;
use kartik\datecontrol\DateControl;
use yii\widgets\DetailView;
use vova07\imperavi\Widget as Imperavi;
use yii\helpers\Url; 
use kartik\select2\Select2; 

/* @var $this yii\web\View */
/* @var $model common\models\FbBarring */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fb-barring-form">

    <?php $form = ActiveForm::begin(); ?>
 
    <div class="box-body table-responsive">
    <div class="row">
           <div class="col-sm-6">
    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(Users::find()->all(),'id','username'),['prompt'=>'Select User']); ?>

            </div>
            <div class="col-sm-6">
   				
    <?= $form->field($model, 'facility_id')->dropDownList(ArrayHelper::map(FbBookingFacility::find()->all(),'id','name'),['prompt'=>'Select Facility']); ?>

            </div>
          </div>

          <div class="row">
           <div class="col-sm-6">
    			
           <?= $form->field($model, 'group_id')->dropDownList(ArrayHelper::map(FbBookingGroup::find()->all(),'id','name'),['prompt'=>'Select Group']); ?>

            </div>
            <div class="col-sm-6">
           
    <?= $form->field($model, 'last_book')->widget(DateControl::classname(), [
					'displayFormat' => 'php:d-M-Y',
					'type'=>DateControl::FORMAT_DATE,
					//'saveOptions' => 'php:Y-m-d',
				]);
            ?>
            </div>
          </div>

          <div class="row"> 
            <div class="col-sm-6">
            <?= $form->field($model, 'expiry')->widget(DateControl::classname(), [
					'displayFormat' => 'php:d-M-Y',
					'type'=>DateControl::FORMAT_DATE,
					//'saveOptions' => 'php:Y-m-d',
				]);
            ?>
            </div>
          </div>

    </div>

  

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use common\models\Users;
use kartik\file\FileInput;

use common\models\Contacts;
use common\models\ContactsType;

/* @var $this yii\web\View */
/* @var $model app\models\Contacts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="box-body table-responsive">
        
         <div class="row">
          
           <div class="col-sm-6">
                <?= $form->field($model, 'cname')->textInput(['maxlength' => true]) ?>
           </div>
           <div class="col-sm-6">
           		<?= $form->field($model, 'type')->dropDownList(ArrayHelper::map(ContactsType::find()->all(),'id','name'),  ['prompt'=>'Select from list']); ?>
           </div>
        </div>
        
        <div class="row">
           <div class="col-sm-6">
               <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
           </div>
           <div class="col-sm-6">
              <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
           </div>
        </div>
        
       <div class="row">
           <div class="col-sm-6">
               <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>
           </div>
           <div class="col-sm-6">
               <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
           </div>
       </div>
       <div class="row">
           <div class="col-sm-6">
               <?= $form->field($model, 'zip')->textInput() ?>
           </div>
           <div class="col-sm-6">
             <?= $form->field($model, 'bank_account_name')->textInput(['maxlength' => true]) ?>
           </div>
       </div>
       
    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

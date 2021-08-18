<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\ContactsType;
use kartik\date\DatePicker;
use common\models\Users;
use common\models\Profiles;
use kartik\file\FileInput;
use kartik\datecontrol\DateControl;
use vova07\fileapi\Widget;
use vova07\users\Module;
use vova07\imperavi\Widget as Imperavi;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Contacts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' =>   'multipart/form-data']]); ?>
<div class="box-body table-responsive">
<div class="row">

           <div class="col-sm-6">
                <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>
           </div> 
           <div class="col-sm-6">
           		<?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>
           </div>
        </div>
        <div class="row">

<div class="col-sm-6">
     <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
</div> 
<div class="col-sm-6"> 
<?= $form->field($model, 'bank_account_no')->textInput(['maxlength' => true]) ?>
      
</div>
</div>
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
               <?= $form->field($model, 'zip')->textInput() ?>
           </div>
       </div>
       <div class="row">
           
           <div class="col-sm-6">
             <?= $form->field($model, 'bank_account_name')->textInput(['maxlength' => true]) ?>
           </div>
       </div>
       
         <div class="box-footer">
          
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		<?php  if($model->isNewRecord) { ?>
		<?= Html::a('Cancel', ['/contacts/index'], ['class'=>'btn btn-danger']) ?>
		<?php } else { 
		 echo Html::a('Cancel', ['/contacts/view','id'=>$model->id], ['class'=>'btn btn-danger']); 
		}		?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

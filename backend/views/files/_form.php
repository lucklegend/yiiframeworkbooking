<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\FilesType;
use common\models\FilesCategory;
use common\models\Users;
use common\models\Profiles;
use common\models\UsersType;
use kartik\file\FileInput;
use vova07\imperavi\Widget as Imperavi;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Files */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="files-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
   			 	<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'file_name')->textInput(['maxlength' => true]) ?>
           </div>
        </div>
        
		<div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'file_type')->dropDownList(ArrayHelper::map(FilesType::find()->all(),'id','name'),  ['prompt'=>'Select from list']); ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'file_icon')->widget(FileInput::classname(), ['options' => ['multiple' => true]]); ?>
           </div>
        </div>
        
		<div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'category')->dropDownList(ArrayHelper::map(FilesCategory::find()->all(),'id','name'),  ['prompt'=>'Select from list']); ?>
            </div>
          <div class="col-sm-6">
    			<?= $form->field($model, 'uploaded_by')->dropDownList(ArrayHelper::map(Profiles::find()->all(),'user_id','name'),  ['prompt'=>'Select from list']); ?>
           </div>
         </div>
         
		<div class="row">
           <div class="col-sm-6">
               <?= $form->field($model, 'uploaded_for')->textInput() ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'access')->dropDownList(ArrayHelper::map(UsersType::find()->all(),'id','name'),  ['prompt'=>'Select from list']); ?>
           </div>
       </div>
       
      <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'published')->dropDownList(['0' => 'InActive', '1' => 'Active']); ?>
            </div>
            <div class="col-sm-6">
              <?= $form->field($model, 'notes')->widget(
                Imperavi::className(),
                [
                    'settings' => [
                        'minHeight' => 300,
                        'imageGetJson' => Url::to(['/files/imperavi-get']),
                        'imageUpload' => Url::to(['/files/imperavi-image-upload']),
                        'fileUpload' => Url::to(['/files/imperavi-file-upload'])
                    ]
                ]
            ) ?>
            </div>
      </div>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
		<?php  if($model->isNewRecord) { ?>
		<?= Html::a('Cancel', ['/files/index'], ['class'=>'btn btn-danger']) ?>
		<?php } else { 
		 echo Html::a('Cancel', ['/files/view','id'=>$model->id], ['class'=>'btn btn-danger']); 
		}		?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

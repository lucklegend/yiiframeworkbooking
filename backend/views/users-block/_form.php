<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget as Imperavi;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\UsersBlock */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-block-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
           </div>
            <div class="col-sm-6">
    			 <?= $form->field($model, 'description')->widget(
                Imperavi::className(),
                [
                    'settings' => [
                        'minHeight' => 300,
                        'imageGetJson' => Url::to(['/users-block/imperavi-get']),
                        'imageUpload' => Url::to(['/users-block/imperavi-image-upload']),
                        'fileUpload' => Url::to(['/users-block/imperavi-file-upload'])
                    ]
                ]
            ) ?>
             </div>
        </div>
		<div class="row">
           <div class="col-sm-6">
   			 <?= $form->field($model, 'published')->dropDownList(['0' => 'InActive', '1' => 'Active']); ?>
           </div>
        </div>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
		<?php  if($model->isNewRecord) { ?>
		<?= Html::a('Cancel', ['/users-block/index'], ['class'=>'btn btn-danger']) ?>
		<?php } else { 
		 echo Html::a('Cancel', ['/users-block/view','id'=>$model->id], ['class'=>'btn btn-danger']); 
		}		?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Profiles;
use vova07\fileapi\Widget;
use vova07\users\Module;
use vova07\imperavi\Widget as Imperavi;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\MailTemplate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mail-template-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'mail_for')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-6">
    			<?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>
             </div>
          </div>
          
        <div class="row">
           <div class="col-sm-6">
                           <?= $form->field($model, 'attachment')->widget(Widget::className(),
                [
                    'settings' => [
                        'url' => ['fileapi-upload']
                    ],
                  //  'crop' => true,
                  //  'cropResizeWidth' => 100,
                   // 'cropResizeHeight' => 100
                ]
            ) ?>
            </div>

           <div class="col-sm-6">
    			<?= $form->field($model, 'updated_by')->dropDownList(ArrayHelper::map(Profiles::find()->all(),'user_id','name'),  ['prompt'=>'Select from list']); ?>
           </div>
        </div>

          <div class="row">
           <div class="col-sm-6">
                <?= $form->field($model, 'message')->widget(
                Imperavi::className(),
                [
                    'settings' => [
                        'minHeight' => 300,
                        'imageGetJson' => Url::to(['/mail-template/imperavi-get']),
                        'imageUpload' => Url::to(['/mail-template/imperavi-image-upload']),
                        'fileUpload' => Url::to(['/mail-template/imperavi-file-upload'])
                    ]
                ]
            ) ?>

           </div>
        </div>
        
      </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		<?php  if($model->isNewRecord) { ?>
		<?= Html::a('Cancel', ['/mail-template/index'], ['class'=>'btn btn-danger']) ?>
		<?php } else { 
		 echo Html::a('Cancel', ['/mail-template/view','id'=>$model->id], ['class'=>'btn btn-danger']); 
		}		?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

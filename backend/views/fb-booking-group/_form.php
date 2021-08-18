<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Gallery;
use kartik\file\FileInput;
use vova07\fileapi\Widget;
use vova07\users\Module;
use vova07\imperavi\Widget as Imperavi;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\FbBookingGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fb-booking-group-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' =>   'multipart/form-data']]); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-6">
    			<?= $form->field($model, 'calendars')->dropDownList(['0' => 'Day Calendar', '1' => 'Week Calendar', '2' => 'Month Calendar'], ['prompt'=>'Select...']); ?>
             </div>
          </div>
          
           <div class="row">
               <div class="col-sm-6">
                           <?= $form->field($model, 'image')->widget(Widget::className(),
                [
                    'settings' => [
                        'url' => ['fileapi-upload']
                    ],
                  //  'crop' => true,
                  //  'cropResizeWidth' => 100,
                   // 'cropResizeHeight' => 100
                ]
            ) ?>
                        <?php if($model->image){ ?>
           <?php //= Html::img('../statics/web/users/avatars/'.$profile->avatar_url);?> 
            <img src="../statics/web/groups/<?php echo $model->image; ?>" width="100" height="100"  />
            <?php }?>

               </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'album_id')->dropDownList(ArrayHelper::map(Gallery::find()->all(),'id','name'),  ['prompt'=>'Select from list']); ?>
               </div>
           </div>
           
           <div class="row">
               <div class="col-sm-6">
                    <?= $form->field($model, 'bookable')->dropDownList(['0' => 'No', '1' => 'Yes']); ?>
               </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'published')->dropDownList(['0' => 'InActive', '1' => 'Active']); ?>
               </div>
           </div>
        
          <div class="row">
           <div class="col-sm-6">
                <?= $form->field($model, 'description')->widget(
                Imperavi::className(),
                [
                    'settings' => [
                        'minHeight' => 300,
                        'imageGetJson' => Url::to(['/fb-booking-closingday/imperavi-get']),
                        'imageUpload' => Url::to(['/fb-booking-closingday/imperavi-image-upload']),
                        'fileUpload' => Url::to(['/fb-booking-closingday/imperavi-file-upload'])
                    ]
                ]
            ) ?>
            </div>
           </div>
         </div>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
		<?= Html::a('Cancel', ['/fb-booking-group/view','id'=>$model->id], ['class'=>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

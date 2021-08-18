<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\EventsCategory;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use kartik\datecontrol\DateControl;
use common\models\Gallery;
use vova07\fileapi\Widget;
use vova07\users\Module;
use vova07\imperavi\Widget as Imperavi;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\Events */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="events-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' =>   'multipart/form-data']]); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'category')->dropDownList(ArrayHelper::map(EventsCategory::find()->all(),'id','name'),  ['prompt'=>'Select from list']); ?>
           </div>
         </div>
         
        <div class="row">
           <div class="col-sm-6">
        	<?php
		echo $form->field($model, 'start_date')->widget(DateControl::classname(), [
					'displayFormat' => 'php:d-M-Y',
					'type'=>DateControl::FORMAT_DATE,
					//'saveOptions' => 'php:Y-m-d',
				]);
        ?>
          </div>
          <div class="col-sm-6">
    	<?php
		echo $form->field($model, 'end_date')->widget(DateControl::classname(), [
					'displayFormat' => 'php:d-M-Y',
					'type'=>DateControl::FORMAT_DATE,
					//'saveOptions' => 'php:Y-m-d',
				]);
        ?>
        </div>
       </div>
       
        <div class="row">
           <div class="col-sm-6">
                <?php
				echo $form->field($model, 'start_time')->widget(DateControl::classname(), [
					'displayFormat' => 'php:h:ia',
					'type'=>DateControl::FORMAT_TIME,
					//'saveOptions' => 'php:Y-m-d',
				]);
				?>
           </div>
           <div class="col-sm-6">
                <?php 
				echo $form->field($model, 'end_time')->widget(DateControl::classname(), [
					'displayFormat' => 'php:h:ia',
					'type'=>DateControl::FORMAT_TIME,
					//'saveOptions' => 'php:Y-m-d',
				]);
				?>
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
            <img src="../statics/web/events/<?php echo $model->image; ?>" width="100" height="100"  />
            <?php }?>

           </div>
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
                        <?php if($model->attachment){ ?>
           <?php //= Html::img('../statics/web/users/avatars/'.$profile->avatar_url);?> 
            <img src="../statics/web/events/<?php echo $model->attachment; ?>" width="100" height="100"  />
            <?php }?>

            </div>
      </div>
      
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>
           </div>
          <div class="col-sm-6">
    			<?= $form->field($model, 'album_id')->dropDownList(ArrayHelper::map(Gallery::find()->all(),'id','name'),  ['prompt'=>'Select from list']); ?>
           </div>
        </div>
        
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'album_url')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-6">
    			<?= $form->field($model, 'event_for')->textInput(['maxlength' => true]) ?>
            </div>
         </div>
         
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'status')->dropDownList(['0' => 'InActive', '1' => 'Active']); ?>
            </div>
          <!--  <div class="col-sm-6">
    			< //?= $form->field($model, 'publish')->textInput() ?>
            </div>-->
         <!--</div>-->
         
        <!--<div class="row">-->
           <div class="col-sm-6">
                 <?= $form->field($model, 'description')->widget(
                Imperavi::className(),
                [
                    'settings' => [
                        'minHeight' => 300,
                        'imageGetJson' => Url::to(['/events/imperavi-get']),
                        'imageUpload' => Url::to(['/events/imperavi-image-upload']),
                        'fileUpload' => Url::to(['/events/imperavi-file-upload'])
                    ]
                ]
            ) ?>
           </div>
       </div>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
		<?php  if($model->isNewRecord) { ?>
		<?= Html::a('Cancel', ['/events/index'], ['class'=>'btn btn-danger']) ?>
		<?php } else { 
		 echo Html::a('Cancel', ['/events/view','id'=>$model->id], ['class'=>'btn btn-danger']); 
		}		?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

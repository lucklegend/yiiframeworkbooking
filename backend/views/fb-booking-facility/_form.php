<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\FbBookingGroup;
use kartik\file\FileInput;
use common\models\FbBookingStatus;
use common\models\Gallery;
use vova07\fileapi\Widget;
use vova07\users\Module;
use vova07\imperavi\Widget as Imperavi;
use yii\helpers\Url;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model common\models\FbBookingFacility */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fb-booking-facility-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' =>   'multipart/form-data']]); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'name')->textInput(['maxlength' => '125']) ?>
            </div>
            <div class="col-sm-6">
    			<?= $form->field($model, 'group')->dropDownList(ArrayHelper::map(FbBookingGroup::find()->all(),'id','name'),  ['prompt'=>'Select from list']); ?>
            </div>
            </div>
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'bookday_start')->textInput(['placeholder' => "eg.7 represents booking starts from the 7th day onwards"]) ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'bookday_end')->textInput(['placeholder' => "eg. 7 means u can book up till the 7 days in advance only"]) ?>
           </div>
        </div>
            
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'cancel_date')->textInput(['placeholder' => "eg. 3 means you can cancel up to 3 days in advance of actual booking date"]) ?>
           </div>
          <div class="col-sm-6">
    			<?= $form->field($model, 'lapse_date')->textInput() ?>
           </div>
       </div>
       
      <div class="row">
          <div class="col-sm-6">
    			<?= $form->field($model, 'unit_time')->textInput() ?>
           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'rulestype')->dropDownList([ '0' => 'Group', '1' => 'Individual', '2' => 'Both', ], ['prompt' => 'Select Rules type']) ?>
           </div>
       </div>
       
     <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'slottype')->dropDownList([ '0' => 'Group', '1' => 'Individual'], ['prompt' => 'Select Slot type']) ?>
           </div>
           <div class="col-sm-6">
               <?= $form->field($model, 'group_share')->dropDownList([ '0' => 'No', '1' => 'Yes'], ['prompt' => 'Select Group Share']) ?>
           </div>
     </div>
     
     <div class="row">
           <div class="col-sm-6">
               	<?= $form->field($model, 'deposit')->textInput() ?>
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
            <img src="../statics/web/facility/<?php echo $model->attachment; ?>" width="100" height="100"  />
            <?php }?>

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
            <img src="../statics/web/facility/<?php echo $model->image; ?>" width="100" height="100"  />
            <?php }?>

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
               	<?= $form->field($model, 'published')->dropDownList(['0' => 'InActive', '1' => 'Active']); ?>
            </div>
      </div>
      
        <div class="row">
           <div class="col-sm-6">
              <?= $form->field($model, 'default_status')->dropDownList(ArrayHelper::map(FbBookingStatus::find()->all(),'id','title'),  ['prompt'=>'Select from list']); ?>
            </div>
           <div class="col-sm-6">
                       <?php 
                       
					  /* $days = array('0' => 'Sunday', '1' => 'Monday', '2' => 'Tuesday', '3' => 'Wednesday', '4' => 'Thursday', '5' => 'Friday', '6' => 'Saturday');
						echo $form->field($model, 'block_days')->widget(Select2::classname(), [
							'data' => $days,
							'language' => 'en',
							'options' => ['multiple' => true,'placeholder' => 'Select from list ...'],
                        ]); */
                        
                        echo $form->field($model, 'notes')->widget(
                            Imperavi::className(),
                            [
                                'settings' => [
                                    'minHeight' => 300,
                                    'imageGetJson' => Url::to(['/fb-booking-facility/imperavi-get']),
                                    'imageUpload' => Url::to(['/fb-booking-facility/imperavi-image-upload']),
                                    'fileUpload' => Url::to(['/fb-booking-facility/imperavi-file-upload'])
                                ]
                            ]
                                ); 



						?>
            </div>
       </div>
            
     
       <div class="row">
          <div class="col-sm-6">
    			<?= $form->field($model, 'b_facmon')->textInput(['type' => 'number']) ?>
           </div>
           <div class="col-sm-6">
                <?= $form->field($model, 'b_absent')->textInput(['type' => 'number']) ?>
          </div>
       </div>
       

       <div class="row">
          <div class="col-sm-6">
    			<?= $form->field($model, 'b_period')->textInput(['type' => 'number']) ?>
           </div>
           
       </div>


   </div>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
		<?= Html::a('Cancel', ['/fb-booking-facility/view','id'=>$model->id], ['class'=>'btn btn-danger']) ?>
		
		
    </div>

    <?php ActiveForm::end(); ?>

</div>

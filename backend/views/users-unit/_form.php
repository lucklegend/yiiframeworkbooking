<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\UsersBlock;
use common\models\UsersLevel;
use common\models\UnitType;
use vova07\fileapi\Widget;
use vova07\users\Module;
use kartik\datecontrol\DateControl;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\UsersUnit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-unit-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'unit_name')->textInput(['maxlength' => true]) ?>
           </div>
         <div class="col-sm-6">
    			<?= $form->field($model, 'unit_block')->dropDownList(ArrayHelper::map(UsersBlock::find()->all(),'id','name'),  ['prompt'=>'Select from list']); ?>
         </div>
       </div>
       
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'unit_level')->dropDownList(ArrayHelper::map(UsersLevel::find()->all(),'id','level_name'),  ['prompt'=>'Select from list']); ?>
           </div>
           <div class="col-sm-6">
   				<?= $form->field($model, 'unit_type')->dropDownList(ArrayHelper::map(UnitType::find()->all(),'id','name'),  ['prompt'=>'Select from list']); ?>
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
            <img src="../statics/web/unit/<?php echo $model->image; ?>" width="100" height="100"  />
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
            <img src="../statics/web/unit/<?php echo $model->attachment; ?>" width="100" height="100"  />
            <?php }?>

            </div>
         </div>
         
        <div class="row">
         <div class="col-sm-6">
                				<?php
			echo $form->field($model, 'date_handover')->widget(DateControl::classname(), [
					'displayFormat' => 'php:d-M-y h:ia',
					'type'=>DateControl::FORMAT_DATETIME,
					//'saveOptions' => 'php:Y-m-d',
				]);
			
            ?>

           </div>
           <div class="col-sm-6">
    			<?= $form->field($model, 'bookable')->dropDownList(['1' => 'Yes', '0' => 'No']); ?>
            </div>
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
		<?= Html::a('Cancel', ['/users-unit/index'], ['class'=>'btn btn-danger']) ?>
		<?php } else { 
		 echo Html::a('Cancel', ['/users-unit/view','id'=>$model->id], ['class'=>'btn btn-danger']); 
		}		?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

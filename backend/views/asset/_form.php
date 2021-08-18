<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\AssetCategories;
use yii\helpers\ArrayHelper;
use common\models\Users;
use common\models\Contacts;
use common\models\Profiles;
use common\models\UsersUnit;
use kartik\date\DatePicker;
use kartik\datecontrol\DateControl;
use vova07\imperavi\Widget as Imperavi;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Asset */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asset-form">
			<?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
           </div>
           <div class="col-sm-6">
            <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        
        <div class="row">
           <div class="col-sm-6">
            <?= $form->field($model, 'category')->dropDownList(ArrayHelper::map(AssetCategories::find()->all(),'id','name'),  ['prompt'=>'Select from list']); ?>
           </div>
           <div class="col-sm-6">
            <?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>
          </div>
        </div>
        
        <div class="row">
           <div class="col-sm-6">
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
           </div>
           <div class="col-sm-6">
            <?= $form->field($model, 'purchase_from')->textInput() ?>
          </div>
        </div>
        
        <div class="row">
           <div class="col-sm-6">
                    <?php
                
                /*// usage without model
                echo '<label>Purchase Date</label>';
                echo DatePicker::widget([
                    'name' => 'purchase_date', 
                     'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'value' => date('d-M-Y'),
                    'options' => ['placeholder' => 'Select date ...'],
                    'pluginOptions' => [
                        'format' => 'dd-M-yyyy',
                        'todayHighlight' => true
                    ]
                ]);
                echo "<br>";*/
				echo $form->field($model, 'purchase_date')->widget(DateControl::classname(), [
					'displayFormat' => 'php:d-M-Y',
					'type'=>DateControl::FORMAT_DATE,
					//'saveOptions' => 'php:Y-m-d',
				]);
                ?>
                
              </div>
              <div class="col-sm-6">
                <?php
				echo $form->field($model, 'warranty_end_date')->widget(DateControl::classname(), [
					'displayFormat' => 'php:d-M-Y',
					'type'=>DateControl::FORMAT_DATE,
					//'saveOptions' => 'php:Y-m-d',
				]);
                ?>
           </div>
        </div>
        
        <div class="row">
           <div class="col-sm-6">
            <?= $form->field($model, 'amc_by')->dropDownList(ArrayHelper::map(Contacts::find()->all(),'id','fname'),  ['prompt'=>'Select from list']);  ?>
         </div>
           <div class="col-sm-6">
             <?php
				echo $form->field($model, 'amc_start')->widget(DateControl::classname(), [
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
				echo $form->field($model, 'amc_end')->widget(DateControl::classname(), [
					'displayFormat' => 'php:d-M-Y',
					'type'=>DateControl::FORMAT_DATE,
					//'saveOptions' => 'php:Y-m-d',
				]);
                ?>
            </div>
           <div class="col-sm-6">
            <?= $form->field($model, 'user_unit')->dropDownList(ArrayHelper::map(UsersUnit::find()->all(),'id','unit_name'),  ['prompt'=>'Select from list']); ?>
          </div>
        </div>
        
        <div class="row">
           <div class="col-sm-6">
           <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(Profiles::find()->all(),'user_id','name'),  ['prompt'=>'Select from list']); ?>
            </div>
           <div class="col-sm-6">
            <?= $form->field($model, 'status')->dropDownList(['0' => 'InActive', '1' => 'Active']); ?>
        </div>
        </div>
        
        <div class="row">
           <div class="col-sm-6">
              <?= $form->field($model, 'notes')->widget(
                Imperavi::className(),
                [
                    'settings' => [
                        'minHeight' => 300,
                        'imageGetJson' => Url::to(['/asset/imperavi-get']),
                        'imageUpload' => Url::to(['/asset/imperavi-image-upload']),
                        'fileUpload' => Url::to(['/asset/imperavi-file-upload'])
                    ]
                ]
            ) ?>


        </div>
        </div>
        
      </div>
    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success btn-large']) ?>
		<?php  if($model->isNewRecord) { ?>
		<?= Html::a('Cancel', ['/asset/index'], ['class'=>'btn btn-danger']) ?>
		<?php } else { 
		 echo Html::a('Cancel', ['/asset/view','id'=>$model->id], ['class'=>'btn btn-danger']); 
		}		?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

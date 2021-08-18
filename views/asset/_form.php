<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\AssetCategories;
use yii\helpers\ArrayHelper;
use app\models\Users;
use app\models\Contacts;
use app\models\UsersUnit;
use kartik\date\DatePicker;



/* @var $this yii\web\View */
/* @var $model app\models\Asset */
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
                
                // usage without model
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
                echo "<br>";
                ?>
              </div>
              <div class="col-sm-6">
                <?php
                
                // usage without model
                echo '<label>Warranty End Date</label>';
                echo DatePicker::widget([
                    'name' => 'warranty_end_date', 
                     'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'value' => date('d-M-Y'),
                    'options' => ['placeholder' => 'Select date ...'],
                    'pluginOptions' => [
                        'format' => 'dd-M-yyyy',
                        'todayHighlight' => true
                    ]
                ]);
                echo "<br>";
                ?>
           </div>
        </div>
        
        <div class="row">
           <div class="col-sm-6">
            <?= $form->field($model, 'amc_by')->dropDownList(ArrayHelper::map(Contacts::find()->all(),'id','fname'),  ['prompt'=>'Select from list']);  ?>
         </div>
           <div class="col-sm-6">
             <?php
                
                // usage without model
                echo '<label>Amc Start</label>';
                echo DatePicker::widget([
                    'name' => 'amc_start', 
                     'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'value' => date('d-M-Y'),
                    'options' => ['placeholder' => 'Select date ...'],
                    'pluginOptions' => [
                        'format' => 'dd-M-yyyy',
                        'todayHighlight' => true
                    ]
                ]);
                echo "<br>";
                ?>
         </div>
        </div>
        
        <div class="row">
           <div class="col-sm-6">
             <?php
                
                // usage without model
                echo '<label>Amc End</label>';
                echo DatePicker::widget([
                    'name' => 'amc_end', 
                     'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'value' => date('d-M-Y'),
                    'options' => ['placeholder' => 'Select date ...'],
                    'pluginOptions' => [
                        'format' => 'dd-M-yyyy',
                        'todayHighlight' => true
                    ]
                ]);
                echo "<br>";
                ?>
            </div>
           <div class="col-sm-6">
            <?= $form->field($model, 'user_unit')->dropDownList(ArrayHelper::map(UsersUnit::find()->all(),'id','unit_name'),  ['prompt'=>'Select from list']); ?>
          </div>
        </div>
        
        <div class="row">
           <div class="col-sm-6">
           <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(Users::find()->all(),'id','fname'),  ['prompt'=>'Select from list']); ?>
            </div>
           <div class="col-sm-6">
            <?= $form->field($model, 'status')->dropDownList(['0' => 'InActive', '1' => 'Active']); ?>
        </div>
        </div>
        
        <div class="row">
           <div class="col-sm-6">
            <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>
        </div>
        </div>
        
      </div>
    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success btn-large']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

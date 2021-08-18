<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\PagesType;
/* @var $this yii\web\View */
/* @var $model common\models\PagesCategories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-categories-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-6">
    			<?= $form->field($model, 'type')->dropDownList(ArrayHelper::map(PagesType::find()->all(),'id','type'),  ['prompt'=>'Select from list']); ?>
            </div>
        </div>
         <div class="row">
            <div class="col-sm-6">
    			<?= $form->field($model, 'status')->dropDownList(['0' => 'InActive', '1' => 'Active']); ?>
            </div>
        </div>

      </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		<?php  if($model->isNewRecord) { ?>
		<?= Html::a('Cancel', ['/pages-categories/index'], ['class'=>'btn btn-danger']) ?>
		<?php } else { 
		 echo Html::a('Cancel', ['/pages-categories/view','id'=>$model->id], ['class'=>'btn btn-danger']); 
		}		?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

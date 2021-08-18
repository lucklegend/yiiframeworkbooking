<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\UsersBlock;



/* @var $this yii\web\View */
/* @var $model common\models\UsersLevel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-level-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'level_name')->textInput(['maxlength' => true]) ?>
           </div>
            <div class="col-sm-6">
    			<?= $form->field($model, 'level_block')->dropDownList(ArrayHelper::map(UsersBlock::find()->all(),'id','name'),  ['prompt'=>'Select from list']); ?>
            </div>

        </div>
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'published')->dropDownList(['0' => 'InActive', '1' => 'Active']); ?>
           </div>
        </div>
      </div>     

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
		<?php  if($model->isNewRecord) { ?>
			<?= Html::a('Cancel', ['/users-level/index'], ['class'=>'btn btn-danger']) ?>
		<?php } else { 
		 echo Html::a('Cancel', ['/users-level/view','id'=>$model->id], ['class'=>'btn btn-danger']); 
		}		?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

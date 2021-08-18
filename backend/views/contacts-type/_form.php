<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ContactsType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-type-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'name')->textInput() ?>
           </div>
           <div class="col-sm-6">
                <?= $form->field($model, 'published')->dropDownList(['0' => 'InActive', '1' => 'Active']); ?>
           </div>
        </div>
     </div>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
		<?php  if($model->isNewRecord) { ?>
		<?= Html::a('Cancel', ['/contacts-type/index'], ['class'=>'btn btn-danger']) ?>
		<?php } else { 
		 echo Html::a('Cancel', ['/contacts-type/view','id'=>$model->id], ['class'=>'btn btn-danger']); 
		}		?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

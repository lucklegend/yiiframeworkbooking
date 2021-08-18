<?php

/**
 * Update profile page view.
 *
 * @var \yii\web\View $this View
 * @var \yii\widgets\ActiveForm $form Form
 * @var \vova07\users\models\frontend\User $model Model
 */

//use vova07\fileapi\Widget;
//use vova07\users\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Update';
$this->params['breadcrumbs'] = ['User',$this->title];
$this->params['contentId'] = 'error'; ?>
<?php $form = ActiveForm::begin(); ?>

<fieldset class="registration-form">
  <?= $form->field($model, 'fname')->textInput() ?>
  <?= $form->field($model, 'lname')->textInput() ?>
  <?= $form->field($model, 'email')->textInput() ?>
  <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</fieldset>
<?php ActiveForm::end(); ?>

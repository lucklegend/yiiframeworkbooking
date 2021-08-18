<?php

/**
 * User form view.
 *
 * @var \yii\web\View $this View
 * @var \yii\widgets\ActiveForm $form Form
 * @var \vova07\users\models\backend\User $model Model
 * @var \vova07\users\models\Profile $profile Profile
 * @var array $roleArray Roles array
 * @var array $statusArray Statuses array
 * @var \vova07\themes\admin\widgets\Box $box Box widget instance
 */

use vova07\fileapi\Widget;
use vova07\users\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\UsersUnit;
use common\models\UsersType;
use yii\helpers\ArrayHelper;

?>
<?php $form = ActiveForm::begin(); ?>
<?php $box->beginBody(); ?>

 
  
<div class="row">
  <div class="col-sm-6">
    <?= $form->field($user, 'fname')->label('First Name'); ?>
  </div>
  <div class="col-sm-6">
    <?= $form->field($user, 'lname')->label('Last Name'); ?>
  </div>
</div>
<div class="row">
  <div class="col-sm-6">
    <?= $form->field($user, 'username') ?>
  </div>
  <div class="col-sm-6">
    <?= $form->field($user, 'email') ?>
  </div>
</div>
<div class="row">
  <div class="col-sm-6">
    <?= $form->field($user, 'password')->passwordInput() ?>
  </div>
  <div class="col-sm-6">
    <?= $form->field($user, 'repassword')->passwordInput() ?>
  </div>
</div>
<div class="row">
  <div class="col-sm-6">
    <?= $form->field($user, 'user_unit')->dropDownList(ArrayHelper::map(UsersUnit::find()->all(),'id','unit_name'),  ['prompt'=>'Select from list']) ?>
  </div>
  <div class="col-sm-6">
    <?=
            $form->field($user, 'status_id')->dropDownList(
                $statusArray,
                [
                    'prompt' => Module::t('users', 'BACKEND_PROMPT_STATUS')
                ]
            ) ?>
  </div>
</div>
<div class="row">
  <div class="col-sm-6"> 
    <?php $roleArray = ['user' => 'Resident' , 'admin' => 'Club' , 'superadmin' => 'Manager']; ?>
    <?=
            $form->field($user, 'role')->dropDownList(
                $roleArray,
                [
                    'prompt' => Module::t('users', 'BACKEND_PROMPT_ROLE')
                ]
            ) ?>
  </div>
  <div class="col-sm-6">
    
  </div>
</div>
<?php $box->endBody(); ?>
<?php $box->beginFooter(); ?>
<?= Html::submitButton(
    $user->isNewRecord ? Module::t('users', 'BACKEND_CREATE_SUBMIT') : Module::t('users', 'BACKEND_UPDATE_SUBMIT'),
    [
        'class' => $user->isNewRecord ? 'btn btn-primary btn-large' : 'btn btn-success btn-large'
    ]
) ?>
<?php $box->endFooter(); ?>
<?php ActiveForm::end(); ?>

<?php

/**
 * Password changing page view.
 *
 * @var \yii\web\View $this View
 * @var \vova07\users\models\frontend\User $model Model
 */

use vova07\users\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Module::t('users', 'FRONTEND_PASSWORD_CHANGE_TITLE');
$this->params['breadcrumbs'] = [
    Module::t('users', 'FRONTEND_SETTINGS_LABEL'),
    $this->title
];
//$this->params['contentId'] = 'error'; ?>
<div class="row"> 
    <div class="col-sm-9">
     <h3 class="box-title">Change Password</h3>
    <?php $form = ActiveForm::begin(
     /*   [
            'options' => [
                'class' => 'center'
              ]
        ]*/
    ); ?>
            <?= $form->field($model, 'oldpassword')->passwordInput(['placeholder' => $model->getAttributeLabel('oldpassword')])->label(false) ?>
            <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false) ?>
            <?= $form->field($model, 'repassword')->passwordInput(['placeholder' => $model->getAttributeLabel('repassword')])->label(false) ?>
            <?= Html::submitButton(
                Module::t('users', 'FRONTEND_PASSWORD_CHANGE_SUBMIT'),
                [
                    'class' => 'btn btn- pull-right'
                ]
            ) ?>
    <?php ActiveForm::end(); ?>
    </div>
</div>
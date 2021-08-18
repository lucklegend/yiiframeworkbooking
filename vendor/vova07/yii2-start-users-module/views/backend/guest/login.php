<?php

/**
 * Sign In page view.
 *
 * @var \yii\base\View $this View
 * @var \yii\widgets\ActiveForm $form Form
 * @var \vova07\users\models\LoginForm $model Model
 */

use vova07\users\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Module::t('users', 'BACKEND_LOGIN_TITLE'); ?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="container">
<div class="jumbotron1" style="margin-top:10%">
<div class="form-box" id="login-box" style="border:1px solid #e0e0e0">
    <div class="header"><?php echo Html::encode($this->title); ?></div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="body bg-gray">
        <?= $form->field($model, 'username')->textInput(['placeholder' => $model->getAttributeLabel('username')])->label(false) ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false) ?>
         <?php echo $errMsg; ?>
        <?php if (Yii::$app->params['enableCaptcha'] == 1) { ?><div class="g-recaptcha" data-sitekey="<?php echo Yii::$app->params['googleCaptchaKey'] ?>"></div><?php } ?>
        <?= $form->field($model, 'rememberMe')->checkbox() ?>
    </div>
    <div class="footer">
        <?= Html::submitButton(Module::t('users', 'BACKEND_LOGIN_SUBMIT'), ['class' => 'btn bg-olive-o btn-block']) ?>
        <p><?= Html::a(Module::t('users', 'BACKEND_LOGIN_RECOVERY'), ['recovery']) ?></p>
    </div>
    <?php ActiveForm::end(); ?>
</div>
</div>
</div>
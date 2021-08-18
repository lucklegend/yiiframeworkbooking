<?php

/**
 * Sign In page view.
 *
 * @var \yii\web\View $this View
 * @var \yii\widgets\ActiveForm $form Form
 * @var \vova07\users\models\LoginForm $model Model
 */

use vova07\users\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Module::t('users', 'FRONTEND_LOGIN_TITLE');
/*$this->params['breadcrumbs'] = [
    $this->title
];*/ ?>
<?php $form = ActiveForm::begin(
    [
        'options' => [
            'class' => 'center'
        ]
    ]
); ?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="container" id="login_form" >
    <div class="form-box check" id="login-box">
        <div class="header">Facility Login</div>
        <div class="body bg-gray">
            <?= $form->field($model, 'username')->textInput(['placeholder' => $model->getAttributeLabel('username')])->label(false) ?>
            <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false) ?>
            <?php echo $errMsg; ?>
            <?php if (Yii::$app->params['enableCaptcha'] == 1) { ?><div class="g-recaptcha" data-sitekey="<?php echo Yii::$app->params['googleCaptchaKey'] ?>"></div><?php } ?>
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
        </div>
        <div class="footer">
            <?= Html::submitButton(Module::t('users', 'FRONTEND_LOGIN_SUBMIT'), ['class' => 'btn bg-olive-o btn-block']) ?>
            
            <?php // Module::t('users', 'FRONTEND_LOGIN_OR') ?>
            <p><?= Html::a(Module::t('users', 'FRONTEND_LOGIN_RECOVERY'), ['recovery']) ?></p>
        </div>
        <?php ActiveForm::end(); ?>
        
    </div>
</div>
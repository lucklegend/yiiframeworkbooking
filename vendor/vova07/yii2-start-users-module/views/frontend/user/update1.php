<?php

/**
 * Update profile page view.
 *
 * @var \yii\web\View $this View
 * @var \yii\widgets\ActiveForm $form Form
 * @var \vova07\users\models\frontend\User $model Model
 */

use vova07\fileapi\Widget;
use vova07\users\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Module::t('users', 'FRONTEND_UPDATE_TITLE');
$this->params['breadcrumbs'] = [
    Module::t('users', 'FRONTEND_SETTINGS_LABEL'),
    $this->title
];
$this->params['contentId'] = 'error'; ?>
<?php $form = ActiveForm::begin(
    [
        'options' => [
            'class' => 'center'
        ]
    ]
); ?>
    <fieldset class="registration-form">
        <?= $form->field($model, 'name')->textInput(['placeholder' => $model->getAttributeLabel('name')])->label(
            false
        ) ?>
        <?= $form->field($model, 'surname')->textInput(['placeholder' => $model->getAttributeLabel('surname')])->label(
            false
        ) ?>
        <?=
        $form->field($model, 'avatar_url')->widget(
            Widget::className(),
            [
                'settings' => [
                    'url' => ['fileapi-upload']
                ],
                'crop' => true,
                'cropResizeWidth' => 100,
                'cropResizeHeight' => 100
            ]
        )->label(false) ?>
                <?php if($model->avatar_url !=''){ ?>
                <div class="row" style="margin-bottom:10px;">
                <img src="statics/web/users/avatars/<?php echo $model->avatar_url;?>" width="100" height="100" />
                </div>
       <?php } ?>

        <?= Html::submitButton(
            Module::t('users', 'FRONTEND_UPDATE_SUBMIT'),
            [
                'class' => 'btn btn-primary pull-right'
            ]
        ) ?>
    </fieldset>
<?php ActiveForm::end(); ?>
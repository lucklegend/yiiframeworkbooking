<?php

/**
 * Contacts page view.
 *
 * @var \yii\web\View $this View
 * @var \yii\widgets\ActiveForm $form Form
 * @var \frontend\modules\site\models\ContactForm $model Model
 */

use vova07\site\Module;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\sidenav\SideNav;

$this->title = Module::t('site', 'CONTACTS_TITLE');
$this->params['breadcrumbs'] = [
  $this->title
]; ?>

  
    <!-- <div class="col-sm-4" style="background-color:lavender;">
<?php
echo SideNav::widget([
  'type' => SideNav::TYPE_DEFAULT,
  'heading' => '',
  'items' => [
    
    [
      'label' => 'Users',
      'icon' => 'question-sign',
      'items' => [
        ['label' => 'Main Management', 'icon'=>'info-sign', 'url'=>'#'],
        ['label' => 'Change Password', 'icon'=>'phone', 'url'=>'#'],
      ],
    ],
  ],

]);?></div> -->
<div class="row">
    <div class="col-sm-6">
   <div class="page-title"></div>
    <h1>Management Office</h1>

<p>In order to provide a high standard of Management to the condominium, professional staff and contractors have been engaged to discharge the duties of the Management.</p>
<p>An Estate Management team on site, with the support from Knight Frank Property Asset Management Pte Ltd; consist of four office staff, General Manager, the Maintenance Executive, the Condominium Executive and the Admin/Resident Relations officer and four technicians. Each is given various duties and responsibilities in order to manage and maintain the “common property” within the Ardmore Park as well as answer queries and to provide prompt and efficient service.</p>
<p>The Management office is located at the clubhouse and is open from 0830 hours – 1730 hours on weekdays and from 0830 hours to 1230 hours on Saturdays. The office is close on Sundays and Public Holidays.</p>
<p>If you have any feedback or suggestions, please contact the site staff or write to:</p>
<P>13 Ardmore Park #01-01 Singapore 259961<br>
Tel: (65) 6733 0862, Fax: (65) 6733 0872<br>
Email: ardmorepark@ardmorepark.com.sg</P></div>

    <div class="col-sm-6">
<span class="line-h"></span> <br /><br />
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'subject') ?>
    <?= $form->field($model, 'body')->textArea(['rows' => 4])->label('Message Body') ?>
    <?= $form->field($model, 'verifyCode')->widget(
      Captcha::className(),
      [
        'captchaAction' => '/site/default/captcha',
        'options' => ['class' => 'form-control'],
        'template' => '<div class="row"><div class="col-sm-3">{image}</div>
        <div class="col-sm-6">{input}</div></div>',
      ]
    ); ?>
    <?= Html::submitButton(Module::t('site', 'CONTACTS_SUBMIT_BTN'), ['class' => 'btn btn-dark']) ?>
    <?php ActiveForm::end(); ?>
  </div>
</div>

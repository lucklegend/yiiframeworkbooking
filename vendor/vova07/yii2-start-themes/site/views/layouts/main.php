<?php
/**
 * Theme main layout.
 *
 * @var \yii\web\View $this View
 * @var string $content Content
 */

use vova07\themes\site\widgets\Alert;
use yii\widgets\Breadcrumbs;
use demogorgorn\sudoslider\Sudoslider;
use yii\bootstrap\Carousel;
use yii\helpers\Html;
use romkaChev\yii2\swiper\Swiper;
use vova07\users\Module;

use yii\widgets\ActiveForm;
use vova07\users\models\LoginForm;
use app\controllers\FacilitiesController; 

$model = new LoginForm();

$controller = Yii::$app->controller;
$default_controller = Yii::$app->defaultRoute;
$isHome = (($controller->id === $default_controller) && ($controller->action->id === $controller->defaultAction)) ? true : false;
$isHome = (($controller->id === 'facilities') && ($controller->action->id === 'index' || $controller->action->id === 'welcome')) ? true : false;

?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<?= $this->render('//layouts/head') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/img/favicon.ico" type="image/x-icon" />
</head>

<body class="mainCheck">
<?php $this->beginBody(); ?>
<header class="navbar navbar-inverse navbar-fixed-top wet-asphalt topnav" role="banner">
<!-- <header class="navbar navbar-inverse navbar-fixed-top wet-asphalt topnav" role="banner" style="background-image: url(img/top_bg1.gif);height: 88px;"> -->
  <div class="container" style="height: 80px;" >
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse"> <span class="sr-only">
      <?= Yii::t('vova07/themes/site', 'Toggle navigation') ?>
      </span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="https://ardmorepark.com.sg/site/">
      <?php //echo 'hi'; Yii::$app->name ?>
      <!-- LOGO -->
      <img class="img-responsive" id="hdimg"  src="img/ard-more-park-logo.png"> </a> </div>
    <div class="collapse navbar-collapse" id="navbar-collapse" >

      <?= $this->render('//layouts/top-menu') ?>
    </div>
  </div>
</header>

<!--/header-->

<?= Alert::widget(); ?>
<div class="container-in-container" style="background-color:#C8BC9B;">
  <section id="<?= isset($this->params['contentId']) ? $this->params['contentId'] : 'content' ?>" class="container" style="">
  <div class="row clearfix">
    <?php if ($isHome) { ?>
    <div class="col-md-12 column">
      <?php

//	 echo Carousel::widget(
//		['items' => [
//		['content' => '<img src="statics/web/images/newimg1.jpg" width="1140" height="300"/>',
//		'options' => ['interval' => '600']
//		],
//		['content' => '<img src="statics/web/images/newimg2.jpg" width="1140" height="300"/>',
//		'options' => ['interval' => '600']
//		],
//		['content' => '<img src="statics/web/images/newimg4.jpg" width="1140" height="300"/>',
//		'options' => ['interval' => '600']
//		],
//		['content' => '<img src="statics/web/images/newimg5.jpg" width="1140" height="300"/>',
//		'options' => ['interval' => '600']
//		],
//		['content' => '<img src="statics/web/images/newimg6.jpg" width="1140" height="300"/>',
//		'options' => ['interval' => '600']
//		],
//		]
//	  ]); c8bc9b

	  ?>
    </div>
    <!-- <div class="container-in-slideshow" style="background-color:#ffffff;">
      <div class="row">
        <div class="col-sm-12">
          <div class="slideshow-container">
            <div class="move_left"> <span class="subheading_color"></span> </div>
            <div class="mySlides">
              <h3>Slider 1</h3>
              <img src="statics/web/images/newimg1.jpg" width="" height=""/>
            </div>
            <div class="mySlides">
              <div class="numbertext"></div>
              <h3>Slider 2</h3>
              <img src="statics/web/images/newimg2.jpg" width="" height=""/>
            </div>
            <div class="mySlides">
              <div class="numbertext"></div>
              <h3>Slider 3</h3>
              <img src="statics/web/images/newimg4.jpg" width="1140" height="300"/>
            </div>
          </div>
          <br>
          <div style="text-align:center"> 
              <span class="dot" onclick="currentSlide(1)"></span> 
              <span class="dot" onclick="currentSlide(2)"></span> 
              <span class="dot" onclick="currentSlide(3)"></span> 
          </div>
        </div>
      </div>
    </div> -->
    <?php } ?>

  </div>
  <div class="row" id="content_div" style="background-color:#C8BC9B">
    <div class="col-sm-3 col-md-2" style="text-align:center;">
      <div  id="mobbor">
        <!--<div>
          <div colspan="3" id="mobcon" style="height:93px;background-image: url('img/lefttopbg.gif');background-repeat: repeat-y;background-size: 100% 90px;border-top: none;"> </div>
        </div>-->

        <?php 
                  if(Yii::$app->user->isGuest){
                  $form = ActiveForm::begin(
                      [
                        'action' => Yii::$app->urlManager->createUrl(['users/guest/login'])
                      ]
                  ); ?>
	<!-- 
        <input type="hidden" name="c" value="1">
        <div> <span width="116" align="left" valign="top" class="leftlogin1"> <img src="img/t/leftlogin.gif" width="37" height="13" vspace="10"> </span> </div>
        <div style="padding: 10px;">
          <?= $form->field($model, 'username')->textInput(['placeholder' =>'Username'])->label(false) ?>
        </div>
        <div style="padding: 10px;">
          <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false) ?>
        </div>

        <div> <span align="left" valign="top">
          <input type="checkbox" name="remember">
          Remember me </span> </div>
        <div class="footer" style="padding: 10px;">
          <?= Html::submitButton(Module::t('users', 'FRONTEND_LOGIN_SUBMIT'), ['class' => 'btn bg-olive-o btn-block']) ?>
        </div>
        <?php ActiveForm::end(); ?>
      -->

        <!-- <div id="mobcon"> <span colspan="3" height="3" class="leftdecline" style="text-align:center;font-size: 12px;FONT-FAMILY: arial, helvetica, sans-serif;"><br>
          <br>
          The Management Corporation Strata Title Plan No. 2645<br>
          <br>

          <strong>Ardmore Park</strong><br>
          <br>
          13 Ardmore Park #01-01<br>
          Singapore 259961<br>
          Tel: 6733 0862<br>
          Fax: 6733 0872 </span> </div> -->
        <?php }else{ ?>
        <?= $this->render('//layouts/sidebar') ?>
        <?php } ?>
      </div>
    </div>

    <?php
      $get = $_SERVER['REQUEST_URI'];
      echo '<script>console.log("'.$get.'");</script>';
      $siteURL = array(
        '/v5/index.php?r=users%2Fguest%2Flogin&1=%2Fuser%2Fsecurity%2Flogin',
        '/v5/index.php?r=users%2Fguest%2Flogin'
      );
      if(in_array($get, $siteURL)){
        $col = "col-sm-12 col-md-12 col";
      }else{
        $col = "col-sm-9 col-md-10 col";
      }
    ?>
    
    <div class="<?= $col ?>" style="min-height: 450px;">
      <?= $content ?>
    </div>
  </div>

</div>
</section>
<!--/#error-->
</div>

<footer id="footer" class="midnight-blue" style="background-color: #3f1f01;">
  <div class="container" style="background:none">
    <!-- <div class="row">
      <div class="col-sm-6"> Copyright © <?php echo date("Y"); ?> <a href="https://www.axon.com.sg" target="_blank">Axon Consulting</a> Condominium. All rights reserved. </div>
      <div class="col-sm-6">
        <?//= $this->render('//layouts/top-menu', ['footer' => true]) ?>
        <ul class="pull-right">
          <?php 
            if(Yii::$app->user->identity->role != 'user' && !Yii::$app->user->isGuest){
          ?>

          <li><a href="<?php echo BACKEND.'/index.php?r' ?>">Administrator</a></li>
          <?php } ?>
          <li><a href="#">[Return to Top]</a></li>
        </ul>
      </div>
    </div> -->
    <div class="row">
      <div class="col-sm-5 footer-item">
        <img class="img-responsive" id="footerLogo" src="img/ard-more-park-logo.png" alt="footer logo">
        <p>
        Ardmore Park redefines modern luxury living with a stylish lavishness and exclusive address that is the definitive residence for the well established.
        </p>
      </div>
      <div class="col-sm-2 footer-item">
      <h4 class="text-link">CALL</h4>
        <ul>
          <li><a href="tel:+6567330862">Tel: 6733 0862</a></li>
          <li><a href="tel:+6567330872">Fax: 6733 0872</a></li>
        </ul>
      </div>
      <div class="col-sm-3 footer-item">
        <h4 class="text-link">WRITE</h4>
        <ul>
            <li><a href="mailto:ardmorepark@ardmorepark.com.sg">ardmorepark@ardmorepark.com.sg</a></li>
        </ul>
      </div>
      <div class="col-sm-2 footer-item">
      <h4 class="text-link">VISIT</h4>
        <ul>
            <li><span>13 Ardmore Park #01-01 Singapore 259961</span></li>
        </ul>
      </div>
    </div>
  </div>
</footer>

<!--/#footer-->



<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
<style>

.slideshow-container {
	max-width: 10000px;
}


@media (min-width: 768px) {
  .col-sm-2 {
    width: 16.666666666666664%;
  }
}

@media only screen and (max-width: 768px) {

  /* For mobile phones: */
    [class*="col-"] {
  width: 100%;
  }

}

</style>


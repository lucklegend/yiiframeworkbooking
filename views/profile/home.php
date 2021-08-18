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

$controller = Yii::$app->controller;
$default_controller = Yii::$app->defaultRoute;
$isHome = (($controller->id === $default_controller) && ($controller->action->id === $controller->defaultAction)) ? true : false;
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<?= $this->render('//layouts/head') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php $this->beginBody(); ?>
<div class="row">
    <div class="col-sm-2">
      <div class="" style="border: 1px solid black;border-radius: 15px;">
      <div valign="top">
        <div height="93" colspan="3" class="lefttop" style="background-image: url(img/lefttopbg.gif);height: 93px;width: 152px;">&nbsp; </div>
      </div>
      <form name="form1" method="post" action="" onsubmit="return validate()">
        <input type="hidden" name="c" value="1">
        <div> <span width="116" align="left" valign="top" class="leftlogin1"><img src="img/t/leftlogin.gif" width="37" height="13" vspace="10"></span> </div>
        <div> <span align="left" valign="top"> User ID: <br>
          <input name="szID" type="text" id="szID" size="14" maxlength="20" accesskey="u" style="width:8em;">
          </span> </div>
        <div> <span align="left" valign="top">Password:<br>
          <input name="szPassword" type="password" id="szPassword" size="15" maxlength="20" accesskey="p" style="width:8em;">
          </span> </div>
        <div> <span align="left" valign="top">
          <input type="checkbox" name="remember">
          Remember me</span> </div>
        <div> <span align="center" valign="top"> <a href="index.php?r=facilities%2Findex">
          <input type="image" src="img/but_leftlogin_1.gif" onmouseover="this.src='img/but_leftlogin_2.gif'" onmouseout="this.src='img/but_leftlogin_1.gif'">
          </a> </span> </div>
        <div> <span colspan="3" height="3" class="leftdecline" style="text-align:center;font-size: 12px;FONT-FAMILY: arial, helvetica, sans-serif;"><br>
          <br>
          The Management Corporation Strata Title Plan No. 2645<br>
          <br>
          <strong>Ardmore Park</strong><br>
          <br>
          13 Ardmore Park #01-01<br>
          Singapore 259961<br>
          <br>
          Tel: 6733 0862<br>
          Fax: 6733 0872 </span> </div>
        </div>
      </form>
    </div>
    <div class="col-sm-10">
      <?= $content ?>
    </div>
  </div>
  <?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
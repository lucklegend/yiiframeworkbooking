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

    <header class="navbar navbar-inverse navbar-fixed-top wet-asphalt" role="banner" style=" background-color: #3f1f01;">
        <div class="container" style="background-color:#3f1f01" >
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only"><?= Yii::t('vova07/themes/site', 'Toggle navigation') ?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= Yii::$app->homeUrl ?>">
                    <?php //echo 'hi'; Yii::$app->name ?> <img class="img-responsive" src="img/sub_logo.gif">
                </a>
            </div>
            <div class="collapse navbar-collapse">
                <?= $this->render('//layouts/top-menu') ?>
            </div>
        </div>
    </header> 
     <!-- <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>:: Welcome to Ardmore Park Condominium Website</title>
<link rel="stylesheet" type="text/css" href="css/textset.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="122" valign="top" background="img/top_bg.gif"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="57%" height="88" align="left" valign="top"><img src="img/sub_logo.gif" width="428" height="46" hspace="10" vspace="10"></td>
        <td width="37%" align="right" valign="top"><a href="index.php?r=facilities%2Findex<? if (isset($_GET['crypted'])) echo "?crypted=" . $_GET['crypted']; ?>"><img src="img/but_hm.gif" width="23" height="26" vspace="12" border="0"></a></td>
        <td width="6%" align="center" valign="top"><a href="fb-booking-group%2Fsite<? if (isset($_GET['crypted'])) echo "?crypted=" . $_GET['crypted']; ?>"><img src="img/but_sitemap.gif" width="35" height="28" vspace="12" border="0"></a></td>
      </tr>
        </table>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
          <td align="center" valign="middle"><a href="mem/profile.php<? if (isset($_GET['crypted'])) echo "?crypted=" . $_GET['crypted']; ?>"><img src="img/but_profile_1.gif" onMouseOver="this.src='img/but_profile_2.gif'" onMouseOut="this.src='img/but_profile_1.gif'" alt="My Profile" title="My Profile" width="85" height="22" border="0"></a></td>
        <td align="center" valign="middle"><img src="img/top_hrline.gif" width="3" height="24"></td>
        <td align="center" valign="middle"><a href="index.php?r=facilities%2Ffacilities<? if (isset($_GET['crypted'])) { echo "?crypted=" . $_GET['crypted']; ?>&page=book_now&user_id=<? echo $_SESSION['basic_is_logged_in']; } ?>"><img src="img/but_online_1.gif" onMouseOver="this.src='img/but_online_2.gif'" onMouseOut="this.src='img/but_online_1.gif'" alt="Online Facility Booking" title="Online Facility Booking" width="111" height="22" border="0"></a></td>
         <td align="center" valign="middle"><img src="img/top_hrline.gif" width="3" height="24"></td>
         <td align="center" valign="middle"><a href="mem/community.php<? if (isset($_GET['crypted'])) echo "?crypted=" . $_GET['crypted']; ?>"><img src="img/but_community_1.gif" onMouseOver="this.src='img/but_community_2.gif'" onMouseOut="this.src='img/but_community_1.gif'" alt="Community News" title="Community News" width="111" height="22" border="0"></a></td> 
        <td align="center" valign="middle"><img src="img/top_hrline.gif" width="3" height="24"></td>
         <td align="center" valign="middle"><a href="gettingthere.php<? if (isset($_GET['crypted'])) echo "?crypted=" . $_GET['crypted']; ?>"><img src="img/but_useful_1.gif" onMouseOver="this.src='img/but_useful_2.gif'" onMouseOut="this.src='img/but_useful_1.gif'" alt="Useful Links" title="Useful Links" width="123" height="22" border="0"></a></td>
        <td align="center" valign="middle"><img src="img/top_hrline.gif" width="3" height="24"></td>
        <td align="center" valign="middle"><a href="mem/forms.php<? if (isset($_GET['crypted'])) echo "?crypted=" . $_GET['crypted']; ?>"><img src="img/but_applform_1.gif" onMouseOver="this.src='img/but_applform_2.gif'" onMouseOut="this.src='img/but_applform_1.gif'" alt="Application Forms" title="Application Forms" width="127" height="22" border="0"></a></td>
        <td align="center" valign="middle"><img src="img/top_hrline.gif" width="3" height="24"></td>
         <td align="center" valign="middle"><a href="mem/bylaws.php<? if (isset($_GET['crypted'])) echo "?crypted=" . $_GET['crypted']; ?>"><img src="img/but_bylaws_1.gif" onMouseOver="this.src='img/but_bylaws_2.gif'" onMouseOut="this.src='img/but_bylaws_1.gif'" alt="By-laws" title="By-laws" width="83" height="22" border="0"></a></td>
        <td align="center" valign="middle"><img src="img/top_hrline.gif" width="3" height="24"></td>

                <td align="center" valign="middle">


<a href="index.php?r=site%2Fdefault%2Fcontacts<? if (isset($_GET['crypted'])) echo "?crypted=" . $_GET['crypted']; ?>"><img src="img/but_contact_1.gif" onMouseOver="this.src='img/but_contact_2.gif'" onMouseOut="this.src='img/but_contact_1.gif'" alt="Contact Us" title="Contact Us" width="88" height="22" border="0"></a></td>
        </tr>
    </table></td>
  </tr>
</table> -->
    <!--/header-->

    <?= Alert::widget(); ?>
<div class="container-in-container">
    <section id="<?= isset($this->params['contentId']) ? $this->params['contentId'] : 'content' ?>" class="container">
            <div class="row clearfix">
            <?php if ($isHome) { ?>
                <div class="col-md-12 column">
                    <?php echo Carousel::widget(
                    ['items' => [
                    ['content' => '<img src="statics/web/images/newimg1.jpg" width="1140" height="300"/>',
                    'options' => ['interval' => '600']
                    ],
                    ['content' => '<img src="statics/web/images/newimg2.jpg" width="1140" height="300"/>',
                    'options' => ['interval' => '600']
                    ],
					['content' => '<img src="statics/web/images/newimg4.jpg" width="1140" height="300"/>',
                    'options' => ['interval' => '600']
                    ],
                    ['content' => '<img src="statics/web/images/newimg5.jpg" width="1140" height="300"/>',
                    'options' => ['interval' => '600']
                    ],
                    ['content' => '<img src="statics/web/images/newimg6.jpg" width="1140" height="300"/>',
                    'options' => ['interval' => '600']
                    ],
                    ]
                    ]); ?>
               </div>
            <?php } ?>
           </div>
        <?= $content ?>
    </section>
    <!--/#error-->
</div>
    <footer id="footer" class="midnight-blue" style="background-color: #3f1f01;">
        <div class="container" style="background:none">
            <div class="row">
                <div class="col-sm-6">
                    Copyright © <?php echo date("Y"); ?> <a href="https://www.axon.com.sg" target="_blank">Axon Consulting</a> Condominium. All rights reserved.
                </div>
                <div class="col-sm-6">
                    <?//= $this->render('//layouts/top-menu', ['footer' => true]) ?>
                    <ul class="pull-right">
                     <li><a href="<?php echo BACKEND.'/index.php?r=users%2Fguest%2Flogin' ?>">Administrator</a></li>
                     <li><a href="#">[Return to Top]</a></li>
                    </ul>
                </div>
            </div>
        </div> 
        <!-- <link rel=stylesheet type="text/css" href="textset.css">
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" class="copyright2">
  <tr>
    <td align="left" style="padding-left:5px;">&copy; Copyright Ardmorepark. Managed by <a href="http://www.kfem.com.sg/" class="copy" target="new">Knight Frank Property Asset Management Pte Ltd formerly known as (“Knight Frank Estate Management Pte Ltd”)</a></td>
  </tr>
  <tr>
    <td align="left" style="padding-left:5px;">Powered by <a href="http://www.axon.com.sg" target="_blank">Axon Consulting</a></td>
  </tr>
</table> -->

</body>

<!-- Mirrored from www.ascengen.com/ardmorepark/home.jsp by HTTrack Website Copier/3.x [XR&CO'2006], Fri, 20 Jul 2007 08:00:03 GMT
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8"><!-- /Added by HTTrack -->
</html>
    </footer>
    <!--/#footer-->

    <?php $this->endBody(); ?>
    </body>
    </html>
<?php $this->endPage(); ?>
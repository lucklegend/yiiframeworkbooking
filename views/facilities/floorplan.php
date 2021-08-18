<?php

/**
 * Frontend main page view.
 *
 * @var yii\web\View $this View
 */
use romkaChev\yii2\swiper\Swiper;
use vova07\users\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\users\models\LoginForm;
 
$this->title = Yii::$app->name;
$this->params['noTitle'] = true; ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<div id="CONTENTAREA" class="intro_welcomemsg" style="padding:10px">
  <div class="move_left"> <span class="subheading_color"></span> </div>
  <div class="row">
    <div class="col-sm-12  col1" style="FONT-SIZE: 12px;">
      <div>
        <td align="left" valign="top" class="ctr"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="82" valign="bottom" class="ctrtop"><img src="img/t/residences.gif" width="274" height="26"><a name="residences"></a></td>
            </tr>
          </table>
          <table width="649"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td valign="top"><br>
                <img src="img/residences.gif" width="649" height="395">
                </td>
            </tr>
          </table>
          <img src="img/t/penthouses.gif" width="271" height="25"><a name="penthouses"></a>
          <table width="649"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td valign="top"><br>
                <img src="img/phupper.gif" width="649" height="395"><br>
                <br>
                <img src="img/phlower.gif" width="649" height="395">
                </td>
            </tr>
          </table></td>
      </div>
    </div>
  </div>
</div>

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

<div id="CONTENTAREA" class="intro_welcomemsg col1" style="padding:10px">
  <div class="row">
    <div class="col-sm-12">
      <img src="img/t/video.gif" width="204" height="39">
            <table width="649"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="560" valign="top"><iframe width="560" height="315" src="https://www.youtube.com/embed/YRPerdErOVw" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></td>
                <td width="273" background="img/video_bg2.gif"><table width="90%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><img src="img/video_title.gif" width="225" height="51" hspace="8"></td>
                    </tr>
                    <tr>
                      <td><a href="index.php?r=facilities/floorplan"><img src="img/video_red1.gif" width="217" height="26" hspace="8" vspace="4" border="0" onMouseOver="this.src='img/video_red2.gif'" onMouseOut="this.src='img/video_red1.gif'"></a></td>
                    </tr>
                    <tr>
                      <td><a href="index.php?r=facilities/floorplan#penthouses"><img src="img/video_pent1.gif" width="217" height="26" hspace="8" vspace="4" border="0" onMouseOver="this.src='img/video_pent2.gif'" onMouseOut="this.src='img/video_pent1.gif'"></a></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
    </div>
  </div>
</div>

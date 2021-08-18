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
              </tr>
            </table>
    </div>
  </div>
</div>

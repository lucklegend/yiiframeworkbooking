<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use vova07\themes\admin\widgets\Box;
use yii\grid\CheckboxColumn;


/* @var $this yii\web\View */
/* @var $searchModel app\models\FbBookingFacilitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Site Plan';
 
?>
<style>
@media only screen and (min-width: 1100px) {
.siteplan {
	position:absolute;
	width:333px;
	height:250px;
	z-index:2;
	visibility: hidden;
	top: 80px;
	/*right: 35px;*/
	left: 500px;
}
}
@media only screen and (max-width: 1099px) {
.siteplan {
	position:absolute;
	width:333px;
	height:250px;
	z-index:2;
	left: 25px;
	top: 480px;
	visibility: hidden;
}
}
</style>
<div class="intro_welcomemsg" style="margin-bottom: 390px !important;border: 1px solid #c09853;border-radius: 15px;background-color: #efe6d1;">
  <p><img src="statics/web/siteplan.gif"  style="margin-top: 10px;width: 300px;margin-left: 10px;" ></p>
  <p style="margin-left: 10px;"> <span class="copyright2">Click on the text of the picture to show the facilities picture.</span></p>
  <div> <img src="statics/web/smap.jpg"  id="locmap" border="0" usemap="#fac2" class="img-responsive"  /> </div>
  <map name="fac2">
    <area shape="rect" coords="116,142,213,157" href="javascript:void(0);" alt="North Function Room" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','show','koipond','','hide','multi','','hide','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')">
    <area shape="rect" coords="223,173,263,189" href="javascript:void(0);" alt="Swimming Pool" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','hide','koipond','','hide','multi','','hide','playarea','','hide','swim','','show','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')">
    <area shape="rect" coords="69,213,140,243" href="javascript:void(0);" alt="Multi-purpose Facility" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','hide','koipond','','hide','multi','','show','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')">
    <area shape="rect" coords="120,183,217,198" href="javascript:void(0);" alt="South Function Room" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','show','koipond','','hide','multi','','hide','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')">
    <area shape="rect" coords="375,168,426,199" href="javascript:void(0);" alt="Fitness Corner" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','show','gym','','hide','function','','hide','koipond','','hide','multi','','hide','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')">
    <area shape="rect" coords="283,124,354,148" href="javascript:void(0);" alt="Tennis Court" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','hide','koipond','','hide','multi','','hide','playarea','','hide','swim','','hide','tennis','','show','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')">
    <area shape="rect" coords="201,116,250,141" href="javascript:void(0);" alt="Koi Pond" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','hide','koipond','','show','multi','','hide','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')">
    <area shape="rect" coords="263,177,319,202" href="javascript:void(0);" alt="Children Pool" onClick="MM_showHideLayers('children','','show','clubhouse','','hide','fitness','','hide','gym','','hide','function','','hide','koipond','','hide','multi','','hide','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')">
    <area shape="rect" coords="103,160,169,174" href="javascript:void(0);" alt="Club House" onClick="MM_showHideLayers('children','','hide','clubhouse','','show','fitness','','hide','gym','','hide','function','','hide','koipond','','hide','multi','','hide','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')">
    <area shape="rect" coords="173,161,200,176" href="javascript:void(0);" alt="Gym" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','show','function','','hide','koipond','','hide','multi','','hide','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')">
    <area shape="rect" coords="144,78,214,105" href="javascript:void(0);" alt="Play Area" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','hide','koipond','','hide','multi','','hide','playarea','','show','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')">
    <area shape="rect" coords="212,247,283,266" href="javascript:void(0);" alt="Water Feature" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','hide','koipond','','hide','multi','','hide','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','show','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')">
    <area shape="rect" coords="214,157,280,174" href="javascript:void(0);" alt="Swimming Pool" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','hide','koipond','','hide','multi','','hide','playarea','','hide','swim','','show','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')">
    <area shape="rect" coords="172,57,237,72" href="javascript:void(0);" alt="Barbeque Pit" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','hide','koipond','','hide','multi','','hide','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','show')" />
  </map>
  <div style=" width:470px; background-color:#5B3617; height:170px; padding-top:30px">
  <table style="margin:auto" width="273"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><img src="img/video_title.gif" width="225" height="51" hspace="8"></td>
    </tr>
    <tr>
      <td><a href="index.php?r=facilities/floorplan"><img src="img/video_red1.gif" width="217" height="26" hspace="8" vspace="4" border="0" onMouseOver="this.src='img/video_red2.gif'" onMouseOut="this.src='img/video_red1.gif'"></a></td>
    </tr>
    <tr>
      <td><a href="index.php?r=facilities/floorplan#penthouses"><img src="img/video_pent1.gif" width="217" height="26" hspace="8" vspace="4" border="0" onMouseOver="this.src='img/video_pent2.gif'" onMouseOut="this.src='img/video_pent1.gif'"></a></td>
    </tr>
  </table></div>
  <script language="JavaScript" type="text/JavaScript">
 
 function MM_findObj(n, d) { //v4.01
   var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
	 d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
   if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
   for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
   if(!x && d.getElementById) x=d.getElementById(n); return x;
 }
 
 function MM_showHideLayers() { //v6.0
   var i,p,v,obj,args=MM_showHideLayers.arguments;
   for (i=0; i<(args.length-2); i+=3) if ((obj=MM_findObj(args[i]))!=null) { v=args[i+2];
	 if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
	 obj.visibility=v; }
 } 
   </script> 
</div>
<div class="siteplan" id="children" style=" background-image: url(img/fac/children.jpg); layer-background-image: url(img/fac/children.jpg); border: 1px none #000000;">
  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="right"><a href="javascript:void(0);" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','hide','koipond','','hide','multi','','hide','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')"><img src="img/fac/close.gif" width="58" height="24" hspace="1" vspace="1" border="0"></a></td>
    </tr>
  </table>
</div>
<div class="siteplan" id="clubhouse" style=" background-image: url(img/fac/clubhouse.jpg); layer-background-image: url(img/fac/clubhouse.jpg); border: 1px none #000000;">
  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="right"><a href="javascript:void(0);" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','hide','koipond','','hide','multi','','hide','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')"><img src="img/fac/close.gif" width="58" height="24" hspace="1" vspace="1" border="0"></a></td>
    </tr>
  </table>
</div>
<div class="siteplan" id="fitness" style=" background-image: url(img/fac/fitness.jpg); layer-background-image: url(img/fac/fitness.jpg); border: 1px none #000000;">
  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="right"><a href="javascript:void(0);" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','hide','koipond','','hide','multi','','hide','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')"><img src="img/fac/close.gif" width="58" height="24" hspace="1" vspace="1" border="0"></a></td>
    </tr>
  </table>
</div>
<div class="siteplan" id="gym" style=" background-image: url(img/fac/gym.jpg); layer-background-image: url(img/fac/gym.jpg); border: 1px none #000000;">
  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="right"><a href="javascript:void(0);" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','hide','koipond','','hide','multi','','hide','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')"><img src="img/fac/close.gif" width="58" height="24" hspace="1" vspace="1" border="0"></a></td>
    </tr>
  </table>
</div>
<div class="siteplan" id="function" style=" background-image: url(img/fac/function.jpg); layer-background-image: url(img/fac/function.jpg); border: 1px none #000000;">
  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="right"><a href="javascript:void(0);" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','hide','koipond','','hide','multi','','hide','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')"><img src="img/fac/close.gif" width="58" height="24" hspace="1" vspace="1" border="0"></a></td>
    </tr>
  </table>
</div>
<div class="siteplan" id="koipond" style=" background-image: url(img/fac/koi.jpg); layer-background-image: url(img/fac/koi.jpg); border: 1px none #000000;">
  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="right"><a href="javascript:void(0);" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','hide','koipond','','hide','multi','','hide','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')"><img src="img/fac/close.gif" width="58" height="24" hspace="1" vspace="1" border="0"></a></td>
    </tr>
  </table>
</div>
<div class="siteplan" id="multi" style=" background-image: url(img/fac/multi.jpg); layer-background-image: url(img/fac/multi.jpg); border: 1px none #000000;">
  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="right"><a href="javascript:void(0);" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','hide','koipond','','hide','multi','','hide','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')"><img src="img/fac/close.gif" width="58" height="24" hspace="1" vspace="1" border="0"></a></td>
    </tr>
  </table>
</div>
<div class="siteplan" id="playarea" style=" background-image: url(img/fac/playarea.jpg); layer-background-image: url(img/fac/playarea.jpg); border: 1px none #000000;">
  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="right"><a href="javascript:void(0);" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','hide','koipond','','hide','multi','','hide','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')"><img src="img/fac/close.gif" width="58" height="24" hspace="1" vspace="1" border="0"></a></td>
    </tr>
  </table>
</div>
<div class="siteplan" id="swim" style=" background-image: url(img/fac/swimming.jpg); layer-background-image: url(img/fac/swimming.jpg); border: 1px none #000000;">
  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="right"><a href="javascript:void(0);" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','hide','koipond','','hide','multi','','hide','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')"><img src="img/fac/close.gif" width="58" height="24" hspace="1" vspace="1" border="0"></a></td>
    </tr>
  </table>
</div>
<div class="siteplan" id="tennis" style=" background-image: url(img/fac/tennis.jpg); layer-background-image: url(img/fac/tennis.jpg); border: 1px none #000000;">
  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="right"><a href="javascript:void(0);" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','hide','koipond','','hide','multi','','hide','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')"><img src="img/fac/close.gif" width="58" height="24" hspace="1" vspace="1" border="0"></a></td>
    </tr>
  </table>
</div>
<div class="siteplan" id="waterfeature" style=" background-image: url(img/fac/water.jpg); layer-background-image: url(img/fac/water.jpg); border: 1px none #000000;">
  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="right"><a href="javascript:void(0);" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','hide','koipond','','hide','multi','','hide','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')"><img src="img/fac/close.gif" width="58" height="24" hspace="1" vspace="1" border="0"></a></td>
    </tr>
  </table>
</div>
<div class="siteplan" id="locfunction" style=" background-image: url(img/fac/loc_function.jpg); layer-background-image: url(img/fac/loc_function.jpg); border: 1px none #000000;">
  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="right"><a href="javascript:void(0);" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','hide','koipond','','hide','multi','','hide','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')"><img src="img/fac/close.gif" width="58" height="24" hspace="1" vspace="1" border="0"></a></td>
    </tr>
  </table>
</div>
<div class="siteplan" id="loctennis1" style=" background-image: url(img/fac/loc_tennis1.jpg); layer-background-image: url(img/fac/loc_tennis1.jpg); border: 1px none #000000;">
  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="right"><a href="javascript:void(0);" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','hide','koipond','','hide','multi','','hide','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')"><img src="img/fac/close.gif" width="58" height="24" hspace="1" vspace="1" border="0"></a></td>
    </tr>
  </table>
</div>
<div class="siteplan" id="loctennis2" style=" background-image: url(img/fac/loc_tennis2.jpg); layer-background-image: url(img/fac/loc_tennis2.jpg); border: 1px none #000000;">
  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="right"><a href="javascript:void(0);" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','hide','koipond','','hide','multi','','hide','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')"><img src="img/fac/close.gif" width="58" height="24" hspace="1" vspace="1" border="0"></a></td>
    </tr>
  </table>
</div>
<div class="siteplan" id="northfunction" style=" background-image: url(img/fac/loc_northfunction.jpg); layer-background-image: url(img/fac/loc_northfunction.jpg); border: 1px none #000000;">
  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="right"><a href="javascript:void(0);" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','hide','koipond','','hide','multi','','hide','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')"><img src="img/fac/close.gif" width="58" height="24" hspace="1" vspace="1" border="0"></a></td>
    </tr>
  </table>
</div>
<div class="siteplan" id="southfunction" style=" background-image: url(img/fac/loc_southfunction.jpg); layer-background-image: url(img/fac/loc_southfunction.jpg); border: 1px none #000000;">
  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="right"><a href="javascript:void(0);" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','hide','koipond','','hide','multi','','hide','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')"><img src="img/fac/close.gif" width="58" height="24" hspace="1" vspace="1" border="0"></a></td>
    </tr>
  </table>
</div>
<div class="siteplan" id="barbeque" style=" background-image: url(img/fac/barbeque.jpg); layer-background-image: url(img/fac/barbeque.jpg); border: 1px none #000000;">
  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="right"><a href="javascript:void(0);" onClick="MM_showHideLayers('children','','hide','clubhouse','','hide','fitness','','hide','gym','','hide','function','','hide','koipond','','hide','multi','','hide','playarea','','hide','swim','','hide','tennis','','hide','waterfeature','','hide','locfunction','','hide','loctennis1','','hide','loctennis2','','hide','northfunction','','hide','southfunction','','hide','barbeque','','hide')"><img src="img/fac/close.gif" width="58" height="24" hspace="1" vspace="1" border="0"></a></td>
    </tr>
  </table>
</div>

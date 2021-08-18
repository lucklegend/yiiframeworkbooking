<?php

$this->title = 'Notices';
?>


<style>

#box1 {
    box-sizing: border-box;
    width: 270px;
    height: 600px;
    padding: 10px;    
   	float: left;
	background: url(statics/web/subnavi-bg.png) no-repeat;
	
}

</style>
<div>
<div class="col-sm-4" id="box1">

</div>


<div class="col-sm-6">
<div id="CONTENTAREA" class="box-shadow">
<h3 class="MAKE_HEADERFONT2" id="PAGE_HEADER" style="padding:10px"> Notices </h3>
</div>
		<p> <strong> Welcome to LakeShore Condominium </strong></p>
	<p>	Published on <?php echo Yii::$app->formatter->asDate('now', 'long'); ?></p>
		<img src="backend/galleries/Welcome-Banner.jpg" width="100%">
</div>
<div class="col-sm-6">
<div id="CONTENTAREA" class="box-shadow">
<h3 class="MAKE_HEADERFONT2" id="PAGE_HEADER" style="padding:10px"> Circulars </h3>
</div>
		<p> <strong> Welcome to LakeShore Condominium </strong></p>
	<p>	Published on <?php echo Yii::$app->formatter->asDate('now', 'long'); ?></p>
		<img src="backend/galleries/Welcome-Banner.jpg" width="100%">
</div>
</div>
<?php 
if(!Yii::$app->user->isGuest){
?>
 
<nav class="navbar navbar-inverse sidebar navbar1" role="navigation" id="mobnav" style="background-color: white !important;">
 <div class="navbar-header" style="width:100%;">
		<button id="sidebarBtn" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>    
		<!--<img class="responsive" src="img/lefttopbg.gif" style="width: 100%;height: auto;">-->
		<div id="sidebarMenu" class="navbar-brand" > Resident's Menu</div>		
	</div>
	<div id = "welcomeSidebar" > Welcome  <?php echo \Yii::$app->user->identity->username;  ?></div>
  <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1" style="background-color: white !important; clear:both">
			<?php 
			if(Yii::$app->user->identity->role == 'user'){
			?>
				<?= $this->render('//layouts/sidebar-menu') ?>
			<?php } else{ ?>
				<?= $this->render('//layouts/sidebar-menu1') ?>
			<?php } ?>
				<div style="line-height:22px; text-align:center">
					<div>Axon Booking Ver 5.0</div>
					<div>Developed by</div>
					<div>Axon Consulting</div>
					<div>www.axon.com.sg</div>
					<div>Tel: +65 6344 9618</div>
					<div>Fax: +65 6344 9766</div>
					<div>e: info@axon.com.sg</div>
				</div>
		</div>
 </nav> 
<?php }  ?>
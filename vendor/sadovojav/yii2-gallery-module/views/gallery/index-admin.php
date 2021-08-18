<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use sadovojav\gallery\Module;
use yii\db\Query;
use yii\helpers\Url;

$this->title = 'Picture Gallery';
$this->params['breadcrumbs'] = [
    Module::t('default', 'GALLERIES')
];
//$baseUrl = 'http://' . $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
?>
<style >
.caption1{
  background: #8c6238;
    border: 1px SOLID #fff;
    padding: 5px;
    text-align: center;
    width: 107px;
}
.a1 {
    color: #fff;}
</style>
</style>
<div class="bkheader gallery-index">
  <div>
    <div class="page-title">
     <h2>Photo Gallery</h2>
      <span class="line-h"></span> </div>
	  <br/>
    <?php //print_r($dataProvider);
    foreach ($dataProvider as $model){?>
    <div class = "col-sm-4"  style="width:13.333333%;">
      <div class="thumbnail" style="border:none !important;background: none;">
        <?php
	   $query = new Query;
	     $query->select(['file'])
		   ->from('gallery_file')
		  ->where(['galleryId' => $model['id']]);
		  $command = $query->createCommand();
		  $image = $command->queryScalar();
		  
		 // echo $image;
		  if($image != ''){
	   ?>
        <a href="<?php echo Url::to(FRONTEND. '/index.php?r=gallery%2Fgallery%2Fgallery&id='.$model['id']);?>"> 
        <img src="<?php echo Url::to(BACKEND. '/galleries/'.$model['id'].'/'.$image);?>" alt="<?php echo $model['name'];?>" height="100" width="100"></a>
        <?php }?>
      </div>
      <div class="caption caption1" style="font-size: 15px;">
          <?= Html::a(Module::t('default', $model['name']), ['gallery', 'id' => $model['id']], [
                        'class' => 'a1'
					
                    ]); ?>
      </div>
    </div>
    <?php } ?>
  </div>
</div>

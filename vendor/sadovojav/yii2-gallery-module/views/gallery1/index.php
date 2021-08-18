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

<div class="bkheader gallery-index">
  <div class="row">
   

    <div class="page-title">
	
		 <h2 class="MAKE_HEADERFONT2" id="PAGE_HEADER">Gallery</h2>  
      <span class="line-h"></span> </div>
	  <br/>
	  
    <?php //print_r($dataProvider);
foreach ($dataProvider as $model){?>
    <div class = "col-sm-3">
      <div class="thumbnail" style="border: none !important;background-color: #ffffff00; !important">
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
        <a href="<?php echo Url::to(FRONTEND. '/index.php?r=gallery%2Fgallery%2Fgallery&id='.$model['id']);?>" class="btn btn-gallery btn-sm gall"> 
        <img src="<?php echo Url::to(BACKEND. '/galleries/'.$model['id'].'/'.$image);?>" alt="<?php echo $model['name'];?>" width="100" style="height: 100px"></a>
        <?php }?>
      </div>
      <div class="caption" style="margin-left: 17px;">
          <?= Html::a(Module::t('default', $model['name']), ['gallery', 'id' => $model['id']], [
                        'class' => ''
					
                    ]); ?>
      </div>
    </div>
    <?php } ?>
  </div>
</div>

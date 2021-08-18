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
    <?php //print_r($dataProvider);
foreach ($dataProvider as $model){?>
    <div class = "col-sm-4">
      <div class="thumbnail" style="border:none !important; background: none !important">
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
        <a href="<?php echo Url::to(BACKEND. '/index.php?r=gallery%2Fgallery%2Fgallery1&id='.$model['id']);?>" class="btn btn-gallery btn-sm gall"> 
        <img  class="img-responsive img-thumbnail" src="<?php echo Url::to(BACKEND. '/galleries/'.$model['id'].'/'.$image);?>" alt="<?php echo $model['name'];?>" height="100" width="100"></a>
        <?php }?>
      </div>
      <div class="caption">
          <?= Html::a(Module::t('default', $model['name']), ['gallery1', 'id' => $model['id']], [
                        'class' => ''
					
                    ]); ?>
      </div>
    </div>
    <?php } ?>
  </div>
</div>

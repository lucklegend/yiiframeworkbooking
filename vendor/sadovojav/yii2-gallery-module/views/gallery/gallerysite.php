<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use sadovojav\gallery\Module;
use yii\db\Query;
use yii\helpers\Url;

//print_r($images);
?>

<div class="gallery-view">
    <p>
        <?= Html::a('Back', ['/events/index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="page-header">
    <div id="w0">
<?php 
foreach($images as $image){
	
	$query = new Query;
	     $query->select(['name'])
		   ->from('gallery')
		  ->where(['id' => $image['galleryId']]);
		  $command = $query->createCommand();
		  $title = $command->queryScalar();
		  
$this->title = $title;
//echo $image['file'];
//$url = Url::to('@test/galleries/'.$image['galleryId'].'/'.$image['file']);
//echo $url;
 $items = [
 [
        'url' =>  Url::to('@test/galleries/'.$image['galleryId'].'/'.$image['file']),
        'src' =>  Url::to('@test/galleries/'.$image['galleryId'].'/'.$image['file']),
        'options' => array('title' => 'Camposanto monumentale (inside)')
		]
]; 
//print_r($items);

/*$items = [
        $item
];*/ 
}?>
<?php //= dosamigos\gallery\Gallery::widget(['items' => $items]); }?>

</div>
<?= \sadovojav\gallery\widgets\Gallery::widget([
    'galleryId' => $id
]); ?>
</div>
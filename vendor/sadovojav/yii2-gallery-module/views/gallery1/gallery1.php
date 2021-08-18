<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use sadovojav\gallery\Module;
use yii\db\Query;
use yii\helpers\Url;

//print_r($images);
?>
<?php 
	$query = new Query;
	     $query->select(['name'])
		   ->from('gallery')
		  ->where(['id' => $id]);
		  $command = $query->createCommand();
		  $title = $command->queryScalar();
		  
		$this->title = $title;
?>
<div class="bkheader gallery-view">
    <div class="page-title"> 
      <span class="line-h"></span> </div>

    <p>

    
		<?= Html::a('Back', ['/gallery/gallery/index1' ], ['class'=>'btn btn-info']) ?>
    </p>
    
      <?php //= dosamigos\gallery\Gallery::widget(['items' => $items]); }?>
    </div>
    <?= \sadovojav\gallery\widgets\Gallery::widget([
    'galleryId' => $id
]); ?>
</div>
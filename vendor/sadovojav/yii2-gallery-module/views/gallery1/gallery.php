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
      <?php  if(\Yii::$app->getUser()->identity->role != 'user'){?>
       <?= Html::a('Update', ['update', 'id' => $id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?> 
       <?php }  ?>
		<?= Html::a('Back', ['/gallery/gallery/index' ], ['class'=>'btn btn-info']) ?>
    </p>
    
      <?php //= dosamigos\gallery\Gallery::widget(['items' => $items]); }?>
 <div class="row">
	<div class="col-sm-8">
		<?= \sadovojav\gallery\widgets\Gallery::widget([
		'galleryId' => $id,
		
		]); ?>
	</div>
</div>
</div>

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
      <h2>Gallery - <?php echo $this->title; ?></h2>
      <span class="line-h"></span> 
    </div>

    
       <!-- <?= Html::a('Update', ['update', 'id' => $id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?> -->
    <button>
		  <?= Html::a('Back', ['/gallery/gallery/index' ]) ?>
    </button></br>
    
      <?php //= dosamigos\gallery\Gallery::widget(['items' => $items]); }?>
    </div> 
   
        <?= \sadovojav\gallery\widgets\Gallery::widget([
        'galleryId' => $id
        ]); ?> 
</div>
<style>
button{
  border: 1px solid black;
    padding: 3px;
    border-radius: 5px;
    margin: 10px;
    background-color: #8c6238;
}
button,a{
  color:white;
} 
</style>
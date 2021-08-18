<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UsersUnit */

$this->title = $model->unit_name;
$this->params['breadcrumbs'][] = ['label' => 'Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-unit-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
		<?= Html::a('Back', ['/users-unit/index' ], ['class'=>'btn btn-info']) ?>
    </p>
<div class="col-sm-6">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            'unit_name',
           // 'unit_block',
		   [
            'attribute' => 'unit_block',
			'value' => $model->block1->name,
			],
			[
            'attribute' => 'unit_level',
			'value' => $model->level1->level_name,
			],
            //'unit_level',
           // 'unit_type',
			[
            'attribute' => 'unit_type',
			'value' => $model->type1->name,
			],
			[
            'attribute' => 'date_handover',
			 'format' => ['date', 'php:d M Y h:ia']
			],
			[
            'attribute' => 'bookable',
			'value' => $model->bookable == 1 ? 'Yes' : 'No',
			],
            //'bookable',
            /*[
		    'attribute'=>'published',
			'value' => $model->published == 0 ? 'InActive' : 'Active'
			],*/
        ],
    ]) ?>
</div>
<div class="col-sm-6">
<?php if($model->image != '') { ?>
<a id="pop" class="lightbox" href="../statics/web/unit/<?php echo $model->image;?>" data-toggle="lightbox" data-gallery="multiimages">
<img class="img-responsive" src="../statics/web/unit/<?php echo $model->image;?>" width="300" height="300" /> </a>
<?php } ?>
</div>
</div>

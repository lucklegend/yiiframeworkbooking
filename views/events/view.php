<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Events */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row events-view">

    <div class="col-sm-9">

    <div class ="page-header">
   
       <h1 style="color:#8c704b">
          <?= $model->title; ?>
          <small  style="color:#8c704b"><? //= $model->event->name; ?></small>
       </h1>
        <br />
       <div class="img">
           <?php if ($model->image != ''){ ?>
           <img src="<?php echo 'statics/web/events/'.$model->image; ?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236">
            <?php } else{ echo ''; } ?>
        </div>
	</div>
    <br />
 

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
           // 'title',
			/*[
			'label' => 'Event Name',
            'attribute' => 'title',
			'value' => $model->title,
			],
            //'category',
			[
            'attribute' => 'category',
			'value' => $model->event->name,
			],*/
            //'start_date',
			[
			'label'=>'Date',
		  'attribute'=>'start_date',
			'value' => date('d M Y', strtotime($model->start_date)) == date('d M Y', strtotime($model->end_date)) ? date('d M Y', strtotime($model->start_date)) : date('d M Y', strtotime($model->start_date)) . " \n-\n " . date('d M Y', strtotime($model->end_date)),
			],
           // 'end_date',
			/*[
		    'attribute'=>'end_date',
			'format' => ['date', 'php:d M Y']
			],*/
            //'start_time',
			/*[
		    'attribute'=>'start_time',
			'format' => ['date', 'php:h:ia']
			],
            //'end_time',
			[
		    'attribute'=>'end_time',
			'format' => ['date', 'php:h:ia']
			],*/
			[
			'label'=>'Time',
		  'attribute'=>'start_time',
			'value' => date('h:ia', strtotime($model->start_time)) == date('h:ia', strtotime($model->end_time)) ? date('h:ia', strtotime($model->start_time)) . " \n-\n " . date('h:ia', strtotime($model->end_time)) :date('h:ia', strtotime($model->start_time)) . " \n-\n " . date('h:ia', strtotime($model->end_time)),
			],
           // 'description:ntext',
           /* 'attachment',
            'location',
            'album_id',
            'album_url:url',
            'event_for',
			 [
		    'attribute'=>'status',
			'value' => $model->status == 0 ? 'InActive' : 'Active'
			],*/
           // 'status',
            //'publish',
        ],
    ]) ?>
    <p><?php echo $model->description;?></p>
</div>
</div>

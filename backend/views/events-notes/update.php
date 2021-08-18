<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EventsNotes */

$this->title = 'Update Events Notes: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Events Notes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="events-notes-update">

    <?= $this->render('_form', [
        'model' => $model,
		'id' => $id, 
		'events' =>$events,
    ]) ?>

</div>

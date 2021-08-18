<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EventsCategory */

$this->title = 'Update Events Category: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Events Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="events-category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

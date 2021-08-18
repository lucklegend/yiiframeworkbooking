<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EventsCategory */

$this->title = 'Update Events Category: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Events Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="events-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

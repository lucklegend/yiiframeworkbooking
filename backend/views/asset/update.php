<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Asset */

$this->title = 'Update Asset: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Assets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="asset-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

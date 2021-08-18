<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UnitLocation */

$this->title = 'Update Unit Location: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Unit Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="unit-location-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

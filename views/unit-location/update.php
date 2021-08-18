<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UnitLocation */

$this->title = 'Update Unit Location: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Unit Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="unit-location-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

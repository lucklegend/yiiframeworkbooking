<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UnitType */

$this->title = 'Update Unit Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Unit Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="unit-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

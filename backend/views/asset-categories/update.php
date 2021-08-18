<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Assetcategories */

$this->title = 'Update Asset Categories: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Assetcategories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="assetcategories-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

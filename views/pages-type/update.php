<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PagesType */

$this->title = 'Update Type: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pages-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

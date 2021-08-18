<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PagesCategories */

$this->title = 'Update Categories: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pages-categories-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

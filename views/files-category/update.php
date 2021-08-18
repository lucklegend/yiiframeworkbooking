<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FilesCategory */

$this->title = 'Update Files Category: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Files Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="files-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

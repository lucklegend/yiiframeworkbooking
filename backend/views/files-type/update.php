<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FilesType */

$this->title = 'Update Files Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Files Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="files-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

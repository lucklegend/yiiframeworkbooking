<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UsersLevel */

$this->title = 'Update Level: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users-level-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

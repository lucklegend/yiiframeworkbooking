<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UsersUnit */

$this->title = 'Update Unit: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users-unit-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

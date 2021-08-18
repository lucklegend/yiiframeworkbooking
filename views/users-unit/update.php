<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UsersUnit */

$this->title = 'Update Users Unit: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users-unit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

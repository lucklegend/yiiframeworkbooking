<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UsersLevel */

$this->title = 'Update Users Level: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users-level-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

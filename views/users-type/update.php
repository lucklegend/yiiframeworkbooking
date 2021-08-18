<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UsersType */

$this->title = 'Update Users Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UsersBlock */

$this->title = 'Update Block: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Blocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users-block-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

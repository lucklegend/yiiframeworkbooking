<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UsersType */

$this->title = 'Update Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users-type-update">

    <?= $this->render('_form', [
        'model' => $model,
		
    ]) ?>

</div>

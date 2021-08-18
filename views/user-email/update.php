<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserEmail */

$this->title = 'Update User Email: ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'User Emails', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'user_id' => $model->user_id, 'token' => $model->token]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-email-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

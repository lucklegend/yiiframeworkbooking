<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MailTemplate */

$this->title = 'Update Mail Template: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mail Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mail-template-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

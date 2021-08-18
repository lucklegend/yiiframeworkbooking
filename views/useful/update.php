<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Useful */

$this->title = 'Update Useful: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Usefuls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="useful-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

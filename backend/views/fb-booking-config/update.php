<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FbBookingConfig */

$this->title = 'Update Configuration: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fb-booking-config-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

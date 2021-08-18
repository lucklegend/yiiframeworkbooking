<?php

use yii\helpers\Html;
use vova07\users\Module;

/* @var $this yii\web\View */
/* @var $model common\models\FbBookingGroup */

$this->title = 'Update Group: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fb-booking-group-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

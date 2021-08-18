<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\FbBookingConfig */

$this->title = $model->key;
$this->params['breadcrumbs'][] = ['label' => 'Fb Booking Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fb-booking-config-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            'key',
            'value:ntext',
        ],
    ]) ?>

</div>

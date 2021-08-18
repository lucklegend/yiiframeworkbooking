<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FbBookingFacility */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Fb Booking Facilities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fb-booking-facility-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'id',
            'name',
            'group',
            'bookday_start',
            'bookday_end',
            'cancel_date',
            'unit_time:datetime',
            'rulestype',
            'rulescondition',
            'deposit',
            'notes:ntext',
            'attachment',
            'image',
            'album_id',
            'album_url:url',
            'published',
        ],
    ]) ?>

</div>

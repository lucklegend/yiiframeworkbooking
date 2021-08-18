<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FbBookingReport Re */

$this->title = 'Report';
$this->params['breadcrumbs'][] = ['label' => 'Booking Report', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Booking-create"> 

    <?= $this->render('book_form', [
        'model' => $model,
    ]) ?>

</div>

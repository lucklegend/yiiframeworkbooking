<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use vova07\themes\admin\widgets\Box;
use yii\grid\CheckboxColumn;


/* @var $this yii\web\View */
/* @var $searchModel app\models\FbBookingBookedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Facility Booking';
//$this->params['subtitle'] = 'Booked list';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="facility-booking-create">

    <h1 style="display:none"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelGro' => $modelGro, 'modelFac' => $modelFac
    ]) ?>

</div>
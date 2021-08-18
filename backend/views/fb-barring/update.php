<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FbBarring */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Barring',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Barrings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="fb-barring-update">
 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FbBarring */

$this->title = Yii::t('app', 'Barring');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Barrings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fb-barring-create">
 
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

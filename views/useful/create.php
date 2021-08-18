<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Useful */

$this->title = 'Create Useful';
$this->params['breadcrumbs'][] = ['label' => 'Usefuls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="useful-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

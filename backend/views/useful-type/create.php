<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UsefulType */

$this->title = 'Create Contractor Type';
$this->params['breadcrumbs'][] = ['label' => 'Contractor Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="useful-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

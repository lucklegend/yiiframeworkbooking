<?php

use yii\helpers\Html;
use sadovojav\gallery\Module;

$this->title = Module::t('default', 'UPDATE') . ' ' . Html::encode($model->name);
$this->params['breadcrumbs'] = [
    ['label' => Module::t('default', 'GALLERIES'), 'url' => ['index']],
    ['label' => Html::encode($model->name), 'url' => ['view', 'id' => $model->id]],
    Module::t('default', 'UPDATE')
];

?>

<div class="gallery-update">
    <div class="page-header">
        <div class="row">
         
        </div>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>
</div>

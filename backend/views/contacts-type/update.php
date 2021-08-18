<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ContactsType */

$this->title = 'Update Contacts Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Contacts Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contacts-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

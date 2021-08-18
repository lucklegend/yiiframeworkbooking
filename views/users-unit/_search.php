<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsersUnitSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-unit-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'unit_name') ?>

    <?= $form->field($model, 'unit_block') ?>

    <?= $form->field($model, 'unit_level') ?>

    <?= $form->field($model, 'unit_type') ?>

    <?php // echo $form->field($model, 'bookable') ?>

    <?php // echo $form->field($model, 'published') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

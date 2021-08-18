<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Userful */

$this->title = Yii::t('app', 'Create Userful');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Userfuls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userful-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

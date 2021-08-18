<?php

use yii\helpers\Html;
use vova07\themes\admin\widgets\Box;

/* @var $this yii\web\View */
/* @var $model common\models\PagesType */

$this->title = 'Type';
$this->params['subtitle'] = 'Creating Type';
$this->params['breadcrumbs'][] = ['label' => 'Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

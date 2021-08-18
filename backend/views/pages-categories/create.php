<?php

use yii\helpers\Html;
use vova07\themes\admin\widgets\Box;

/* @var $this yii\web\View */
/* @var $model common\models\PagesCategories */

$this->title = 'Categories';
$this->params['subtitle'] = 'Creating Categories';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-categories-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use vova07\themes\admin\widgets\Box;

/* @var $this yii\web\View */
/* @var $model common\models\MailTemplate */

$this->title = 'Mail Template';
$this->params['subtitle'] = 'Creating Mail Template';
$this->params['breadcrumbs'][] = ['label' => 'Mail Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mail-template-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

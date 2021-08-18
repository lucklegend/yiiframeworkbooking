<?php

use yii\helpers\Html;
use vova07\themes\admin\widgets\Box;

/* @var $this yii\web\View */
/* @var $model common\models\UsersType */

$this->title = 'Type';
$this->params['subtitle'] = 'Creating Type';
$this->params['breadcrumbs'][] = ['label' => 'Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-12">
        <?php $box = Box::begin(
            [
                //'title' => $this->params['subtitle'],
                'renderBody' => false,
                'options' => [
                    'class' => 'box-primary'
                ],
                'bodyOptions' => [
                    'class' => 'table-responsive'
                ],
                'buttonsTemplate' => '{cancel}'
            ]
        );
		?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <?php Box::end(); ?>
 </div>

</div>

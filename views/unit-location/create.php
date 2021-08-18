<?php

use yii\helpers\Html;
use vova07\themes\admin\widgets\Box;


/* @var $this yii\web\View */
/* @var $model app\models\UnitLocation */

$this->title = 'Unit Location';
$this->params['subtitle'] = 'Unit Location';
$this->params['breadcrumbs'][] = ['label' => 'Unit Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-12">
        <?php $box = Box::begin(
            [
                'title' => $this->params['subtitle'],
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

<?php

use yii\helpers\Html;
use vova07\themes\admin\widgets\Box;

/* @var $this yii\web\View */
/* @var $model common\models\Pages */

$this->title = 'Pages';
$this->params['subtitle'] = 'Creating Page';
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
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
               
            ]
        );
		?>
    <?= $this->render('_form2', [
        'model' => $model,
    ]) ?>
    <?php Box::end(); ?>
 </div>

</div>

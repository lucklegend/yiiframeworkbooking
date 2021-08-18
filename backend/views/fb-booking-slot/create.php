<?php

use yii\helpers\Html;
use vova07\themes\admin\widgets\Box;


/* @var $this yii\web\View */
/* @var $model common\models\FbBookingSlot */

$this->title = 'Create Booking Slot';
$this->params['subtitle'] = 'Creating Booking Slot';
$this->params['breadcrumbs'][] = ['label' => 'Fb Booking Slots', 'url' => ['index']];
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
        'model' => $model, 'id' => $id, 'facility' =>$facility,
    ]) ?>
    <?php Box::end(); ?>
 </div>

</div>

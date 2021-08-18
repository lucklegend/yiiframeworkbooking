<?php

use yii\helpers\Html;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $model common\models\FbBookingBooked */

$this->title = 'Create Booking';
$this->params['breadcrumbs'][] = ['label' => 'New Booking', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row fb-booking-booked-create">
<!-- <div class="col-sm-3">
<nav class="navbar navbar-inverse sidebar" role="navigation">
 <div class="navbar-header" style="width:100%">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
            
			<p class="navbar-brand" style="padding-left:10%">Resident's Menu</a>
		</div>
             <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
                    <?//= $this->render('//layouts/sidebar-menu') ?>
            </div>
 </nav>
</div> -->
 <div class="col-sm-9">

    <h3>Pay <?php echo $pay; ?></h3>
    <?php
			$query = new Query;
		$query->select(['deposit'])
			->from('fb_booking_facility')
			->where(['id' => $model->facility_id])
			->limit(1);
		$command = $query->createCommand();
		$deposit = $command->queryScalar();
		
		if($model->facility_id == NULL){
			$query = new Query;
			$query->select(['price'])
				->from('fb_booking_slot')
				->where(['group' => $model->group])
				->limit(1);
			$command = $query->createCommand();
			$price = $command->queryScalar();
		} else {
			$query = new Query;
			$query->select(['price'])
				->from('fb_booking_slot')
				->where(['facility' => $model->facility_id])
				->limit(1);
			$command = $query->createCommand();
			$price = $command->queryScalar();

		}

	?>
    <p> <?php  
		if($pid == '10') {
			echo "Kindly, proceed to the Management Office to make a deposit of $ ". Yii::$app->formatter->asDecimal($deposit) ." and charges of $ ". Yii::$app->formatter->asDecimal($price) ." as soon as possible for the same day booking, otherwise it will be cancelled and slot will be open for others.";
		}
	?>
	</p>

    <?= $this->render('confirm_form', [
        'model' => $model, 'pid' => $pid, 'pay' => $pay,
    ]) ?>

</div>
</div>
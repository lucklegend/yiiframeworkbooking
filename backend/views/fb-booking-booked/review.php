<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
?>
  <div class="panel panel-default" style="margin-bottom:0px;">
    <div class="panel-heading">
    Facility Booking Receipt
    <?php
	echo Html::a('Print', ['print', 'id'=>$model->id], [
    'class'=>'btn btn-danger', 
	'style' => 'float:right; padding: 1px 10px;',
    'target'=>'_blank', 
    'data-toggle'=>'tooltip', 
    'title'=>'Will open the generated PDF file in a new window'
]);
	?>
    </div>
    <div class="panel-body">
                <div class="row" style="padding-bottom:10px">
                <div class="col-sm-3">
                 <strong>Referrence No.</strong>
                </div>
                <div class="col-sm-3">
                 <?php echo $model->id;  ?>
                </div>
                <div class="col-sm-3">
                <strong>Date Booked</strong>
                </div>
                <div class="col-sm-3">
               <?php echo date('d M Y', strtotime($model->slot_from)); ?>
                </div>
            </div>
            
            <div class="row" style="padding-bottom:10px">
                <div class="col-sm-3">
                <strong>Facility</strong>
                </div>
                <div class="col-sm-3">
                <?php echo $model->facility0->name; ?>
                </div>
                <div class="col-sm-3">
                <strong>Start Time</strong>
                </div>
                <div class="col-sm-3">
                <?php echo date('h:ia', strtotime($model->slot_from)); ?>
                </div>
            </div>
           
           <div class="row">
                <div class="col-sm-3">
                <strong>Facility Fee / Deposit</strong>
                </div>
                <div class="col-sm-3">
                <?php echo $model->deposit == '' ? 'NA' :  'SGD '.Yii::$app->formatter->asDecimal($model->deposit); ?>
                </div>
                <div class="col-sm-3">
                <strong>End Time</strong>
                </div>
                <div class="col-sm-3">
                <?php echo date('h:ia', strtotime($model->slot_to)); ?>
                </div>
            </div>
            
            <div class="row">    

               <p style="margin:20px 40px;">
               
               <?php echo  $model->created == '' ? '' : 'Facility booked via online on ' . date('d F Y h:ia', strtotime($model->created)); ?>
               
                </p>
            </div>

    </div>
        <div class="panel-heading">Resident Particulars</div>
    <div class="panel-body">
                <div class="row" style="padding-bottom:10px">
                <div class="col-sm-3">
                 <strong>Name</strong>
                </div>
                <div class="col-sm-3">
                 <?php echo $model->user->username; ?>
                </div>
                <div class="col-sm-3">
                <strong>Phone / Mobile</strong>
                </div>
                <div class="col-sm-3">
               <?php echo $user->contact_no; ?>
                </div>
            </div>
            
            <div class="row" style="padding-bottom:10px">
                <div class="col-sm-3">
                <strong>Unit</strong>
                </div>
                <div class="col-sm-3">
                <?php echo $level.'-' .$unit; ?>
                </div>
                <div class="col-sm-3">
                <strong>Email</strong>
                </div>
                <div class="col-sm-3">
                <?php echo $user->email; ?>
                </div>
            </div>
                       
           <div class="box" style="margin-top:20px">
            <div class="row" style="margin:20px 40px; padding:20px;">
               <p>I confirm that I have read and understood the Rules and Regulation for the use of <?php echo $model->facility0->name; ?> . I agreed to abide by the Rules and Regulations, and am responsible for the behaviour of my guest. I also understand that I will print a copy of this receipt and submit to the Management Office upon booking payment.</p>
            </div>
            <div class="row" style="margin:20px 40px; padding:20px;">
              <div class="col-sm-6">
              <p>Name / Signature</p>
              </div>
              <div class="col-sm-6">
              <p>Date</p>
              </div>
            </div>
        </div>
    </div> 
      <div class="panel-heading">For Official Use Only</div>
    <div class="panel-body">
           <div class="row" style="padding-bottom:20px">
                <div class="col-sm-6">
                <p>(1) Application handed to security officer</p>
                </div>
                <div class="col-sm-6">
                 <p style="margin:0 0 0px">Name / Signature:</p> <br />
                 <p>Date:</p>
                </div>
            </div>
            
            <div class="row" style="padding-bottom:20px; height:72px">
                <div class="col-sm-6">
                <p>(2) Management Staff</p>
                </div>
                <div class="col-sm-6">
                 <p>Name / Signature:</p>
                </div>
            </div>
            
            <div class="row" style="padding-bottom:20px">
                <div class="col-sm-6">
                <p>(3) Reference</p>
                </div>
                <div class="col-sm-6">
                 <p style="margin:0 0 0px">Date:</p> <br />
                 <p>Issued by:</p>
                </div>
            </div>

           <div class="row" style="padding-bottom:20px">
                <div class="col-sm-6">
                <p>(4) Bank name:</p>
                </div>
                <div class="col-sm-6">
                 <p>Bank Account:</p>
                </div>
            </div>
    </div>
  </div>
</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
?>
<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
    Facility Booking Receipt
    </div>
    <div class="panel-body">
    <table class="table">
                <tr>
                <th>
                 <strong>Referrence No.</strong>
                </th>
                <td>
                 <?php echo $model->id;  ?>
                </td>
                <th>
                <strong>Date Booked</strong>
                </th>
                <td>
               <?php echo date('d M Y', strtotime($model->slot_from)); ?>
                </td>
            </tr>
        
            <tr>
                <th>
                <strong>Facility</strong>
                </th>
               <td>
                <?php echo $model->facility0->name; ?>
                 </td>
               <th>
                <strong>Start Time</strong>
                </th>
                <td>
                <?php echo date('h:ia', strtotime($model->slot_from)); ?>
                 </td>
           </tr>
           
           <tr>
                <th>
                <strong>Facility Fee / Deposit</strong>
               </th>
                <td>
                <?php echo $model->deposit == '' ? 'NA' :  'SGD '.Yii::$app->formatter->asDecimal($model->deposit); ?>
                </td>
                <th>
                <strong>End Time</strong>
                </th>
                <td>
                <?php echo date('h:ia', strtotime($model->slot_to)); ?>
                 </td>
            </tr>
             </table>   
            <div class="row">
              <p style="margin:20px 40px;">
                 <?php echo  $model->created == '' ? '' : 'Facility booked via online on ' . date('d F Y h:ia', strtotime($model->created)); ?>
              </p>
            </div>

    </div>
        <div class="panel-heading">Resident Particulars</div>
    <div class="panel-body">
    <table class="table">
                <tr>
                <th>
                 <strong>Name</strong>
                </th>
                <td>
                 <?php echo $model->user->username ?>
                 </td>
                <th>
                <strong>Phone / Mobile</strong>
                </th>
                <td>
               <?php echo $user->contact_no; ?>
                 </td>
             </tr>
            
           <tr>
           
                <th>
                <strong>Email</strong>
                </th>
                <td>
                <?php echo $user->email; ?>
                 </td>
             </tr>
          </table>             
           <div class="box" style="margin-top:20px">
            <div class="row" style="margin:20px 40px; padding:20px;">
               <p>I confirm that I have read and understood the Rules and Regulation for the use of <?php echo $model->facility0->name; ?> . I agreed to abide by the Rules and Regulations, and am responsible for the behaviour of my guest. I also understand that I will print a copy of this receipt and submit to the Management Office upon booking payment.</p>
            </div>
         <table class="table">
            <tr>
                  <td>
                  <p>Name / Signature</p>
                  </td>
                  <td>
                  <p>Date</p>
                  </td>
            </tr>
        </table> 
    </div> 
    </div>
      <div class="panel-heading">For Official Use Only</div>
    <div class="panel-body">
     <table cellpadding="5" class="table">
           <tr>
                 <td>
                <p>(1) Application handed to security officer</p>
                </td>
                 <td>
                 <p>Name / Signature:</p>
                </td>
            </tr>
            <tr>
                 <td>
                </td>
                 <td>
                 <p>Date:</p>
                </td>
            </tr>
            <tr class="row" style="margin:20px 40px;"></tr>
              <tr>
                <td>
                <p>(2) Management Staff</p>
                </td>
                 <td>
                 <p>Name / Signature:</p>
                </td>
            </tr>
            
            <tr>
                 <td>
                <p>(3) Reference</p>
                </td>
                 <td>
                 <p style="margin:0 0 0px">Date:</p>
                </td>
            </tr>
            
             <tr>
                 <td>
                </td>
                 <td>
                 <p>Issued by:</p>
                </td>
            </tr>
           <tr>
                <td>
                <p>(4) Bank name:</p>
                </td>
                 <td>
                 <p>Bank Account:</p>
                </td>
            </tr>
        </table>
    </div>
  </div>
</div>

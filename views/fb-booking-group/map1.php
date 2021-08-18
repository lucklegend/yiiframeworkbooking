<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use vova07\themes\admin\widgets\Box;
use yii\grid\CheckboxColumn;


/* @var $this yii\web\View */
/* @var $searchModel app\models\FbBookingFacilitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Site Map';
?>
<div class="fb-booking-group-map1">
    <h2> Site Map</h2>
    <b><a href="<?php echo FRONTEND. '/index.php?r=facilities%2Findex' ?>" style="background: none;color: #CC6600"> Main </a> </b>
    <ul style="list-style-type:circle;">  

        <li><a href="<?php echo FRONTEND.'/index.php?r=gallery/gallery/index' ?>" style="background: none;">Photo Gallery</a></li>
        <li><a href="<?php echo FRONTEND.'/index.php?r=fb-booking-group/site' ?>" style="background: none;">Site Plan</a></li>
    </ul> 
    <b style="color: #CC6600"> My Profile </b>
    <ul style="list-style-type:circle;">
        <li><a href="<?php echo FRONTEND.'/index.php?r=users/user/password' ?>" style="background: none;">Change Password</a></li>
      </ul> 
    <b style="color: #CC6600"> Facility Booking </b>
    <ul style="list-style-type:circle;">
        <li><a href="<?php echo FRONTEND.'/index.php?r=booking/index' ?>" style="background: none;">Facilities Booking</a></li>
        <li><a href="<?php echo FRONTEND.'/index.php?r=fb-booking-booked/index' ?>" style="background: none;">View / Cancel Bookings</a></li>
    </ul>
    <b style="color: #CC6600"> Our Community </b>
    <ul style="list-style-type:circle;">
        <li><a href="<?php echo FRONTEND.'/index.php?r=pages/index&id=1' ?>" style="background: none;">Circulars</a></li>
        <li><a href="<?php echo FRONTEND.'/index.php?r=events/index' ?>" style="background: none;">Calendar of Events</a></li>
    </ul>
    <b ><a href="<?php echo FRONTEND.'/index.php?r=contacts' ?>" style="background: none;color: #CC6600"> Useful Infomation </a></b><br>
    <b ><a href="<?php echo FRONTEND.'/index.php?r=pages/index&id=11' ?>" style="background: none;color: #CC6600"> Application Forms </a></b><br>
    <b ><a href="<?php echo FRONTEND.'/index.php?r=pages/index&id=6' ?>" style="background: none;color: #CC6600"> By-laws </a></b><br>
    <b ><a href="<?php echo FRONTEND.'/index.php?r=site/default/contacts' ?>" style="background: none;color: #CC6600"> Contact Us </a></b>
 
</div>

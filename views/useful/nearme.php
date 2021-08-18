<?php

use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\helpers\ArrayHelper;
use kartik\tabs\TabsX;

$this->title = 'Near Me';
$this->params['subtitle'] = 'Near Me';
$this->params['breadcrumbs'][] = $this->title;


$content1 = '<iframe src="https://www.google.com/maps/embed?pb=!1m12!1m8!1m3!1d15955.105091366231!2d103.81970179775884!3d1.3095264694361963!3m2!1i1024!2i768!4f13.1!2m1!1sembassies!5e0!3m2!1sen!2sin!4v1611160092422!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>';
$content2 = '<iframe src="https://www.google.com/maps/embed?pb=!1m12!1m8!1m3!1d15955.104818910988!2d103.81970179775882!3d1.3095692694351986!3m2!1i1024!2i768!4f13.1!2m1!1shospitals!5e0!3m2!1sen!2sin!4v1611160327207!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>';
$content3 = '<iframe src="https://www.google.com/maps/embed?pb=!1m12!1m8!1m3!1d15955.10454581023!2d103.81970179775882!3d1.3096121694341984!3m2!1i1024!2i768!4f13.1!2m1!1sHotels!5e0!3m2!1sen!2sin!4v1611160445054!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>';
$content4 = '<iframe src="https://www.google.com/maps/embed?pb=!1m12!1m8!1m3!1d15955.094160520966!2d103.8256241!3d1.3112425!3m2!1i1024!2i768!4f13.1!2m1!1spolice%20station!5e0!3m2!1sen!2sin!4v1611160509527!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>';
$content5 = '<iframe src="https://www.google.com/maps/embed?pb=!1m12!1m8!1m3!1d15955.093887266412!2d103.82562409775885!3d1.311285369395175!3m2!1i1024!2i768!4f13.1!2m1!1sPost%20Office!5e0!3m2!1sen!2sin!4v1611160524652!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>';
$content6 = '<iframe src="https://www.google.com/maps/embed?pb=!1m12!1m8!1m3!1d15955.093613807845!2d103.82562409775885!3d1.311328269394174!3m2!1i1024!2i768!4f13.1!2m1!1sschools!5e0!3m2!1sen!2sin!4v1611160528786!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>';
$content7 = '<iframe src="https://www.google.com/maps/embed?pb=!1m12!1m8!1m3!1d15955.105023253254!2d103.81970179775887!3d1.3095371694359486!3m2!1i1024!2i768!4f13.1!2m1!1sshopping!5e0!3m2!1sen!2sin!4v1611160539664!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>';
?>
<style>
.h3.visible-print-block{
	display: none !important;
}
</style>
<div class="fb-booking-booked-index">
 
		    <div class="page-title">
                <h2> Near Me </h2>
                <span class="line-h"></span> 
            </div>
            
            <?php
            $items = [
                [
                    'label'=>'Embassies',                     
                    'content' => $content1,
                    'active'=>true,
                ],
                [
                    'label'=>'Hospitals',                     
                    'content' => $content2,
                ],
                [
                    'label'=>'Hotels',                     
                    'content' => $content3,
                ],
                [
                    'label'=>'Police Station',                     
                    'content' => $content4,
                ],
                [
                    'label'=>'Post Office',                     
                    'content' => $content5,
                ],
                [
                    'label'=>'Schools',                     
                    'content' => $content6,
                ],
                
                [
                    'label'=>'Shopping',                     
                    'content' => $content7,
                ],
                
            ]; 

            echo TabsX::widget([
                 

                'items'=>$items,
                'position'=>TabsX::POS_ABOVE, 
                'height'=>TabsX::SIZE_LARGE,
                'bordered'=>true,
                'encodeLabels'=>false
            ]);

            $this->registerJs('
            $("document").ready(function() {
            setTimeout(function() {
            $(".tabs-krajee").find("li.active a").click();
            },10);
            });', \yii\web\View::POS_READY);
            ?> 
       

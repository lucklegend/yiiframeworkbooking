<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use vova07\themes\admin\widgets\Box;
use yii\grid\CheckboxColumn;
use yii\helpers\ArrayHelper;
use common\models\FbBookingGroup;
use yii\db\Query;

$this->title = 'Facilities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row facility_list"  style="margin-top:20px">
	
 <div class="col-sm-9">
 <h1 style="color:#34495e;">Facilities</h1>

       <div class="row facility_list">
             <div class="col-sm-12" style="margin-top:20px">
              <div class="well well-sm" style="background-color: #e3e3e3;">Invigorate your senses at Hot and Cold Spa Pools & Jacuzzis...</div>
             <div class="col-sm-4">
              <a class="lightbox" href="statics/web/images/sbig1.jpg" title="Spa Village">
               <img class="img-thumbnail" src="statics/web/images/swimminpool-small.jpg" alt="">
              </a>
              <p align="justify">Spa Village</p>
             </div>
             <div class="col-sm-4">
              <a class="lightbox" href="statics/web/images/sbig2.jpg" title="Main Pool">
               <img class="img-thumbnail" src="statics/web/images/swimminpool-small2.jpg" alt="">
              </a>
              <p align="justify">Main Pool</p>
             </div>
             <div class="col-sm-4">
              <a class="lightbox" href="statics/web/images/sbig3n.jpg" title="Play Pool">
               <img class="img-thumbnail" src="statics/web/images/swimminpool-small3.jpg" alt="">
              </a>
               <p align="justify">Play Pool</p>
             </div>
             <div class="col-sm-4">
               <a class="lightbox" href="statics/web/images/sbig4.jpg" title="Pool Pavilion">
                 <img class="img-thumbnail" src="statics/web/images/swimminpool-small4.jpg" alt="">
               </a>
                  <p align="justify">Pool Pavilion</p>
             </div>
             <div class="col-sm-4">
              <a class="lightbox" href="statics/web/images/sbig5.jpg" title="Pool Overview">
                <img class="img-thumbnail" src="statics/web/images/swimminpool-small5.jpg" alt="">
              </a>
              <p align="justify">Pool Overview</p>
             </div>
             <div class="col-sm-4">
              <a class="lightbox" href="statics/web/images/sbig6n.jpg" title="Fun Pool">
                <img class="img-thumbnail" src="statics/web/images/swimminpool-small6.jpg" alt="">
              </a><p align="justify">Fun Pool</p>
             </div>
             <div class="col-sm-4">
              <a class="lightbox" href="statics/web/images/sbig7.jpg" title="Cold Jacuzzi">
               <img class="img-thumbnail" src="statics/web/images/swimminpool-small7.jpg" alt="">
              </a>
              <p align="justify">Cold Jacuzzi</p>
            </div>
            <div class="col-sm-4">
             <a class="lightbox" href="statics/web/images/sbig8n.jpg" title="Hot Jacuzzi">
              <img class="img-thumbnail" src="statics/web/images/swimminpool-small8.jpg" alt="">
             </a>
             <p align="justify">Hot Jacuzzi</p>
            </div>
            <div class="col-sm-4">
             <a class="lightbox" href="statics/web/images/sbig91.jpg" title="Pool Night View ">
              <img class="img-thumbnail" src="statics/web/images/swimminpool-small9.jpg" alt="">
             </a>
             <p align="justify">Pool Night View </p>
            </div>
         </div>
        </div>
        
    <div class="row">
      <div class="col-sm-12" style="margin-top:20px">
		<div class="well well-sm" style="background-color: #e3e3e3;">Rejuvenate your mind and body ......</div>
         <div class="col-sm-4">
          <a class="lightbox" href="statics/web/images/spa-big4.jpg" title="Dew - Steam room">
           <img class="img-thumbnail" src="statics/web/images/spa-small4.jpg" alt="">
          </a>
          <p align="justify">Dew - Steam room</p>
         </div>
		<div class="col-sm-4">
         <a class="lightbox" href="statics/web/images/spa-big5.jpg" title="Mist - Steam room">
          <img class="img-thumbnail" src="statics/web/images/spa-small5.jpg" alt="">
         </a>
         <p align="justify">Mist - Steam room</p>
        </div>
     </div>
    </div>

<div class="row">
 <div class="col-sm-12" style="margin-top:20px">
  <div class="well well-sm" style="background-color: #e3e3e3;">Chill out at the Barbecue  & Relaxation pavilions...</div>
     <div class="col-sm-4">
      <a class="lightbox" href="statics/web/images/bbig1n.jpg" title="Main Pool BBQ Pit">
       <img class="img-thumbnail" src="statics/web/images/bsmall1.jpg" alt="">
      </a>
      <p align="justify">Main Pool BBQ Pit</p>
     </div>
	 <div class="col-sm-4">
      <a class="lightbox" href="statics/web/images/bbig2.jpg" title="Palm Court BBQ - Gate 3">
       <img class="img-thumbnail" src="statics/web/images/bsmall2.jpg" alt="">
      </a>
      <p align="justify">Palm Court BBQ - Gate 3</p>
     </div>
     <div class="col-sm-4">
      <a class="lightbox" href="statics/web/images/bbig3.jpg" title="Palm Court BBQ - Tower 2C">
       <img class="img-thumbnail" src="statics/web/images/bsmall3.jpg" alt="">
      </a>
       <p align="justify">Palm Court BBQ - Tower 2C</p>
     </div>
 </div>
</div>

<div class="row facility_list">
 <div class="col-sm-12" style="margin-top:20px">
  <div class="well well-sm" style="background-color: #e3e3e3;">Enjoy the Roof garden and its breathtaking views...</div>
     <div class="col-sm-4">
      <a class="lightbox" href="statics/web/images/vbig1.jpg" title="Roof Garden - Tower 2C">
       <img class="img-thumbnail" src="statics/web/images/vsmall1.jpg" alt="">
      </a>
      <p align="justify">Roof Garden - Tower 2C</p>
     </div>
	 <div class="col-sm-4">
      <a class="lightbox" href="statics/web/images/vbig2.jpg" title="Roof Fountain">
       <img class="img-thumbnail" src="statics/web/images/vsmall2.jpg" alt="">
      </a>
      <p align="justify">Roof Fountain</p>
     </div>
     <div class="col-sm-4">
      <a class="lightbox" href="statics/web/images/vbig3.jpg" title="Roof Garden">
       <img class="img-thumbnail" src="statics/web/images/vsmall3.jpg" alt="">
      </a>
       <p align="justify">Roof Garden</p>
     </div>
 </div>
</div>

<div class="row facility_list">
 <div class="col-sm-12" style="margin-top:20px">
  <div class="well well-sm" style="background-color: #e3e3e3;">For a great workout in pleasant settings...</div>
     <div class="col-sm-4">
      <a class="lightbox" href="statics/web/images/gym-big1.jpg" title="Gym">
       <img class="img-thumbnail" src="statics/web/images/gym-small1.jpg" alt="">
      </a>
      <p align="justify">Gym</p>
     </div>
	 <div class="col-sm-4">
      <a class="lightbox" href="statics/web/images/gym-big22.jpg" title="Open Air Fitness Area">
       <img class="img-thumbnail" src="statics/web/images/gym-small2.jpg" alt="">
      </a>
      <p align="justify">Open Air Fitness Area</p>
     </div>
     <div class="col-sm-4">
      <a class="lightbox" href="statics/web/images/gym-big33.jpg" title="Gym-full view">
       <img class="img-thumbnail" src="statics/web/images/gym-small3.jpg" alt="">
      </a>
       <p align="justify">Gym-full view</p>
     </div>
 </div>
</div>

<div class="row facility_list">
 <div class="col-sm-12" style="margin-top:20px">
  <div class="well well-sm" style="background-color: #e3e3e3;">For fitness buffs...</div>
     <div class="col-sm-4">
      <a class="lightbox" href="statics/web/images/tennis-big.jpg" title="Tennis Court">
       <img class="img-thumbnail" src="statics/web/images/tennis-small.jpg" alt="">
      </a>
      <p align="justify">Tennis Court</p>
     </div>
	 <div class="col-sm-4">
      <a class="lightbox" href="statics/web/images/badminton-big.jpg" title="Badminton Court">
       <img class="img-thumbnail" src="statics/web/images/badminton-small.jpg" alt="">
      </a>
      <p align="justify">Badminton Court</p>
     </div>
     <div class="col-sm-4">
      <a class="lightbox" href="statics/web/images/basketball-big.jpg" title="Basketball Court">
       <img class="img-thumbnail" src="statics/web/images/basketball-small.jpg" alt="">
      </a>
       <p align="justify">Basketball Court</p>
     </div>
      <div class="col-sm-4">
      <a class="lightbox" href="statics/web/images/t4b.jpg" title="Putting Green">
       <img class="img-thumbnail" src="statics/web/images/t4s.jpg" alt="">
      </a>
      <p align="justify">Putting Green</p>
     </div>
	 <div class="col-sm-4">
      <a class="lightbox" href="statics/web/images/t5b.jpg" title=" Foot Reflexology">
       <img class="img-thumbnail" src="statics/web/images/t5s.jpg" alt="">
      </a>
      <p align="justify">Foot Reflexology</p>
     </div>
     <div class="col-sm-4">
      <a class="lightbox" href="statics/web/images/t6b1.jpg" title="Jogging Trail">
       <img class="img-thumbnail" src="statics/web/images/t6s.jpg" alt="">
      </a>
       <p align="justify">Jogging Trail</p>
     </div>
 </div>
</div>

<div class="row facility_list">
 <div class="col-sm-12" style="margin-top:20px">
  <div class="well well-sm" style="background-color: #e3e3e3;">Relax with family and friends...</div>
     <div class="col-sm-4">
      <a class="lightbox" href="statics/web/images/bktv1.jpg" title="Karaoke Room">
       <img class="img-thumbnail" src="statics/web/images/sktv1.jpg" alt="">
      </a>
      <p align="justify">Karaoke Room</p>
     </div>
	 <div class="col-sm-4">
      <a class="lightbox" href="statics/web/images/bktv2.jpg" title="Sense Room">
       <img class="img-thumbnail" src="statics/web/images/sktv2.jpg" alt="">
      </a>
      <p align="justify">Sense Room</p>
     </div>
     <div class="col-sm-4">
      <a class="lightbox" href="statics/web/images/bktv3.jpg" title="Function room">
       <img class="img-thumbnail" src="statics/web/images/sktv3.jpg" alt="">
      </a>
       <p align="justify">Function room</p>
     </div>
 </div>
</div>

<div class="row facility_list">
 <div class="col-sm-12" style="margin-top:20px">
  <div class="well well-sm" style="background-color: #e3e3e3;">Fun time for Kids...</div>
     <div class="col-sm-4">
      <a class="lightbox" href="statics/web/images/sbig9.jpg" title="Kids Pool">
       <img class="img-thumbnail" src="statics/web/images/kswimminpool-small9.jpg" alt="">
      </a>
      <p align="justify">Kids Pool</p>
     </div>
	 <div class="col-sm-4">
      <a class="lightbox" href="statics/web/images/play-big21.jpg" title="Children Pool">
       <img class="img-thumbnail" src="statics/web/images/play-small2.jpg" alt="">
      </a>
      <p align="justify">Children Pool</p>
     </div>
     <div class="col-sm-4">
      <a class="lightbox" href="statics/web/images/play-big33.jpg" title="Playground">
       <img class="img-thumbnail" src="statics/web/images/play-small3.jpg" alt="">
      </a>
       <p align="justify">Playground</p>
     </div>
 </div>
</div>

</div>
</div>





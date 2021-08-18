<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use vova07\themes\admin\widgets\Box;
use yii\grid\CheckboxColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FbBookingFacilitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Location Map';
?>
<div class="row" style="margin-top:30px;">
 <div class="col-sm-12">
     <h1 style=" margin:0">Location</h1>
        <p style="margin:10px 0px;"><b>Axon Consulting</b><br />
        204 Joo Chiat Road, <br />
        #03-01 Singapore 427475, <br />
        Tel: 6344 9618 <span> Fax: 6344 9766</span> <br />
        Email: info@axon.com.sg / support@axon.com.sg
		</p>
        <div class="embed-responsive embed-responsive-4by3">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.771973668383!2d103.89811421477489!3d1.3122251620606489!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da187204aa7a89%3A0x232d7321ec6cca52!2sAxon+Consulting!5e0!3m2!1sen!2ssg!4v1472634368853" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
 </div>
</div>

<script type="text/javascript">
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: {lat: 1.3452404, lng: 103.72287140000003}
        });

        setMarkers(map);
      }

      var locations = [
		  ['Lakeshore Condominium', 1.3452404,103.72287140000003, 1],
      ];

      function setMarkers(map) {
        for (var i = 0; i < locations.length; i++) {
          var location = locations[i];
          var marker = new google.maps.Marker({
            position: {lat: location[1], lng: location[2]},
            map: map,
            title: location[0],
            zIndex: location[3]
          });
        }
      }
    </script> 
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkZyruSX9SHZA1WAlO7b9dcTmX8pvXZG0&callback=initMap"></script> 
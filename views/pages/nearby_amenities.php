<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use vova07\themes\admin\widgets\Box;
use yii\grid\CheckboxColumn;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nearby Amenities';
$this->params['subtitle'] = 'Pages list';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row nearby"> 

<style type="text/css">
#type_holder label .types{
	margin-right: 10px;
}
</style> 
  <h3   >
    <?= $this->title ?>
  </h3>

  <div class="row">
    <div class="col-md-6" style="float: left;">
      <div id="map" style="/* width: 370px; */height: 540px;margin-bottom: 20px;position: relative;overflow: hidden;"></div>
    </div>
    <div class="col-md-6" style="float: left; width: 400;padding-left:100px; margin-top: 20px">
      <form name="frm_map" id="frm_map">
        <table>
          <tr>
            <td>Radius<br /><input type="text" name="radius" id="radius" value="2" placeholder="Radius In KM"></td>
          </tr>
          <tr>
            <td><div id="type_holder" style="height: 200px; overflow-y: scroll;"> 
                <!-- Dynamic Content --> 
              </div></td>
          </tr>
          <tr>
            <td><input type="button" value="Show" id="submit" onclick="renderMap();">
              <input name="address" id="address" type="hidden" value="73 Jalan Tua Kong #02-02 Singapore 457266" />
              </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> 
  <script>
    $(document).ready(function(){
        // type_holder
        // <div><label><input type="checkbox" class="types" value="mosque" />Mosque</label></div>

        var types = ['bus_station','movie_theater','schools','train_station'];
        var html = '';

        $.each(types, function( index, value ) {
            var name = value.replace(/_/g, " ");
            html += '<div><label><input type="checkbox" class="types" value="'+ value +'" />'+ capitalizeFirstLetter(name) +'</label></div>';
        });

        $('#type_holder').html(html);
    });

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    var map;
    var infowindow;
    var autocomplete;
    var countryRestrict = {'country': 'sg'};
    var selectedTypes = [];

    function initialize()
    {
        autocomplete = new google.maps.places.Autocomplete((document.getElementById('address')), {
            types: ['(regions)'],
           // componentRestrictions: countryRestrict
        });

        var pyrmont = new google.maps.LatLng(1.315815, 103.925763);

        map = new google.maps.Map(document.getElementById('map'), {
            center: pyrmont,
            zoom: 18
        });
    }

    function renderMap()
    {
        // Get the user defined values
        var address = document.getElementById('address').value;
        var radius  = parseInt(document.getElementById('radius').value) * 1000;
        
        // get the selected type
        selectedTypes = [];
        $('.types').each(function(){
            if($(this).is(':checked'))
            {
                selectedTypes.push($(this).val());
            }
        });

        var geocoder    = new google.maps.Geocoder();
        var selLocLat   = 0;
        var selLocLng   = 0;

        geocoder.geocode({'address': address}, function(results, status) {
            if (status === 'OK')
            {
                //console.log(results[0].geometry.location.lat() + ' - ' + results[0].geometry.location.lng());

                selLocLat   = results[0].geometry.location.lat();
                selLocLng   = results[0].geometry.location.lng();

                //var pyrmont = new google.maps.LatLng(52.5666644, 4.7333304);

                var pyrmont = new google.maps.LatLng(selLocLat, selLocLng);

                map = new google.maps.Map(document.getElementById('map'), {
                    center: pyrmont,
                    zoom: 18
                });

                //console.log(selectedTypes);

                var request = {
                    location: pyrmont,
                    //radius: 5000,
                    //types: ["atm"]
                    radius: radius,
                    types: selectedTypes
                };

                infowindow = new google.maps.InfoWindow();

                var service = new google.maps.places.PlacesService(map);
                service.nearbySearch(request, callback);
            }
            else
            {
                alert('Geocode was not successful for the following reason: ' + status); 
            }
        });
    }

    function callback(results, status)
    {
        if (status == google.maps.places.PlacesServiceStatus.OK)
        {
            for (var i = 0; i < results.length; i++)
            {
                createMarker(results[i], results[i].icon);
            }
        }
    }

    function createMarker(place, icon) {
        var placeLoc = place.geometry.location;

        var marker = new google.maps.Marker({
            map: map,
            position: place.geometry.location,
            icon: {
                url: icon,
                scaledSize: new google.maps.Size(20, 20) // pixels
            },
            animation: google.maps.Animation.DROP
        });
        
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.setContent(place.name+ '<br>' +place.vicinity);
            infowindow.open(map, this);
        });
    }
    </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLXGSw8bGWnaZv9T1W8m-H_s8m7MsA24Y&libraries=places&callback=initialize" async defer></script> 
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> 
 
</section>
<script src="<?= Url::base();?>/font/js/all.js"></script>
</div>
</div>
</div>

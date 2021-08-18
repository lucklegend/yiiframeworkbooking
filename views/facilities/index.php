<?php

/**
 * Frontend main page view.
 *
 * @var yii\web\View $this View
 */
use romkaChev\yii2\swiper\Swiper;
use vova07\users\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\users\models\LoginForm;
 
$this->title = Yii::$app->name;
$this->params['noTitle'] = true; ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
* {
	box-sizing: border-box
}
body {
	font-family: Verdana, sans-serif;
	margin:0
}
.mySlides {
	display: none
}
img {
	vertical-align: middle;
}
/* Slideshow container */
.slideshow-container {
	max-width: 1000px;
	position: relative;
	background: #f1f1f1f1; 
	margin: auto;
	padding-left: 100px;
	height:300px;
	/*top: -15px;*/
	text-align: center;
	padding-top: 100px;
}
/* Next & previous buttons */
.prev, .next {
	cursor: pointer;
	position: absolute;
	top: 50%;
	width: auto;
	padding: 16px;
	margin-top: -22px;
	color: white;
	font-weight: bold;
	font-size: 18px;
	transition: 0.6s ease;
	border-radius: 0 3px 3px 0;
	user-select: none;
}
.next {
	right: 0;
	border-radius: 3px 0 0 3px;
}
.prev:hover, .next:hover {
	background-color: rgba(0,0,0,0.8);
}
/* Caption text */
.text {
	color: #f2f2f2;
	font-size: 15px;
	padding: 8px 12px;
	position: absolute;
	bottom: 8px;
	width: 100%;
	text-align: center;
}
/* Number text (1/3 etc) */
/*.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}*/

/* The dots/bullets/indicators */
.dot {
	cursor: pointer;
	height: 15px;
	width: 15px;
	margin: 0 2px;
	background-color: #bbb;
	border-radius: 50%;
	display: inline-block;
	transition: background-color 0.6s ease;
}
.active, .dot:hover {
	background-color: #717171;
}
/* Fading animation */
.fade {
	-webkit-animation-name: fade;
	-webkit-animation-duration: 1.5s;
	animation-name: fade;
	animation-duration: 1.5s;
}
 @-webkit-keyframes fade {
 from {
opacity: .4
}
to {
	opacity: 1
}
}
 @keyframes fade {
 from {
opacity: .4
}
to {
	opacity: 1
}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 100px) {
.prev, .next, .text {
	font-size: 11px
}
}
</style>


<div class="intro_contentarea">
<div class="content-div row">
<div id="CONTENTAREA" class="intro_welcomemsg col-sm-10 col1">
<img src="img/t/sg.gif" style="margin-top: 10px;width: 350px;"> <br>
<div class="move_left"> <span class="subheading_color"></span> </div>
<div class="row"><br>
  <div class="col-sm-12" style="FONT-SIZE: 12px;"> <img src="img/home2.jpg" width="137" height="344" style="margin:0px 15px 15px 0px" align="left">
    <p class="p"> Ardmore Park redefines modern luxury living with a stylish lavishness and exclusive address that is the definitive 
      residence for the well established. The sprawling 8 acres make Ardmore Park one of the largest
      freehold sites in a prime residential location in Singapore and it is set on high land enjoying island wide views. <br>
    </p>
    <p class="p"> Located at the most prestigious address in Singapore, Ardmore Park is 
      designed to have a classic and enduring quality with three elegant 30-storey towers and a separate 2-storey grand clubhouse. <br>
    </p>
    <p class="p"> Designed in contemporary style, each tower block comprises 28 floors of 4 identical 
      apartments of 268 sq m each on every level and 2 penthouses on the 29th floor, all served internally by a private lift. All residences have 
      an exceptionally high floor to ceiling height and are designed with full height windows to maximize enjoyment of the peaceful 
      and revitalizing landscape grounds and island wide views.<br>
    </p>
    <p class="p"> The main entrance and private lift lobbies have been designed on a grand scale complete with exquisite marble finishing. The beauty of 
      the lobbies is further enhanced by an extensive collection of original art pieces, 
      both paintings and ceramic works by renowned artists and sculptors. <br>
    </p>
    <p class="p"> The two basement car parks are designed to provide generous and ample parking spaces for
      residents and visitors.<br>
    </p>
    <p class="p"> The luscious and matured landscaping areas create a welcome tropical ambience for the 
      estate. All parts of the gardens are well lit at night using attractively designed light fittings that are discretely positioned.
      Many sculptures and ornamental pots are scattered at strategic locations making the landscape gardens a special art piece by 
      itself.<br>
    </p>
    <p class="p"> A full range of facilities - large swimming pool, open Jacuzzi and children pool lined 
      with light coloured mosaic patterns, giving a clear aquamarine colour with a generous deck area all paved in warm-toned sandstones, a fully 
      equipped gymnasium, two function rooms with a fully equipped kitchen, two tennis courts, saunas, multi-purpose court, fitness corner, 
      3-tier koi pond, fully equipped BBQ facility,a children’s playground and storage lockers complete the epitome of a well designed 
      development such as Ardmore Park.<br>
    </p>
    <p class="p"> High priority is placed on security at Ardmore Park. Over 35 highly trained in-house 
      security officers are employed in addition to strategically located cameras to provide round the clock surveillance ensure a safe
      and secure environment for the residents in Ardmore Park. </p>
  </div>
</div>
<script>
var slideIndex = 0; 
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 3000); // Change image every 2 seconds
}
</script> 

<!--LoginBox--> 
   
  </div>
  <div class="col-sm-2" style="text-align:right"> <a href="index.php?r=facilities/walkthrough" style="padding: 10px;opacity: inherit;background-color: #ff000000;"><img src="img/rgtvirtual.jpg" width="163" height="132" border="0"></a><br>
    <a href="index.php?r=gallery%2Fgallery%2Findex" style="padding: 10px;opacity: inherit;background-color: #ff000000;"><img src="img/rgtphotol.jpg" width="163" height="141" border="0"></a><br>
    <a href="index.php?r=fb-booking-group%2Fsite" style="padding: 10px;opacity: inherit;background-color: #ff000000;"><img src="img/rgtplan.jpg" width="163" height="137" border="0"></a> </div>
  <!--Bottom Div--> 

<!--Outer Div--> 
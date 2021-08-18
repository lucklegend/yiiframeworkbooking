<?php
session_start();
date_default_timezone_set('Asia/Singapore'); //TimeZone Set
include_once("includes/config.php");
include("../lapsed.php");
$page                        = $_GET['page'];
$userid                      = $_GET['user_id'];
$Crypted                     = $_GET['crypted'];
$all_system_disabled_peak    = '0';
$all_system_disabled_nonpeak = '0';
$all_system_disabled         = '0';
//Code Added by Vasanth to allow user to book at 7am - tennis court 1 & 2 													
//							$facility_id = array(12, 14);
//							if (@in_array($_GET['fac'], $facility_id)) 
//							{								 																	
//									if (date("H") < 7)
//									{
//										echo '<script language=JavaScript>';
//										echo 'alert("Kindly start booking after 7am");';
//										echo 'window.location ="booking.php?crypted='.$Crypted.'&id=&page=book_now&user_id='.$userid.'"';		
//										echo '</script>';										
//										exit;
//													
//									}									  
//							} 										
function changeformat($datein) {
    $dateout = explode("-", $datein);
    return $dateout[2] . "-" . $dateout[1] . "-" . $dateout[0];
}
/*if (preg_match ('/[^a-z]/i', $page)) { 



if(stristr($page, '_') == TRUE) {

//echo '"earth" not found in string';

}

else

{

echo '<script language=JavaScript>';

echo 'alert("Invalid Entry1!");';

echo 'self.location.href="profile.php?crypted='.$_GET['crypted'].'";';

echo '</script>';

}

}



if (!is_numeric($userid) && isset($userid) && $userid != '')

{

echo '<script language=JavaScript>';

echo 'alert("Invalid Entry2!");';

echo 'self.location.href="profile.php?crypted='.$_GET['crypted'].'";';

echo '</script>';

}

*/
$s_id  = $_SESSION['basic_is_logged_in'];
$query = "select * from user_account  where crypted  = '$_GET[crypted]' and id = '$s_id' limit 1";
$result = mysql_query($query) or die(mysql_error());
$count = mysql_num_rows($result);
while ($row = mysql_fetch_array($result)) {
    $id                    = $row[id];
    $user_type             = $row[user_type];
    $_SESSION['user_type'] = $user_type;
    $username              = $row[username];
}
if ($_SESSION['basic_is_logged_in'] != $id or $_SESSION['basic_is_logged_in'] == '') {
    echo "<script type=text/javascript language=javascript> window.location.href = '../login.php?ops=2'; </script> ";
    exit;
}
$statuscancel = array(
    '1' => '2',
    '2' => '2',
    '3' => '2',
    '4' => '2',
    '5' => '3',
    '6' => '4',
    '7' => '2',
    '8' => '2',
    '9' => '5',
    '10' => '3',
    '11' => '4',
    '12' => '5'
);
if (isset($_POST[szID])) {
    $query = "SELECT * FROM user_account  where username = '$_POST[szID]' and password = '$_POST[szPassword]' and active = '1'";
    $result = mysql_query($query) or die(mysql_error());
    $count = mysql_num_rows($result);
    if ($count != '0') {
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $id                             = $row['id'];
            $crypted                        = $row['crypt'];
            $_SESSION['basic_is_logged_in'] = "$id";
            include_once('random_char.php');
            $query = "update user_account set crypted = '$pwd' where id = '$id' limit 1";
            $result = mysql_query($query) or die(mysql_error());
            echo "<script type=text/javascript language=javascript> window.location.href = 'mem/index.php?crypted=$pwd'; </script> ";
        }
    } else {
        //die ();
        echo "<script type=text/javascript language=javascript> window.location.href = 'home.php?ops=1'; </script> ";
        exit;
    }
}
if ($_GET['newbook'] != '') {
    $_SESSION['newbook'] = $_GET['newbook'];
} else {
    $_SESSION['newbook'] = $_SESSION['newbook'];
}
?>



<script language="javascript">

function validateprompt()

{

	var msg = confirm("Click OK to cancel your booking. Otherwise, click CANCEL");

	if (msg)

	{

		return true;

	}

	else

	{

		return false;

	}	

}



function validatepromptdelete()

{

	var msg = confirm("Click OK to delete this booking. Otherwise, click CANCEL");

	if (msg)

	{

		return true;

	}

	else

	{

		return false;

	}	

}

</script>

<style type="text/css">



#dhtmltooltip{

position: absolute;

width: 150px;

border: 2px solid black;

padding: 2px;

background-color: lightyellow;

visibility: hidden;

z-index: 100;

/*Remove below line to remove shadow. Below line should always appear last within this CSS*/

filter: progid:DXImageTransform.Microsoft.Shadow(color=gray,direction=135);

}



 .style1 {font-weight: bold}

 </style>

<div id="dhtmltooltip"></div>





 

 

 <style type="text/css">

<!--

.style1 {font-size: 16px}

-->

 </style>

 <script language="JavaScript"><!--

function MM_openBrWindow(theURL,winName,features) { //v2.0

  window.open(theURL,winName,features);

}

//--></script>

<script type="text/JavaScript">

<!--

function MM_jumpMenu(targ,selObj,restore){ //v3.0

  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");

  if (restore) selObj.selectedIndex=0;

}

//-->

</script>

</html>

<html>

<head>

<script src="includes/FormManager.js">



</script>

<script language="javascript"><!-- hide from old browsers

function validate()

{





	<!-- hide from old browsers

	  var today = new Date()

	  var month = today.getMonth()+1

	  var year = today.getYear()

	  var day = today.getDate()

	  var total

	  if(day<10) day = "0" + day

	  if(month<10) month= "0" + month 

	  if(year<1000) year+=1900

		 

	  total = day + "-" + month +

					 "-" + (year+"").substring(2,4)

	//-->



	if (document.form_1.date_sel_all.value < total)

	{

		alert("Date should start from today onwards. Please reselect date.");

		document.form_1.date_sel_all.focus();

		return false;

	}

	else

	if (document.form_1.date_sel_all_end.value < total || document.form_1.date_sel_all_end.value < document.form_1.date_sel_all.value)

	{

		alert("Date range invalid. Please reselect date.");

		document.form_1.date_sel_all_end.focus();

		return false;

	}

	

	return true;

}

// done hiding -->

</script>

<style>

#element_to_pop_up { 

    background-color:#fff;

    border-radius:15px;

    color:#000;

    display:none; 

    padding:20px;

    min-width:400px;

    min-height: 100px;

	font-weight:bold;

	text-align:center;

}

.b-close{

    cursor:pointer;

    position:absolute;

    right:10px;

    top:5px;

}

#element_to_pop_up{

	width:400px;

}

</style>



<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<script src="../jquerypopup/jquery.bpopup.min.js"></script>

<script language="javascript">

// Semicolon (;) to ensure closing of earlier scripting

// Encapsulation

// $ is assigned to jQuery

;(function($) {



	 // DOM Ready

	$(function() {



		// Binding a click event

		// From jQuery v.1.7.0 use .on() instead of .bind()

		$('#book_now').bind('click', function(e) {



			// Prevents the default action to be triggered. 

			//e.preventDefault();



			// Triggering bPopup when click event is fired

$('#element_to_pop_up').bPopup({

            onOpen: function() {  }, 

            onClose: function() {  }

        },

        function() {

            alert('Proceed to Booking');

        });

              



		});



	});



})(jQuery);



</script>

<link type="text/css" rel="stylesheet" href="../dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>

	<SCRIPT type="text/javascript" src="../dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>:: Welcome to Ardmore Park ::</title>

<link rel=stylesheet type="text/css" href="../textset.css">

<link rel="stylesheet" href="css/form-field-tooltip.css" media="screen" type="text/css">

	<script type="text/javascript" src="js/rounded-corners.js"></script>

	<script type="text/javascript" src="js/form-field-tooltip.js"></script>

	<script>

<!--





var winheight=50

var winsize=50

var x=5











function openwindow(thelocation){

temploc=thelocation

if (!(window.resizeTo&&document.all)&&!(window.resizeTo&&document.getElementById)){

window.open(thelocation)

return

}

win2=window.open("","","scrollbars")

win2.moveTo(0,0)

win2.resizeTo(100,100)

go2()

}

function go2(){

if (winheight>=screen.availHeight-3)

x=0

win2.resizeBy(5,x)

winheight+=5

winsize+=5

if (winsize>=screen.width-5){

win2.location=temploc

winheight=100

winsize=100

x=5

return

}

setTimeout("go2()",50)

}

//-->

</script>

</head>

<?
include("../headermem.php");
?>

<script type="text/javascript">

var offsetxpoint=-60 //Customize x offset of tooltip

var offsetypoint=20 //Customize y offset of tooltip

var ie=document.all

var ns6=document.getElementById && !document.all

var enabletip=false

if (ie||ns6)

var tipobj=document.all? document.all["dhtmltooltip"] : document.getElementById? document.getElementById("dhtmltooltip") : ""



function ietruebody(){

return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body

}



function ddrivetip(thetext, thecolor, thewidth){

if (ns6||ie){

if (typeof thewidth!="undefined") tipobj.style.width=thewidth+"px"

if (typeof thecolor!="undefined" && thecolor!="") tipobj.style.backgroundColor=thecolor

tipobj.innerHTML=thetext

enabletip=true

return false

}

}



function positiontip(e){

if (enabletip){

var curX=(ns6)?e.pageX : event.clientX+ietruebody().scrollLeft;

var curY=(ns6)?e.pageY : event.clientY+ietruebody().scrollTop;

//Find out how close the mouse is to the corner of the window

var rightedge=ie&&!window.opera? ietruebody().clientWidth-event.clientX-offsetxpoint : window.innerWidth-e.clientX-offsetxpoint-20

var bottomedge=ie&&!window.opera? ietruebody().clientHeight-event.clientY-offsetypoint : window.innerHeight-e.clientY-offsetypoint-20



var leftedge=(offsetxpoint<0)? offsetxpoint*(-1) : -1000



//if the horizontal distance isn't enough to accomodate the width of the context menu

if (rightedge<tipobj.offsetWidth)

//move the horizontal position of the menu to the left by it's width

tipobj.style.left=ie? ietruebody().scrollLeft+event.clientX-tipobj.offsetWidth+"px" : window.pageXOffset+e.clientX-tipobj.offsetWidth+"px"

else if (curX<leftedge)

tipobj.style.left="5px"

else

//position the horizontal position of the menu where the mouse is positioned

tipobj.style.left=curX+offsetxpoint+"px"



//same concept with the vertical position

if (bottomedge<tipobj.offsetHeight)

tipobj.style.top=ie? ietruebody().scrollTop+event.clientY-tipobj.offsetHeight-offsetypoint+"px" : window.pageYOffset+e.clientY-tipobj.offsetHeight-offsetypoint+"px"

else

tipobj.style.top=curY+offsetypoint+"px"

tipobj.style.visibility="visible"

}

}



function hideddrivetip(){

if (ns6||ie){

enabletip=false

tipobj.style.visibility="hidden"

tipobj.style.left="-1000px"

tipobj.style.backgroundColor=''

tipobj.style.width=''

}

}



document.onmousemove=positiontip



</script>

 <script language="JavaScript">

<!--

function blockError()

{

return true;

}

window.onerror = blockError;

//-->

</script>

<table cellSpacing="0" cellPadding="0" width="100%" border="0" id="table4">

<tr>

	<td vAlign="top" align="left" width="8" rowSpan="3">&nbsp;</td>

	<td class="topspace" vAlign="top" align="left" colSpan="4"><SPACER 

type="block"></SPACER></td>

</tr>

<tr>

	<td class="left" vAlign="top" align="left" width="150" background="img/leftctrbg2.gif">

    <link href="../textset.css" type="text/css" rel="stylesheet">

    <table cellSpacing="0" cellPadding="0" width="150" border="0" id="table5">

	<tr vAlign="top">

		<td class="lefttop" height="93">&nbsp;</td>

		</tr>

		<tr> 

			<td> 

            <table cellSpacing="0" cellPadding="0" width="100%" border="0" id="table6">

            <tr> 

            	<td vAlign="top" align="middle" style="padding-top:10px;">

                <?php
if ($user_type == '1') {
    echo "Welcome <i><b>Admin [$username]</b></i><br>";
} else if ($user_type == '2') {
    echo "Welcome <i><b>Club [$username]</b></i><br>";
} else {
    echo "Welcome <i><b>Resident [$username]</b></i><br>";
}
?>

                <input onMouseOver="this.src='img/but_logout_2.gif'" onClick="location.replace('logout.php')" onMouseOut="this.src='img/but_logout_2.gif'" type="image" src="img/but_logout_2.gif" name="I1">

                <br>&nbsp;

                </td>

            </tr>

            </table>

          	</td>

        </tr>

        <?
if ($user_type == '1') {
    include("internal-adminmenu.php");
} else {
    include("internal-memmenu.php");
}
?>

        <tr>

			<td class="leftdecline" height="3"><SPACER type="block" 

height="3"></SPACER></td>

		</tr>

		<?php
/* 

if($user_type =='1')

{

?>

<tr>   

<td class="leftcontent"><img height="7" src="img/leftdot.gif" width="9"><a class="copy" href="booking.php?crypted=<?php echo $_GET[crypted]; ?>&cr=1"> Create Facilities</a> </td>

</tr>

<tr>

<td class="leftdecline" height="3"><SPACER type="block" height="3"></SPACER></td>

</tr>

<?php

}

else

{

echo "";

}

*/
$start_month = date('-m-Y');
?>

        <tr>

			<td class="leftdecline" height="3"><SPACER type="block" height="3"></SPACER></td>

		</tr>

	  </table>

	</td>

		<td class="ctrleft" vAlign="top" align="left" width="29" height="20"><img height="82" src="img/ctrrgttop.gif" width="29"></td>		

		<td class="ctr" vAlign="top">

		<table cellSpacing="0" cellPadding="0" width="100%" border="0" id="table7">

		<tr>

			<td class="ctrtop" vAlign="bottom" height="82"><img height="36" src="img/t/online.gif" width="263"></td>

		</tr>

		<tr>

			<td class="content" vAlign="top"><p>

			<?php
if ($_GET[cr] == '1' and $_GET[pr] == '') {
    unset($_SESSION[facility]);
    $_SESSION[track] = time();
    echo "<script type=text/javascript language=javascript> window.location.href = 'booking.php?crypted=$_GET[crypted]&cr=1&pr=1'; </script> ";
    exit;
}
if ($user_type == '1' and $_GET[cr] == '1' and $_GET[pr] == '1' and $_SESSION[track] != '') {
?>

            <script type="text/javascript">

			window.onload = function() {

			setupDependencies('form'); //name of form(s). Seperate each with a comma (ie: 'weboptions', 'myotherform' )

	 		};

            </script>

            <?
    if (isset($_POST[Submit])) {
        $_SESSION[facility]    = $_POST;
        $from_date             = explode('.', $_POST[from_date]);
        $from_date_start_day   = $from_date[0];
        $from_date_start_month = $from_date[1];
        $from_date_start_year  = $from_date[2];
        $to_date               = explode('.', $_POST[to_date]);
        $to_date_day           = $to_date[0];
        $to_date_month         = $to_date[1];
        $to_date_year          = $to_date[2];
        // print_r($_SESSION[facility]);
        $query                 = "insert into facility (unique_no,created_by,created_on,name,deposite,auto_apporve,max_booking_per_day,rule1_1,rule1_2,rule1_3,relation_rule_1,rule2_1,rule2_2,rule2_3,relation_rule_2,rule3_1,rule3_2,rule3_3,open_from,closed_at,os,from_time,max_time,hours,auto_close_date,auto_close_start_day,auto_close_start_month,auto_close_start_year,auto_close_end_day,auto_close_end_month,auto_close_end_year,from_date,to_date,frame,message,auto_cal,type,month_blocked,absent_amount,month_period) values ('$_SESSION[track]','$id','$_POST[creation_date]','$_POST[name]','$_POST[deposite]','$_POST[auto]','$_POST[booking_per_day]','$_POST[rule1_1]','$_POST[rule1_2]','$_POST[rule1_3]','$_POST[logic_one]','$_POST[rule2_1]','$_POST[rule2_2]','$_POST[rule2_3]','$_POST[logic_two]','$_POST[rule3_1]','$_POST[rule3_2]','$_POST[rule3_3]','$_POST[open_from]','$_POST[closed_at]','$_POST[os]','$_POST[from]','$_POST[max]','$_POST[hrs]','$from_date_start_day','$from_date_start_month','$from_date_start_year','$to_date_day','$to_date_month','$to_date_year','$_POST[auto_close]','$_POST[from_date]','$_POST[to_date]','$_POST[frame]','$_POST[message]','$_POST[auto_cal]','$_POST[type]','$_POST[month_blocked]','$_POST[absent_amount]','$_POST[month_period]')";
        mysql_query($query) or die(mysql_error());
        $dayfromenter   = explode(".", $_POST['from_date']);
        $dayenterfrom   = $dayfromenter[0];
        $monthenterfrom = $dayfromenter[1];
        $yearenterfrom  = $dayfromenter[2];
        $daytoenter     = explode(".", $_POST['to_date']);
        $dayenterto     = $daytoenter[0];
        $monthenterto   = $daytoenter[1];
        $yearenterto    = $daytoenter[2];
        if ($_POST[auto_cal] == 1) {
            // check first if have same day entry
            $query     = "SELECT * FROM calender_event WHERE heading = '$_POST[message]' AND day = '$dayenterfrom' AND month_no = '$monthenterfrom' AND year = '$yearenterfrom'";
            $resulting = mysql_query($query);
            $foundalso = mysql_num_rows($resulting);
            if ($foundalso == 0) {
                $query = "select * from user_account  where crypted  = '$_GET[crypted]' and id = '$s_id' limit 1";
                $result = mysql_query($query) or die(mysql_error());
                //$count = mysql_num_rows($result);
                $row   = mysql_fetch_array($result);
                $id    = $row[id];
                $query = "insert into calender_event (uid,heading,details,day,month_no,year) values ('$id','$_POST[message]','$_POST[name]','$dayenterfrom','$monthenterfrom','$yearenterfrom')";
                mysql_query($query);
                // insert
            } else {
                $foundfrom = mysql_fetch_array($resulting);
                $query     = "select * from user_account  where crypted  = '$_GET[crypted]' and id = '$s_id' limit 1";
                $result = mysql_query($query) or die(mysql_error());
                //$count = mysql_num_rows($result);
                $row   = mysql_fetch_array($result);
                $id    = $row[id];
                $query = "update calender_event set uid='$id',heading = '$_POST[message]',details='$_POST[name]' where sno ='$foundfrom[sno]' ";
                mysql_query($query);
                // update
            }
            $query     = "SELECT * FROM calender_event WHERE heading = '$_POST[message]' AND day = '$dayenterto' AND month_no = '$monthenterto' AND year = '$yearenterto'";
            $resulting = mysql_query($query);
            $foundalso = mysql_num_rows($resulting);
            if ($foundalso == 0) {
                $query = "select * from user_account  where crypted  = '$_GET[crypted]' and id = '$s_id' limit 1";
                $result = mysql_query($query) or die(mysql_error());
                //$count = mysql_num_rows($result);
                $row   = mysql_fetch_array($result);
                $id    = $row[id];
                $query = "insert into calender_event (uid,heading,details,day,month_no,year) values ('$id','$_POST[message]','$_POST[name]','$dayenterto','$monthenterto','$yearenterto')";
                mysql_query($query);
                // insert
            } else {
                $foundfrom = mysql_fetch_array($resulting);
                $query     = "select * from user_account  where crypted  = '$_GET[crypted]' and id = '$s_id' limit 1";
                $result = mysql_query($query) or die(mysql_error());
                //$count = mysql_num_rows($result);
                $row   = mysql_fetch_array($result);
                $id    = $row[id];
                $query = "update calender_event set uid='$id',heading = '$_POST[message]',details='$_POST[name]' where sno ='$foundfrom[sno]' ";
                mysql_query($query);
                // update
            }
        }
        unset($_SESSION[facility]);
        echo "<script type=text/javascript language=javascript> window.location.href = 'booking.php?crypted=$_GET[crypted]&page=view'; </script> ";
        exit;
    }
    if (isset($_POST[down])) {
        if ($_POST[from_time] > $_POST[to_time]) {
            $er = 1;
        } else {
            $query = "select * from track_time where track = '$_SESSION[track]'";
            $result = mysql_query($query) or die(mysql_error());
            while ($row = mysql_fetch_array($result)) {
                if (($_POST[from_time] < $row[to_time]) and ($_POST[week] == '0' or $_POST[week] == $row[weak])) {
                    $er = 1;
                }
            }
        }
        //print_r($_POST);
        if ($er != '1') {
            $query = "insert into track_time (track,from_time,to_time,peak,weak) values ('$_SESSION[track]','$_POST[from_time]','$_POST[to_time]','$_POST[peak]','$_POST[week]')";
            mysql_query($query);
        } else {
            echo "<div align=center><font color=red>Either The time range is already in use or the time range is not right</font></div>";
        }
    }
?>

            </p>

			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

            <tr>

            	<td style="background-repeat:no-repeat"><div align="right"><img src="images/left_win_10.gif" width="21" height="30" border="0"></div></td>

                <td width="100%%" background="images/middle_win_11.gif">&nbsp;</td>

                <td><img src="images/right_win_14.gif" width="17" height="30"></td>

            </tr>

            <tr>

                <td colspan="3"><form name="form" method="post" action="">

                <table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">

                <tr>

                	<td colspan="13" bgcolor="#944542" class="fontitle txtgrey" style="border-left:0px solid #b09852;border-right:1px solid #b09852; padding-left:15px; padding-top:5px; padding-bottom:5px;"><span class="fontitle">&nbsp;<strong>Basic Details </strong></span></td>

                </tr>

                <tr>

                	<td width="136" style="padding-left:15px; padding-top:5px; padding-bottom:5px; border-left:1px solid #990011;"> Name </td>

                    <td width="22" style="padding-left:15px; padding-top:5px; padding-bottom:5px;"><strong>:</strong></td>

                    <td colspan="5" style="padding-left:15px; padding-top:5px; padding-bottom:5px;"><label>

                    <input name="name" type="text" value="<?php
    echo $_POST[name];
?>" tooltiptext="Type In Facilite Name Here (e.g: Tennies Court)" >

                    </label></td>

                    <td width="144" style="padding-left:15px; padding-top:5px; padding-bottom:5px;"><div align="right">Creation Date </div></td>

                    <td width="22" style="padding-left:15px; padding-top:5px; padding-bottom:5px;"><strong>:</strong></td>

                    <td width="143" style="padding-left:15px; padding-top:5px; padding-bottom:5px; border-right:0px solid #990011;"><b> &nbsp;

                    <?php
    $date = date("l dS  F Y h:i:s A");
    echo $date;
?>

                    </b>&nbsp;

                    <input type="hidden" name="creation_date" value="<?php
    echo $date;
?>"></td>

				    <td width="54" style="padding-left:15px; padding-top:5px; padding-bottom:5px; border-right:0px solid #990011;">Type</td>

                    <td width="26" style="padding-left:15px; padding-top:5px; padding-bottom:5px; border-right:0px solid #990011;"><strong>:</strong></td>

                    <td width="144" style="padding-left:15px; padding-top:5px; padding-bottom:5px; border-right:1px solid #990011;"><select name="type">

                    <option value="0" selected>Indoor</option>

                    <option value="1">Outdoor</option>

                    </select></td>

                </tr>

                <tr>

                	<td colspan="13" bgcolor="#944542" style="border-left:1px solid #b09852;border-right:1px solid #b09852; padding-left:15px; padding-top:5px; padding-bottom:5px;"><span class="fontitle"><strong>&nbsp;Booking Time Range </strong></span></td>

                </tr>

                <tr>

                	<td colspan="13" style="border-left:1px solid #990011; border-right:1px solid #990011;">

                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

                    <tr>

                    	<td>

                        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">

                        <tr>

                        	<td width="8%" style="padding-left:10px;">From</td>

							<td width="1%"><strong>:</strong></td>

                            <td width="9%"><label>

                            <select name="from_time" tooltipText="Select the start timing of the facility. (e.g: if the faility is open from morning 10:00 AM then select 10:00 from drop down option)">

                            <?php
    $query  = "select * from time_slot ";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result)) {
        echo "<option value=$row[id]>$row[time_slot]</option>";
    }
?>

                            </select>

                            </label></td>

                            <td width="4%">To </td>

                            <td width="1%"><strong>:</strong></td>

                            <td width="12%"><label>

                            <select name="to_time" tooltipText="Select the closing timing of the facility. (e.g: if the faility closes at evening 10:00 PM then select 22:00 from drop down option)">

                            <?php
    $query  = "select * from time_slot ";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result)) {
        echo "<option value=$row[id]>$row[time_slot]</option>";
    }
?>

                            </select>

                            </label></td>

                            <td width="7%"><label>Type</label></td>

                            <td width="2%"><strong>:</strong></td>

                            <td width="16%">

                            <select name="peak" tooltipText="Do you want to take this time range as Peak Time or Non-Peak Time, Tip : Remmber you can enter more then one open and close time of a facilities and decalre any time range as Peak Time or Non-Peak Time. ">

                            	<option value="1">Peak Time</option>

                            	<option value="0" selected>Non-Peak Time</option>

                            </select></td>

                            <td width="17%"><div align="right">

                            <select name="week" tooltiptext="After you have selected the time range, you can define this range to specify day of week or all week. Please note that system will verify the range and mis-conflict of time range for you.">

                            	<option value="0" selected>All Week</option>

                                <option value="1">Sunday</option>

                                <option value="2">Monday</option>

                                <option value="3">Tuesday</option>

                                <option value="4">Wednesday</option>

                                <option value="5">Thursday</option>

                                <option value="6">Friday</option>

                                <option value="7">Saturday</option>

                            </select></div>                            </td>

                            <td width="23%"><div align="left">

                            <input type="submit" name="down" value="V">

                            </div></td>

						</tr>

                        </table>                        </td>

					</tr>

                    </table>

                    <?php
    if (isset($_POST[Delete])) {
        $delete = explode('x', $_POST[Delete]);
        //print_r($delete);
        mysql_query("delete from track_time where sno = '$delete[1]' limit 1") or die(mysql_error());
    }
    $query  = "select * from track_time where track = '$_SESSION[track]'";
    $result = mysql_query($query);
    $count  = mysql_num_rows($result);
    if ($count == '0') {
        $disabled = "disabled = disabled";
    }
    if ($count >= '1') {
?>

                    <table width="100%" border="0" align="center" class="sk_bok" cellpadding="5" cellspacing="0">

                    <tr>

                    	<td width="4%" bgcolor="#FCECC7"><div align="center"><strong>Sno</strong></div></td>

                        <td width="23%" bgcolor="#FCECC7" style="border-left:1px solid #990011;"><div align="center"><strong>From</strong></div></td>

                        <td width="23%" bgcolor="#FCECC7" style="border-left:1px solid #990011;"><div align="center"><strong>To</strong></div></td>

                        <td width="21%" bgcolor="#FCECC7" style="border-left:1px solid #990011;"><div align="center"><strong>Peak / Non Peak</strong> </div></td>

                        <td width="21%" bgcolor="#FCECC7" style="border-left:1px solid #990011;"><div align="center"><strong>Week</strong></div></td>

                    </tr>

                    <?php
        $sr = 1;
        while ($row = mysql_fetch_array($result)) {
            $query1  = "select * from time_slot where id ='$row[from_time]' limit 1";
            $result1 = mysql_query($query1);
            while ($row1 = mysql_fetch_array($result1)) {
                $from_time = $row1[time_slot];
            }
            $query1  = "select * from time_slot where id ='$row[to_time]' limit 1";
            $result1 = mysql_query($query1);
            while ($row1 = mysql_fetch_array($result1)) {
                $to_time = $row1[time_slot];
            }
?>

                    <tr align="center">

                    	<td style="border-top:1px solid #990011;"><?php
            echo $sr;
?></td>

                        <td style="border-left:1px solid #990011; border-top:1px solid #990011;"><?php
            echo "$from_time";
?></td>

                        <td style="border-left:1px solid #990011; border-top:1px solid #990011;"><?php
            echo "$to_time ";
?></td>

                        <td style="border-left:1px solid #990011; border-top:1px solid #990011;">

						<?php
            if ($row[peak] == '1') {
                echo "Peak Hour";
            } else {
                echo "Non - Peak Hour";
            }
?></td>

                        <td style="border-left:1px solid #990011; border-top:1px solid #990011;"><?php
            if ($row[weak] == '0') {
                echo "All Week";
            } elseif ($row[weak] == '1') {
                echo "Sunday";
            } elseif ($row[weak] == '2') {
                echo "Monday";
            } elseif ($row[weak] == '3') {
                echo "Tuesday";
            } elseif ($row[weak] == '4') {
                echo "Wednesday";
            } elseif ($row[weak] == '5') {
                echo "Thursday";
            } elseif ($row[weak] == '6') {
                echo "Friday";
            } elseif ($row[weak] == '7') {
                echo "Saturday";
            }
?> 

					</tr>

                    <?php
            $sr++;
        }
?>

                    </table>

                    <?php
    }
?>

                	<br>                	</td>

				</tr>

                <tr>

                	<td colspan="13" bgcolor="#944542" style="border-left:1px solid #b09852;border-right:1px solid #b09852; padding-left:15px; padding-top:5px; padding-bottom:5px;"><span class="fontitle"><strong>&nbsp;Advance Rules </strong></span></td>

                </tr>

                <tr>

                	<td colspan="13" style="border-left:1px solid #990011; border-right:1px solid #990011; border-bottom:1px solid #990011;">

                    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">

                    <tr>

                    	<td>Deposit(SGD)</td>

                        <td><strong>:</strong></td>

                        <td><input name="deposite" type="text" value="<?php
    echo $_SESSION[facility][deposite];
?>" size="5" maxlength="5" tooltipText="Enter the amount which will be displayed to user while booking the facilities and receipt of same will be issued. If the amount is ZERO then it will be considered as NO CHARGES" <?php
    echo $disabled;
?>></td>

                        <td><div align="right">Auto Approve </div></td>

                        <td><strong>:</strong></td>

                        <td colspan="8">

						<?php
    if ($_SESSION[facility][auto] == '1') {
        $checked = "checked";
    } else {
        $checked = "";
    }
?>

                        <input name="auto" type="checkbox" value="1" <?php
    echo $checked;
?> tooltipText="Do you want system to auto aprove the booking as soon as it is requested" <?php
    echo $disabled;
?>></td>

                        </tr>

                    <tr>

                    	<td colspan="13" bgcolor="#FCECC7">Limit : </td>

                    </tr>

                    <tr>

                    	<td colspan="13"><label>

                        <table width="100%" border="0" align="center" class="sk_bok" cellpadding="5" cellspacing="0">

                        <tr>

                        	<td width="31%">Maximum Booking Allowed Per Day </td>

                            <td width="39%">

							<?php
    if ($_SESSION[facility][booking_per_day] == '1') {
        $sel1 = "selected = selected";
    } elseif ($_SESSION[facility][booking_per_day] == '2') {
        $sel2 = "selected = selected";
    } elseif ($_SESSION[facility][booking_per_day] == '3') {
        $sel3 = "selected = selected";
    } elseif ($_SESSION[facility][booking_per_day] == '4') {
        $sel4 = "selected = selected";
    } elseif ($_SESSION[facility][booking_per_day] == '5') {
        $sel5 = "selected = selected";
    } elseif ($_SESSION[facility][booking_per_day] == '6') {
        $sel6 = "selected = selected";
    }
?>

                            <select name="booking_per_day" <?php
    echo $disabled;
?>>

                            	<option value="1" <?php
    echo $sel1;
?>>1 Booking Per Day</option>

                                <option value="2" <?php
    echo $sel2;
?>>2 Booking Per Day</option>

                                <option value="3" <?php
    echo $sel3;
?>>3 Booking Per Day</option>

                                <option value="4" <?php
    echo $sel4;
?>>4 Booking Per Day</option>

                                <option value="5" <?php
    echo $sel5;
?>>5 Booking Per Day</option>

                                <option value="6" <?php
    echo $sel6;
?>>6 Booking Per Day</option>

                            </select></td>

                            <td width="30%" rowspan="6" valign="top"><div align="justify">Note : <br>

                            All rules and limit will be ignored below the step where N/A is selected. For example if you have selected Rule 1 as N/A in first drop down box then Rule 2 and rule 3 will be ignored. </div></td>

						</tr>

                        <tr>

                        	<td>Rule 1 </td>

                            <td>

							<?php
    if ($_SESSION[facility][rule1_1] == '0') {
        $selrule1_0 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '1') {
        $selrule1_1 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '2') {
        $selrule1_2 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '3') {
        $selrule1_3 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '4') {
        $selrule1_4 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '5') {
        $selrule1_5 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '6') {
        $selrule1_6 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '6') {
        $selrule1_6 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '7') {
        $selrule1_7 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '8') {
        $selrule1_8 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '9') {
        $selrule1_9 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '9') {
        $selrule1_9 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '10') {
        $selrule1_10 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '11') {
        $selrule1_11 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '12') {
        $selrule1_12 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '13') {
        $selrule1_13 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '14') {
        $selrule1_14 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '15') {
        $selrule1_15 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '16') {
        $selrule1_16 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '17') {
        $selrule1_17 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '18') {
        $selrule1_18 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '19') {
        $selrule1_19 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '20') {
        $selrule1_20 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '21') {
        $selrule1_21 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '22') {
        $selrule1_22 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '23') {
        $selrule1_23 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '24') {
        $selrule1_24 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '25') {
        $selrule1_25 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '26') {
        $selrule1_26 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '27') {
        $selrule1_27 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '28') {
        $selrule1_28 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '29') {
        $selrule1_29 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '30') {
        $selrule1_30 = "selected = selected";
    }
?>

                            <select name="rule1_1" <?php
    echo $disabled;
?>>

                            	<option value="0" <?php
    echo $selrule1_0;
?>>N/A</option>

								<option value="1" <?php
    echo $selrule1_1;
?>>1</option>

                                <option value="2" <?php
    echo $selrule1_2;
?>>2</option>

                                <option value="3" <?php
    echo $selrule1_3;
?>>3</option>

                                <option value="4" <?php
    echo $selrule1_4;
?>>4</option>

                                <option value="5" <?php
    echo $selrule1_5;
?>>5</option>

                                <option value="6" <?php
    echo $selrule1_6;
?>>6</option>

                                <option value="7" <?php
    echo $selrule1_7;
?>>7</option>

                                <option value="8" <?php
    echo $selrule1_8;
?>>8</option>

                                <option value="9" <?php
    echo $selrule1_9;
?>>9</option>

                                <option value="10" <?php
    echo $selrule1_10;
?>>10</option>

                                <option value="11" <?php
    echo $selrule1_11;
?>>11</option>

                                <option value="12" <?php
    echo $selrule1_12;
?>>12</option>

                                <option value="13" <?php
    echo $selrule1_13;
?>>13</option>

                                <option value="14" <?php
    echo $selrule1_14;
?>>14</option>

                                <option value="15" <?php
    echo $selrule1_15;
?>>15</option>

                                <option value="16" <?php
    echo $selrule1_16;
?>>16</option>

                                <option value="17" <?php
    echo $selrule1_17;
?>>17</option>

                                <option value="19" <?php
    echo $selrule1_18;
?>>18</option>

                                <option value="20" <?php
    echo $selrule1_19;
?>>19</option>

                                <option value="21" <?php
    echo $selrule1_20;
?>>20</option>

                                <option value="22" <?php
    echo $selrule1_21;
?>>21</option>

                                <option value="23" <?php
    echo $selrule1_22;
?>>22</option>

                                <option value="24" <?php
    echo $selrule1_24;
?>>24</option>

                                <option value="25" <?php
    echo $selrule1_25;
?>>25</option>

                                <option value="26" <?php
    echo $selrule1_26;
?>>26</option>

                                <option value="27" <?php
    echo $selrule1_27;
?>>27</option>

                                <option value="28" <?php
    echo $selrule1_28;
?>>28</option>

                                <option value="29" <?php
    echo $selrule1_29;
?>>29</option>

                                <option value="30" <?php
    echo $selrule1_30;
?>>30</option>

							</select>

                            <select name="rule1_2" <?php
    echo $disabled;
?>>

                            <?php
    if ($_SESSION[facility][rule1_2] == '0') {
        $sel_rule2_1 = "selected = selected";
    } else {
        $sel_rule2_2 = "selected = selected";
    }
?>

                            	<option value="0" <?php
    echo $sel_rule2_1;
?>>Week</option>

                                <option value="1" <?php
    echo $sel_rule2_2;
?>>Month</option>

                            </select>

                            <?php
    if ($_SESSION[facility][rule1_3] == '0') {
        $rule1_3_1 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_3] == '1') {
        $rule1_3_2 = "selected = selected";
    } else {
        $rule1_3_3 = "selected = selected";
    }
?>

                            <select name="rule1_3" <?php
    echo $disabled;
?>>

                            	<option value="0"  <?php
    echo $rule1_3_1;
?>>Peak Time</option>

                                <option value="1" <?php
    echo $rule1_3_2;
?>>Non-Peak Time</option>

                                <option value="2" <?php
    echo $rule1_3_3;
?>>Any Time</option>

                            </select>                            </td>

						</tr>

                        <tr>

                        	<td>Relation with Rule 1 </td>

                            <td><?php
    if ($_SESSION[facility][logic_one] == '0') {
        $logic_one_1 = "selected = selected";
    } else {
        $logic_one_2 = "selected = selected";
    }
?>

                            <select name="logic_one" <?php
    echo $disabled;
?>>

                            	<option value="0" <?php
    echo $logic_one_1;
?>>and</option>

                                <option value="1" <?php
    echo $logic_one_2;
?>>or</option>

							</select>                            </td>

						</tr>

                        <tr>

                        	<td>Rule 2 </td>

                            <td><?php
    if ($_SESSION[facility][rule2_1] == '0') {
        $rule2_1_0 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '1') {
        $rule2_1_1 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '2') {
        $rule2_1_2 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '3') {
        $rule2_1_3 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '4') {
        $rule2_1_4 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '5') {
        $rule2_1_5 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '6') {
        $rule2_1_6 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '6') {
        $rule2_1_6 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '7') {
        $rule2_1_7 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '8') {
        $rule2_1_8 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '9') {
        $rule2_1_9 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '9') {
        $rule2_1_9 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '10') {
        $rule2_1_10 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '11') {
        $rule2_1_11 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '12') {
        $rule2_1_12 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '13') {
        $rule2_1_13 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '14') {
        $rule2_1_14 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '15') {
        $rule2_1_15 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '16') {
        $rule2_1_16 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '17') {
        $rule2_1_17 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '18') {
        $rule2_1_18 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '19') {
        $rule2_1_19 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '20') {
        $rule2_1_20 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '21') {
        $rule2_1_21 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '22') {
        $rule2_1_22 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '23') {
        $rule2_1_23 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '24') {
        $rule2_1_24 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '25') {
        $rule2_1_25 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '26') {
        $rule2_1_26 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '27') {
        $rule2_1_27 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '28') {
        $rule2_1_28 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '29') {
        $rule2_1_29 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '30') {
        $rule2_1_30 = "selected = selected";
    }
?>

                            <select name="rule2_1" <?php
    echo $disabled;
?>>

                            	<option value="0" <?php
    echo $rule2_1_0;
?>>N/A</option>

                                <option value="1" <?php
    echo $rule2_1_1;
?>>1</option>

                                <option value="2" <?php
    echo $rule2_1_2;
?>>2</option>

                                <option value="3" <?php
    echo $rule2_1_3;
?>>3</option>

                                <option value="4" <?php
    echo $rule2_1_4;
?>>4</option>

                                <option value="5" <?php
    echo $rule2_1_5;
?>>5</option>

                                <option value="6" <?php
    echo $rule2_1_6;
?>>6</option>

                                <option value="7" <?php
    echo $rule2_1_7;
?>>7</option>

                                <option value="8" <?php
    echo $rule2_1_8;
?>>8</option>

                                <option value="9" <?php
    echo $rule2_1_9;
?>>9</option>

                                <option value="10" <?php
    echo $rule2_1_10;
?>>10</option>

                                <option value="11" <?php
    echo $rule2_1_11;
?>>11</option>

                                <option value="12" <?php
    echo $rule2_1_12;
?>>12</option>

                                <option value="13" <?php
    echo $rule2_1_13;
?>>13</option>

                                <option value="14" <?php
    echo $rule2_1_14;
?>>14</option>

                                <option value="15" <?php
    echo $rule2_1_15;
?>>15</option>

                                <option value="16" <?php
    echo $rule2_1_16;
?>>16</option>

                                <option value="17" <?php
    echo $rule2_1_17;
?>>17</option>

                                <option value="19" <?php
    echo $rule2_1_18;
?>>18</option>

                                <option value="20" <?php
    echo $rule2_1_19;
?>>19</option>

                                <option value="21" <?php
    echo $rule2_1_20;
?>>20</option>

                                <option value="22" <?php
    echo $rule2_1_21;
?>>21</option>

                                <option value="23" <?php
    echo $rule2_1_22;
?>>22</option>

                                <option value="24" <?php
    echo $rule2_1_24;
?>>24</option>

                                <option value="25" <?php
    echo $rule2_1_25;
?>>25</option>

                                <option value="26" <?php
    echo $rule2_1_26;
?>>26</option>

                                <option value="27" <?php
    echo $rule2_1_27;
?>>27</option>

                                <option value="28" <?php
    echo $rule2_1_28;
?>>28</option>

                                <option value="29" <?php
    echo $rule2_1_29;
?>>29</option>

                                <option value="30" <?php
    echo $rule2_1_30;
?>>30</option>

							</select>

                            <? // why there is 2 of this?? Comes to think if shashi know what hes doing? 
?>

                            </select>

                            <?php
    if ($_SESSION[facility][rule2_2] == '0') {
        $rule2_2_1 = "selected = selected";
    } else {
        $rule2_2_2 = "selected = selected";
    }
?>

                            <select name="rule2_2" <?php
    echo $disabled;
?>>

                            	<option value="0" <?php
    echo $rule2_2_1;
?>>Week</option>

                                <option value="1" <?php
    echo $rule2_2_2;
?>>Month</option>

                            </select>

                            <?php
    if ($_SESSION[facility][rule2_3] == '0') {
        $rule2_3_1 = "selected = selected";
    } else {
        $rule2_3_2 = "selected = selected";
    }
?>

                            <select name="rule2_3" <?php
    echo $disabled;
?>>

                            	<option value="0" <?php
    echo $rule2_3_1;
?>>Peak Time</option>

                                <option value="1" <?php
    echo $rule2_3_2;
?>>Non-Peak Time</option>

							</select>                            </td>

						</tr>

                        <tr>

                        	<td>Relation with rule 2 </td>

                            <td><?php
    if ($_SESSION[facility][logic_two] == '0') {
        $logic_two_1 = "selected = selected";
    } else {
        $logic_two_2 = "selected = selected";
    }
?>

                            <select name="logic_two" <?php
    echo $disabled;
?>>

                            	<option value="0" <?php
    echo $logic_two_1;
?>>and</option>

                                <option value="1" <?php
    echo $logic_two_2;
?>>or</option>

                            </select>                            </td>

						</tr>

                        <tr>

                        	<td>Rule 3 </td>

                            <td><?php
    if ($_SESSION[facility][rule3_1] == '0') {
        $rule3_1_0 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '1') {
        $rule3_1_1 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '2') {
        $rule3_1_2 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '3') {
        $rule3_1_3 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '4') {
        $rule3_1_4 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '5') {
        $rule3_1_5 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '6') {
        $rule3_1_6 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '6') {
        $rule3_1_6 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '7') {
        $rule3_1_7 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '8') {
        $rule3_1_8 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '9') {
        $rule3_1_9 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '9') {
        $rule3_1_9 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '10') {
        $rule3_1_10 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '11') {
        $rule3_1_11 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '12') {
        $rule3_1_12 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '13') {
        $rule3_1_13 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '14') {
        $rule3_1_14 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '15') {
        $rule3_1_15 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '16') {
        $rule3_1_16 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '17') {
        $rule3_1_17 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '18') {
        $rule3_1_18 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '19') {
        $rule3_1_19 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '20') {
        $rule3_1_20 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '21') {
        $rule3_1_21 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '22') {
        $rule3_1_22 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '23') {
        $rule3_1_23 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '24') {
        $rule3_1_24 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '25') {
        $rule3_1_25 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '26') {
        $rule3_1_26 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '27') {
        $rule3_1_27 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '28') {
        $rule3_1_28 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '29') {
        $rule3_1_29 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '30') {
        $rule3_1_30 = "selected = selected";
    }
?>

                            <select name="rule3_1" <?php
    echo $disabled;
?>>

                            	<option value="0" <?php
    echo $rule3_1_0;
?>>N/A</option>

                                <option value="1" <?php
    echo $rule3_1_1;
?>>1</option>

                                <option value="2" <?php
    echo $rule3_1_2;
?>>2</option>

                                <option value="3" <?php
    echo $rule3_1_3;
?>>3</option>

                                <option value="4" <?php
    echo $rule3_1_4;
?>>4</option>

                                <option value="5" <?php
    echo $rule3_1_5;
?>>5</option>

                                <option value="6" <?php
    echo $rule3_1_6;
?>>6</option>

                                <option value="7" <?php
    echo $rule3_1_7;
?>>7</option>

                                <option value="8" <?php
    echo $rule3_1_8;
?>>8</option>

                                <option value="9" <?php
    echo $rule3_1_9;
?>>9</option>

                                <option value="10" <?php
    echo $rule3_1_10;
?>>10</option>

                                <option value="11" <?php
    echo $rule3_1_11;
?>>11</option>

                                <option value="12" <?php
    echo $rule3_1_12;
?>>12</option>

                                <option value="13" <?php
    echo $rule3_1_13;
?>>13</option>

                                <option value="14" <?php
    echo $rule3_1_14;
?>>14</option>

                                <option value="15" <?php
    echo $rule3_1_15;
?>>15</option>

                                <option value="16" <?php
    echo $rule3_1_16;
?>>16</option>

                                <option value="17" <?php
    echo $rule3_1_17;
?>>17</option>

                                <option value="19" <?php
    echo $rule3_1_18;
?>>18</option>

                                <option value="20" <?php
    echo $rule3_1_19;
?>>19</option>

                                <option value="21" <?php
    echo $rule3_1_20;
?>>20</option>

                                <option value="22" <?php
    echo $rule3_1_21;
?>>21</option>

                                <option value="23" <?php
    echo $rule3_1_22;
?>>22</option>

                                <option value="24" <?php
    echo $rule3_1_24;
?>>24</option>

                                <option value="25" <?php
    echo $rule3_1_25;
?>>25</option>

                                <option value="26" <?php
    echo $rule3_1_26;
?>>26</option>

                                <option value="27" <?php
    echo $rule3_1_27;
?>>27</option>

                                <option value="28" <?php
    echo $rule3_1_28;
?>>28</option>

                                <option value="29" <?php
    echo $rule3_1_29;
?>>29</option>

                                <option value="30" <?php
    echo $rule3_1_30;
?>>30</option>

							</select>

                            <?php
    if ($_SESSION[facility][rule3_2] == '0') {
        $rule3_2_1 = "selected = selected";
    } else {
        $rule3_2_2 = "selected = selected";
    }
?>

                            <select name="rule3_2" <?php
    echo $disabled;
?>>

                            	<option value="0" <?php
    echo $rule3_2_1;
?>>Week</option>

                                <option value="1" <?php
    echo $rule3_2_2;
?>>Month</option>

                            </select>

                            <?php
    if ($_SESSION[facility][rule3_3] == '0') {
        $rule3_3_1 = "selected = selected";
    } else {
        $rule3_3_2 = "selected = selected";
    }
?>

                            <select name="rule3_3" <?php
    echo $disabled;
?>>

                            	<option value="0" <?php
    echo $rule3_3_1;
?>>Peak Time</option>

                                <option value="1" <?php
    echo $rule3_3_2;
?>>Non-Peak Time</option>

                            </select>                            </td>

						</tr>

                        </table>

                        <? // somebody tell me why is this empty. Next time, if want to use dreamweaver, make sure you understand the code also. Dont be too dependent on the easy drag and drop features. 
?>

                        <div align="center">

                                          <label></label>

                                </div>

                                      </label>						</td>

					</tr>

                    <tr>

                    	<td colspan="3" bgcolor="#FDF5E1">&nbsp;</td>

                        <td colspan="5" bgcolor="#FDF5E1">&nbsp;</td>

                        <td colspan="3" bgcolor="#FDF5E1">&nbsp;</td>

                        <td colspan="2" bgcolor="#FDF5E1">&nbsp;</td>

                    </tr>

                    <tr>

                    	<td colspan="8" bgcolor="#FDF5E1">Booking Open From

                        <label></label>

                        <?php
    if ($_SESSION[facility][open_from] == '0') {
        $open_from_0 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '1') {
        $open_from_1 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '2') {
        $open_from_2 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '3') {
        $open_from_3 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '4') {
        $open_from_4 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '5') {
        $open_from_5 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '6') {
        $open_from_6 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '6') {
        $open_from_6 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '7') {
        $open_from_7 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '8') {
        $open_from_8 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '9') {
        $open_from_9 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '9') {
        $open_from_9 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '10') {
        $open_from_10 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '11') {
        $open_from_11 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '12') {
        $open_from_12 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '13') {
        $open_from_13 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '14') {
        $open_from_14 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '15') {
        $open_from_15 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '16') {
        $open_from_16 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '17') {
        $open_from_17 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '18') {
        $open_from_18 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '19') {
        $open_from_19 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '20') {
        $open_from_20 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '21') {
        $open_from_21 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '22') {
        $open_from_22 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '23') {
        $open_from_23 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '24') {
        $open_from_24 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '25') {
        $open_from_25 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '26') {
        $open_from_26 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '27') {
        $open_from_27 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '28') {
        $open_from_28 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '29') {
        $open_from_29 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '30') {
        $open_from_30 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '60') {
        $open_from_60 = "selected = selected";
    }
?>

                        <select name="open_from" <?php
    echo $disabled;
?>>

                        	<option value="0" <?php
    echo $open_from_0;
?>>N/A</option>

                            <option value="1" <?php
    echo $open_from_1;
?>>1</option>

                            <option value="2" <?php
    echo $open_from_2;
?>>2</option>

                            <option value="3" <?php
    echo $open_from_3;
?>>3</option>

                            <option value="4" <?php
    echo $open_from_4;
?>>4</option>

                            <option value="5" <?php
    echo $open_from_5;
?>>5</option>

                            <option value="6" <?php
    echo $open_from_6;
?>>6</option>

                            <option value="7" <?php
    echo $open_from_7;
?>>7</option>

                            <option value="8" <?php
    echo $open_from_8;
?>>8</option>

                            <option value="9" <?php
    echo $open_from_9;
?>>9</option>

                            <option value="10" <?php
    echo $open_from_10;
?>>10</option>

                            <option value="11" <?php
    echo $open_from_11;
?>>11</option>

                            <option value="12" <?php
    echo $open_from_12;
?>>12</option>

                            <option value="13" <?php
    echo $open_from_13;
?>>13</option>

                            <option value="14" <?php
    echo $open_from_14;
?>>14</option>

                            <option value="15" <?php
    echo $open_from_15;
?>>15</option>

                            <option value="16" <?php
    echo $open_from_16;
?>>16</option>

                            <option value="17" <?php
    echo $open_from_17;
?>>17</option>

                            <option value="19" <?php
    echo $open_from_18;
?>>18</option>

                            <option value="20" <?php
    echo $open_from_19;
?>>19</option>

                            <option value="21" <?php
    echo $open_from_20;
?>>20</option>

                            <option value="22" <?php
    echo $open_from_21;
?>>21</option>

                            <option value="23" <?php
    echo $open_from_22;
?>>22</option>

                            <option value="24" <?php
    echo $open_from_24;
?>>24</option>

                            <option value="25" <?php
    echo $open_from_25;
?>>25</option>

                            <option value="26" <?php
    echo $open_from_26;
?>>26</option>

                            <option value="27" <?php
    echo $open_from_27;
?>>27</option>

                            <option value="28" <?php
    echo $open_from_28;
?>>28</option>

                            <option value="29" <?php
    echo $open_from_29;
?>>29</option>

                            <option value="30" <?php
    echo $open_from_30;
?>>30</option>

						    <option value="60" <?php
    echo $open_from_60;
?>>60</option>

						</select>

                        Days and will be cancelled before

                        <?php
    if ($_SESSION[facility][closed_at] == '0') {
        $closed_at_0 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '1') {
        $closed_at_1 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '2') {
        $closed_at_2 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '3') {
        $closed_at_3 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '4') {
        $closed_at_4 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '5') {
        $closed_at_5 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '6') {
        $closed_at_6 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '6') {
        $closed_at_6 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '7') {
        $closed_at_7 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '8') {
        $closed_at_8 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '9') {
        $closed_at_9 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '9') {
        $closed_at_9 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '10') {
        $closed_at_10 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '11') {
        $closed_at_11 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '12') {
        $closed_at_12 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '13') {
        $closed_at_13 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '14') {
        $closed_at_14 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '15') {
        $closed_at_15 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '16') {
        $closed_at_16 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '17') {
        $closed_at_17 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '18') {
        $closed_at_18 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '19') {
        $closed_at_19 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '20') {
        $closed_at_20 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '21') {
        $closed_at_21 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '22') {
        $closed_at_22 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '23') {
        $closed_at_23 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '24') {
        $closed_at_24 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '25') {
        $closed_at_25 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '26') {
        $closed_at_26 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '27') {
        $closed_at_27 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '28') {
        $closed_at_28 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '29') {
        $closed_at_29 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '30') {
        $closed_at_30 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '48') {
        $closed_at_48 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '72') {
        $closed_at_72 = "selected = selected";
    }
?>

                        <select name="closed_at" <?php
    echo $disabled;
?>>

                        	<option value="0" <?php
    echo $closed_at_0;
?>>N/A</option>

                            <option value="1" <?php
    echo $closed_at_1;
?>>1</option>

                            <option value="2" <?php
    echo $closed_at_2;
?>>2</option>

                            <option value="3" <?php
    echo $closed_at_3;
?>>3</option>

                            <option value="4" <?php
    echo $closed_at_4;
?>>4</option>

                            <option value="5" <?php
    echo $closed_at_5;
?>>5</option>

                            <option value="6" <?php
    echo $closed_at_6;
?>>6</option>

                            <option value="7" <?php
    echo $closed_at_7;
?>>7</option>

                            <option value="8" <?php
    echo $closed_at_8;
?>>8</option>

                            <option value="9" <?php
    echo $closed_at_9;
?>>9</option>

                            <option value="10" <?php
    echo $closed_at_10;
?>>10</option>

                            <option value="11" <?php
    echo $closed_at_11;
?>>11</option>

                            <option value="12" <?php
    echo $closed_at_12;
?>>12</option>

                            <option value="13" <?php
    echo $closed_at_13;
?>>13</option>

                            <option value="14" <?php
    echo $closed_at_14;
?>>14</option>

                            <option value="15" <?php
    echo $closed_at_15;
?>>15</option>

                            <option value="16" <?php
    echo $closed_at_16;
?>>16</option>

                            <option value="17" <?php
    echo $closed_at_17;
?>>17</option>

                            <option value="19" <?php
    echo $closed_at_18;
?>>18</option>

                            <option value="20" <?php
    echo $closed_at_19;
?>>19</option>

                            <option value="21" <?php
    echo $closed_at_20;
?>>20</option>

                            <option value="22" <?php
    echo $closed_at_21;
?>>21</option>

                            <option value="23" <?php
    echo $closed_at_22;
?>>22</option>

                            <option value="24" <?php
    echo $closed_at_24;
?>>24</option>

                            <option value="25" <?php
    echo $closed_at_25;
?>>25</option>

                            <option value="26" <?php
    echo $closed_at_26;
?>>26</option>

                            <option value="27" <?php
    echo $closed_at_27;
?>>27</option>

                            <option value="28" <?php
    echo $closed_at_28;
?>>28</option>

                            <option value="29" <?php
    echo $closed_at_29;
?>>29</option>

                            <option value="30" <?php
    echo $closed_at_30;
?>>30</option>

                            <option value="48" <?php
    echo $closed_at_48;
?>>48</option>

                            <option value="72" <?php
    echo $closed_at_72;
?>>72</option>

						</select>

                        Hrs if not confirmed                        </td>

                        <td colspan="3" bgcolor="#FDF5E1">&nbsp;</td>

                        <td colspan="2" bgcolor="#FDF5E1">&nbsp;</td>

					</tr>

                    <tr>

                        <td colspan="13" bgcolor="#FDF5E1">&nbsp;</td>

					</tr>

              		<tr>

                    	<td colspan="10" bgcolor="#FDF5E1"><p>

                        <?php
    if ($_SESSION[facility][os] == 'time_based') {
        $os_2 = "checked=checked";
    } else {
        $os_1 = "checked=checked";
    }
?>

                        <label>Session Based

                        <input type="radio" name="os" value="sess" <?php
    echo $os_1;
?>  <?php
    echo $disabled;
?>>

                        </label>

                        <label>Time Based

                        <input type="radio" name="os" value="time_based" <?php
    echo $os_2;
?> <?php
    echo $disabled;
?>>

                        </label>

                        <label style="margin-bottom: 1em; padding-bottom: 1em; border-bottom: 3px silver groove;">

                        <input name="hidden" type="hidden" class="DEPENDS ON os BEING time_based OR os BEING sess">

                        </label>

                        <label>Hrs

                        <input type="hrs" name="hrs" class="CONFLICTS WITH apache AND DEPENDS ON os BEING time_based" maxlength="5" size="5"  tooltiptext="Define how many hours will be defined as one session. (e.g 4 , if you enter 4 then system will take one booking for 4 hour)" <?php
    echo $disabled;
?> value="<?php
    echo $_SESSION[facility][hrs];
?>">

                        </label>

                        <label style="margin-bottom: 1em; padding-bottom: 1em; border-bottom: 3px silver groove;">

                        <input name="hidden" type="hidden" class="CONFLICTS WITH pass BEING EMPTY">

                        </label>

                        </p>                        </td>

                        <td width="4%" bgcolor="#FDF5E1">&nbsp;</td>

                        <td width="1%" bgcolor="#FDF5E1">&nbsp;</td>

                        <td width="9%" bgcolor="#FDF5E1">&nbsp;</td>

					</tr>

                    <tr>

                    	<td colspan="13" bgcolor="#FCECC7">Auto Close Date

                    	<label>

                        <?php
    if ($_SESSION[facility][auto_close] == '1') {
        $auto_close_1 = "checked=checked";
    } else {
        $auto_close_1 = "";
    }
?>

                        <input type="checkbox" name="auto_close" value="1" <?php
    echo $disabled;
?> tooltiptext="Check this box if you want system to close the booking of this facilitie at given data on either every mont or year." <?php
    echo $auto_close_1;
?>>

                        </label>                        </td>

					</tr>

                    <tr>

                    	<td width="11%">From</td>

                        <td width="7%"><strong>:</strong></td>

                        <td width="20%"><label>

                        <input name="from_date" type="text" size="10" maxlength="10" readonly="" <?php
    echo $disabled;
?> value="<?php
    echo $_SESSION[facility][from_date];
?>">

                        <img src="images/icon-calender.gif" width="19" height="18"  onclick="displayCalendar(document.forms[0].from_date,'dd.mm.yyyy',this)" value="Cal"></label></td>

                        <td width="13%">&nbsp;</td>

                        <td width="7%">To</td>

                        <td width="3%"><strong>:</strong></td>

                        <td width="15%"><input name="to_date" type="text" size="10" maxlength="10" readonly="" <?php
    echo $disabled;
?> value="<?php
    echo $_SESSION[facility][to_date];
?>">

                        <img src="images/icon-calender.gif" width="19" height="18"  onclick="displayCalendar(document.forms[0].to_date,'dd.mm.yyyy',this)" value="Cal"></td>

                        <td width="6%"><div align="right">Frame</div></td>

                        <td width="1%"><strong>:</strong></td>

                        <td colspan="4"><label>

                        <?php
    if ($_SESSION[facility][frame] == '0') {
        $frame_1 = "selected = selected";
    } else {
        $frame_2 = "selected = selected";
    }
?>

                        <select name="frame" <?php
    echo $disabled;
?> tooltiptext="You want to disable this facilities on every month or every year of specified dates ?">

                        	<option value="0" <?php
    echo $frame_1;
?>>Month</option>

                            <option value="1" <?php
    echo $frame_2;
?>>Year</option>

                        </select>

                        </label>                        </td>

					</tr>

                    <tr>

                    	<td colspan="2">Message</td>

                        <td><label>

                        <input type="text" name="message" <?php
    echo $disabled;
?> value="<?php
    echo $_SESSION[facility][message];
?>" >

                        </label>                        </td>

                        <td colspan="2"><div align="right">Add to Calender </div></td>

                        <td><strong>:</strong></td>

                        <td><label>

                        <?php
    if ($_SESSION[facility][auto_cal] == '1') {
        $auto_cal = "checked=checked";
    } else {
        $auto_cal = "";
    }
?>

                        <input type="checkbox" name="auto_cal" value="1" <?php
    echo $disabled;
?> <?php
    echo $auto_cal;
?> tooltiptext="Check this box if you want system to display this event on calander.">

                        </label>                        </td>

                        <td colspan="6">&nbsp;</td>

                    </tr>

                    <tr>

                    	<td colspan="13" bgcolor="#944542" style="border-left:1px solid #b09852;border-right:1px solid #b09852; padding-left:15px; padding-top:5px; padding-bottom:5px;"><span class="fontitle"><strong>&nbsp;Barring Rules </strong></span></td>

					</tr>

                    <tr>

                    	<td colspan="13" style="border-left:0px solid #b09852;border-right:0px solid #b09852; padding-left:5px; padding-top:5px; padding-bottom:5px;">User will be barred from booking this facility for <select name="month_blocked">

                        <option value="0" selected>0</option>

                        <option value="1">1</option>

                        <option value="2">2</option>

                        <option value="3">3</option>

                        <option value="4">4</option>

                        <option value="5">5</option>

                        </select> month(s) if they are absent <select name="absent_amount"> 

                        <option value="0" selected>0</option>

                        <option value="1">1</option>

                        <option value="2">2</option>

                        <option value="3">3</option>

                        <option value="4">4</option>

                        <option value="5">5</option></select> times over a period of <select name="month_period"> <option value="0" selected>0</option>

                        <option value="1">1</option>

                        <option value="2">2</option>

                        <option value="3">3</option>

                        <option value="4">4</option>

                        <option value="5">5</option>

                        </select> month(s).</td>

					</tr>



					</table>                    </td>

				</tr>

                <tr>

                  <td colspan="13"><div align="right">

                    <label></label>

                    <input type="submit" name="Submit" value="Submit" <?php
    echo $disabled;
?>>

                    </div>                    <label></label></td>

                </tr>

                </table>

                </form>

                </td>

			</tr>

            <tr>

            	<td colspan="3">&nbsp;</td>

            </tr>

            </table>

            <p> 

            <?php
} elseif ($_GET[page] == 'view' and $user_type == '1') {
    if (isset($_GET[dele])) {
        $query = "update facility  set enable ='0' where sno = '$_GET[dele]' limit 1";
        mysql_query($query);
    }
?>

				<br>

              	<b>To place online bookings, please select the respective facility and click on [ Book Now ] Button. </b> </p>

		        <p><b><font color="#FF0000">Note:</font></b><br>

        		<font size="2">Please refer to the <a href="bylaws.php?crypted=<?
    echo $_GET['crypted'];
?>">By-Laws</a> for regulations and booking restrictions.</font><br>

            	</p>

            	<table width="100%" border="0" align="center" class="sk_bok_green" cellpadding="5" cellspacing="0">

              	<tr bgcolor="#FCECC7"> 

               		<td> 

                  	<div align="center"><strong>Sno.</strong></div>                </td>

                	<td style="border-left:1px solid #990011;"> 

                  	<div align="center"><strong>Facilities</strong></div>                </td>

                	<td style="border-left:1px solid #990011;"> 

                  	<div align="center"><strong>Type</strong></div>                </td>

                	<td style="border-left:1px solid #990011;"> 

                  	<div align="center"><strong>Deposit</strong></div>                </td>

                	<td style="border-left:1px solid #990011;"> 

                  	<div align="center"><strong>Action</strong></div>                </td>

              	</tr>

              	<?php
    $sr     = 1;
    $query  = "select * from facility  where enable ='1' ORDER BY name ASC";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result)) {
        $indooroutdoor = $row['type'];
        if ($row[deposite] > 0) {
            $deposite = $row[deposite];
            $deposite = "<font color=bue >SGD $deposite </font>";
        } else {
            $deposite = "<font color=green>Free</font>";
        }
        if ($row[os] == 'sess') {
            $type = "Session based";
        } else {
            $type = "Time Based";
        }
?>

              		<tr> 

                		<td width="4%" style="border-top:1px solid #990011;"> 

                  		<div align="center"> 

                    	<?php
        echo $sr;
?></div>                        </td>

                		<td width="31%" align="center" style="border-left:1px solid #990011; border-top:1px solid #990011;"><a href="booking.php?crypted=<?php
        echo $_GET[crypted];
?>&page=edit&facility=<?php
        echo $row[sno];
?>"> 

                  		<?php
        echo $row[name];
?>

                  		</a>                        </td>

                		<td width="20%" align="center" style="border-left:1px solid #990011; border-top:1px solid #990011;"> 

                  		<?php
        echo $type;
?>                </td>

                		<td width="19%" align="center" style="border-left:1px solid #990011; border-top:1px solid #990011;"> 

                  		<?php
        echo $deposite;
?>                </td>

                		<!--td style="border-left:1px solid #990011; border-top:1px solid #990011;"> 

                			<div align="center"><a href="booking.php?crypted=<?php // echo "$_GET[crypted]&page=group&group=$row[sno]"; 
?>">Grouping</a></div></td-->

                		<td style="border-left:1px solid #990011; border-top:1px solid #990011;"> 

                  		<div align="center"> <a href="booking.php?crypted=<?php
        echo $_GET[crypted];
?>&page=edit&facility=<?php
        echo $row[sno];
?>"> 

                  		Edit

                  		</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href=booking.php?crypted=<?php
        echo "$_GET[crypted]&page=view&dele=$row[sno]";
?> onClick="return confirm('Deleting this facility will affect the booking report. Are you sure you want to delete this facility?');"><font color="#993300">Delete</font></a></div>                		</td>

           		    </tr>

              		<?
        $sr++;
    }
?>

       		  </table>

            		<?
} elseif ($_GET[page] == 'view' and ($user_type == '0' || $user_type == '2')) {
?>

            	<p><b>To place online bookings, please select the respective facility and 

              	click on [ Book Now ] Button. </b> </p>

            	<p><b><font color="#FF0000">Note:</font></b><br>

              	<font size="2">Please refer to the <a href="bylaws.php?crypted=<?
    echo $_GET['crypted'];
?>">By-Laws</a> for regulations and booking restrictions.</font></p>

            	<table width="100%" border="0" align="center" class="sk_bok_green" height="100%" cellpadding="5" cellspacing="0">

              	<tr bgcolor="#FCECC7"> 

                	<td> 

                  	<div align="center"><strong>#</strong></div>

                	</td>

                	<td style="border-left:1px solid #990011;"> 

                  	<div align="center"><strong>Facilities</strong></div>

                	</td>

                	<td style="border-left:1px solid #990011;"> 

                  	<div align="center"><strong>Type</strong></div>

                	</td>

               	  <td style="border-left:1px solid #990011;"> 

                  	<div align="center"><strong>Deposit</strong></div>

               	  </td>

                </tr>

              	<?php
    $sr     = 1;
    $query  = "select * from facility where enable ='1' ORDER BY name ASC";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result)) {
        $indooroutdoor = $row['type'];
        if ($row[deposite] > 0) {
            $deposite = $row[deposite];
            $deposite = "<font color=bue >SGD $deposite </font>";
        } else {
            $deposite = "<font color=green>Free</font>";
        }
        if ($row[os] == 'sess') {
            $type = "Session based";
        } else {
            $type = "Time Based";
        }
?>

              	<tr> 

                	<td width="4%" style="border-top:1px solid #990011;"> 

                  	<div align="center"> 

                    <?php
        echo $sr;
?>

                  	</div>

                </td>

                <td width="31%" align="center" style="border-left:1px solid #990011; border-top:1px solid #990011;"> 

                  <?php
        echo $row[name];
?>

                </td>

                <td width="20%" align="center" style="border-left:1px solid #990011; border-top:1px solid #990011;"> 

                  <?php
        echo $type;
?>

                </td>

                <td width="19%" align="center" style="border-left:1px solid #990011; border-top:1px solid #990011;"> 

                  <?php
        echo $deposite;
?>

                </td>

            </tr>

            <?
        $sr++;
    }
?>

            </table>

            <?php
} elseif ($_GET[page] == 'edit' and $user_type == '1') {
    // print_r($_POST);
    $query = "select * from facility where  sno = '$_GET[facility]' and enable ='1' limit 1";
    $result = mysql_query($query) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        if (isset($_POST[name2])) {
            $_SESSION[facility] = $_POST;
        } else {
            $_SESSION[facility][name2]           = $row[name];
            $_SESSION[facility][type]            = $row[type];
            $_SESSION[facility][month_blocked]   = $row[month_blocked];
            $_SESSION[facility][absent_amount]   = $row[absent_amount];
            $_SESSION[facility][month_period]    = $row[month_period];
            $_SESSION[facility][deposite2]       = $row[deposite];
            $_SESSION[facility][auto2]           = $row[auto_apporve];
            //booking_per_day
            $_SESSION[facility][booking_per_day] = $row[max_booking_per_day];
            $_SESSION[facility][rule1_1]         = $row[rule1_1];
            $_SESSION[facility][rule1_2]         = $row[rule1_2];
            $_SESSION[facility][rule1_3]         = $row[rule1_3];
            $_SESSION[facility][logic_one]       = $row[relation_rule_1];
            $_SESSION[facility][rule2_1]         = $row[rule2_1];
            $_SESSION[facility][rule2_2]         = $row[rule2_2];
            $_SESSION[facility][rule2_3]         = $row[rule2_3];
            $_SESSION[facility][logic_two]       = $row[relation_rule_2];
            //$_SESSION[facility][logic_two] = $row[relation_rule_4];//Added by vasanth to add rules for tennis
            $_SESSION[facility][rule3_1]         = $row[rule3_1];
            $_SESSION[facility][rule3_2]         = $row[rule3_2];
            $_SESSION[facility][rule3_3]         = $row[rule3_3];
            $_SESSION[facility][os]              = $row[os];
            $_SESSION[facility][from]            = $row[from_time];
            $_SESSION[facility]['max']           = $row[max_time];
            $_SESSION[facility][hrs]             = $row[hours];
            $_SESSION[facility][open_from]       = $row[open_from];
            $_SESSION[facility][closed_at]       = $row[closed_at];
            $_SESSION[facility][auto_close]      = $row[auto_close_date];
            $_SESSION[facility][from_date]       = $row[from_date];
            $_SESSION[facility][to_date]         = $row[to_date];
            $_SESSION[facility][frame]           = $row[frame];
            $_SESSION[facility][auto_cal]        = $row[auto_cal];
            $_SESSION[facility][message]         = $row[message];
        }
        $date          = $row[created_on];
        $unique_no     = $row[unique_no];
        $type          = $row[type];
        $month_blocked = $row[month_blocked];
        $absent_amount = $row[absent_amount];
        $month_period  = $row[month_period];
        /*Code added to display Advanced Booking period*/
        $_fac_id       = (int) $_GET['facility'];
        $sql           = "SELECT num_days FROM `advance_booking`  WHERE facility_id='$_fac_id'";
        $res_adv       = mysql_query($sql);
        $row_adv       = mysql_fetch_array($res_adv);
        $adv_book_days = $row_adv['num_days'];
        /*Code added to display Advanced Booking period*/
    }
    if (isset($_POST[Submit2])) {
        $query = "update facility set name ='$_POST[name2]',deposite ='$_POST[deposite2]',auto_apporve  = '$_POST[auto2]',max_booking_per_day ='$_POST[booking_per_day]',rule1_1 ='$_POST[rule1_1]',rule1_2 ='$_POST[rule1_2]',rule1_3 ='$_POST[rule1_3]',relation_rule_1='$_POST[logic_one]',rule2_1 = '$_POST[rule2_1]',rule2_2 ='$_POST[rule2_2]',rule2_3 = '$_POST[rule2_3]',relation_rule_2='$_POST[logic_two]',rule3_1 ='$_POST[rule3_1]', rule3_2 ='$_POST[rule3_2]',rule3_3 ='$_POST[rule3_3]',open_from ='$_POST[open_from]',closed_at ='$_POST[closed_at]',os ='$_POST[os]',from_time ='$_POST[from]',max_time ='$_POST[max]',hours ='$_POST[hrs]',auto_close_date ='$_POST[auto_close]',auto_close_start_day ='$_POST[hrs]',auto_close_date  = '$_POST[auto_close]',auto_close_start_day  ='',auto_close_start_month ='',auto_close_start_year ='',auto_close_end_day ='',auto_close_end_month ='',auto_close_end_year ='',from_date ='$_POST[from_date]',to_date ='$_POST[to_date]',frame='$_POST[frame]',message ='$_POST[message]',auto_cal ='$_POST[auto_cal]',type ='$_POST[type]',month_blocked ='$_POST[month_blocked]',absent_amount ='$_POST[absent_amount]',month_period ='$_POST[month_period]' where unique_no = '$unique_no' limit 1";
        mysql_query($query) or die(mysql_error());
        /*Code added to set Advanced Booking period*/
        $_fac_id       = (int) $_GET['facility'];
        $adv_book_days = (int) $_POST['adv_book_days'];
        $sql           = "UPDATE `advance_booking`  SET 	num_days='$adv_book_days' WHERE facility_id='$_fac_id'";
        mysql_query($sql);
        /*Code added to set Advanced Booking period*/
        $dayfromenter   = explode(".", $_POST['from_date']);
        $dayenterfrom   = $dayfromenter[0];
        $monthenterfrom = $dayfromenter[1];
        $yearenterfrom  = $dayfromenter[2];
        $daytoenter     = explode(".", $_POST['to_date']);
        $dayenterto     = $daytoenter[0];
        $monthenterto   = $daytoenter[1];
        $yearenterto    = $daytoenter[2];
        if ($_POST[auto_cal] == 1) {
            // check first if have same day entry
            $query     = "SELECT * FROM calender_event WHERE heading = '$_POST[message]' AND day = '$dayenterfrom' AND month_no = '$monthenterfrom' AND year = '$yearenterfrom'";
            $resulting = mysql_query($query);
            $foundalso = mysql_num_rows($resulting);
            if ($foundalso == 0) {
                $query = "select * from user_account  where crypted  = '$_GET[crypted]' and id = '$s_id' limit 1";
                $result = mysql_query($query) or die(mysql_error());
                //$count = mysql_num_rows($result);
                $row   = mysql_fetch_array($result);
                $id    = $row[id];
                $query = "insert into calender_event (uid,heading,details,day,month_no,year) values ('$id','$_POST[message]','$_POST[name2]','$dayenterfrom','$monthenterfrom','$yearenterfrom')";
                mysql_query($query);
                // insert
            } else {
                $foundfrom = mysql_fetch_array($resulting);
                $query     = "select * from user_account  where crypted  = '$_GET[crypted]' and id = '$s_id' limit 1";
                $result = mysql_query($query) or die(mysql_error());
                //$count = mysql_num_rows($result);
                $row   = mysql_fetch_array($result);
                $id    = $row[id];
                $query = "update calender_event set uid='$id',heading = '$_POST[message]',details='$_POST[name2]' where sno ='$foundfrom[sno]' ";
                mysql_query($query);
                // update
            }
            $query     = "SELECT * FROM calender_event WHERE heading = '$_POST[message]' AND day = '$dayenterto' AND month_no = '$monthenterto' AND year = '$yearenterto'";
            $resulting = mysql_query($query);
            $foundalso = mysql_num_rows($resulting);
            if ($foundalso == 0) {
                $query = "select * from user_account  where crypted  = '$_GET[crypted]' and id = '$s_id' limit 1";
                $result = mysql_query($query) or die(mysql_error());
                //$count = mysql_num_rows($result);
                $row   = mysql_fetch_array($result);
                $id    = $row[id];
                $query = "insert into calender_event (uid,heading,details,day,month_no,year) values ('$id','$_POST[message]','$_POST[name2]','$dayenterto','$monthenterto','$yearenterto')";
                mysql_query($query);
                // insert
            } else {
                $foundfrom = mysql_fetch_array($resulting);
                $query     = "select * from user_account  where crypted  = '$_GET[crypted]' and id = '$s_id' limit 1";
                $result = mysql_query($query) or die(mysql_error());
                //$count = mysql_num_rows($result);
                $row   = mysql_fetch_array($result);
                $id    = $row[id];
                $query = "update calender_event set uid='$id',heading = '$_POST[message]',details='$_POST[name2]' where sno ='$foundfrom[sno]' ";
                mysql_query($query);
                // update
            }
        }
    }
    if (isset($_POST[down2])) {
        if ($_POST[from_time2] > $_POST[to_time2]) {
            $er = 1;
        } else {
            $query = "select * from track_time where track = '$unique_no'";
            $result = mysql_query($query) or die(mysql_error());
            while ($row = mysql_fetch_array($result)) {
                if (($_POST[from_time2] < $row[to_time]) and ($_POST[week2] == '0' or $_POST[week2] == $row[weak])) {
                    echo $er = 1;
                }
            }
        }
        //print_r($_POST);
        if ($er != '1') {
            $query = "insert into track_time (track,from_time,to_time,peak,weak) values ('$unique_no','$_POST[from_time2]','$_POST[to_time2]','$_POST[peak2]','$_POST[week2]')";
            mysql_query($query);
        } else {
            echo "<div align=center><font color=red>Either The time range is already in use or the time range is not right</font></div>";
        }
    }
?>

                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

                <tr>

                	<td style="background-repeat:no-repeat"><div align="right"><img src="images/left_win_10.gif" width="21" height="30" border="0"></div></td>

                    <td width="100%" background="images/middle_win_11.gif"><span class="fontitle style1"><strong>Edit Facilities</strong></span></td>

                    <td><img src="images/right_win_14.gif" width="17" height="30"></td>

                </tr>

                <tr>

                	<td colspan="3"><form name="form" method="post" action="">

                    <table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">

                    <tr>

                    	<td colspan="13" bgcolor="#944542" class="fontitle txtgrey" style="border-left:1px solid #b09852;border-right:1px solid #b09852; padding-left:15px; padding-top:5px; padding-bottom:5px;"><span class="fontitle">&nbsp;<strong>Basic Details </strong></span></td>

                    </tr>

                    <tr>

                    	<td style="padding-left:15px; padding-top:5px; padding-bottom:5px; border-left:1px solid #990011;"> Name </td>

                        <td style="padding-left:15px; padding-top:5px; padding-bottom:5px;"><strong>:</strong></td>

                        <td colspan="5" style="padding-left:15px; padding-top:5px; padding-bottom:5px;"><label>

                        <input name="name2" type="text" value="<?php
    echo $_SESSION[facility][name2];
?>" tooltipText="Type In Facilite Name Here (e.g: Tennies Court)" >

                        </label></td>

                        <td style="padding-left:15px; padding-top:5px; padding-bottom:5px;"><div align="right">Creation Date </div></td>

                        <td width="6"><strong>:</strong></td>

                        <td width="247" style="border-right:0px solid #990011;"><b> <?php
    echo $date;
?></td>

					    <td width="46" style="border-right:0px solid #990011;">Type</td>

					    <td width="5" style="border-right:0px solid #990011;"><strong>:</strong></td>

                        <td width="121" style="border-right:1px solid #990011;"><select name="type">

                    <option value="0" <?
    if ($_SESSION[facility][type] == '0') {
        echo "selected";
    }
?>>Indoor</option>

                    <option value="1" <?
    if ($_SESSION[facility][type] == '1') {
        echo "selected";
    }
?>>Outdoor</option>

                    </select></td>

                    </tr>

                    <tr>

                    	<td colspan="13" bgcolor="#944542" style="border-left:1px solid #b09852;border-right:1px solid #b09852; padding-left:15px; padding-top:5px; padding-bottom:5px;"><span class="fontitle"><strong>&nbsp;Booking Time Range </strong></span></td>

					</tr>

                    <tr>

                    	<td colspan="13" style="border-left:1px solid #990011; border-right:1px solid #990011;">

                        <table width="100%" border="0" align="center">

                    	<tr>

                        	<td>

                            <table width="100%" border="0" align="center">

                            <tr>

                            <td width="8%" style="padding-left:10px;">From </td>

                            <td width="1%"><strong>:</strong></td>

                            <td width="9%"><label></label>

                            <label>

                            <select name="from_time2" tooltipText="Select the start timing of the facility. (e.g: if the faility is open from morning 10:00 AM then select 10:00 from drop down option)">

                            <?php
    $query  = "select * from time_slot ";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result)) {
        echo "<option value=$row[id]>$row[time_slot]</option>";
    }
?>

                            </select>

                            </label></td>

                            <td width="4%">To </td>

                            <td width="1%"><strong>:</strong></td>

                            <td width="12%"><label>

                            <select name="to_time2" tooltipText="Select the closing timing of the facility. (e.g: if the faility closes at evening 10:00 PM then select 22:00 from drop down option)">

                            <?php
    $query  = "select * from time_slot ";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result)) {
        echo "<option value=$row[id]>$row[time_slot]</option>";
    }
?>

                            </select>

                            </label></td>

                            <td width="7%"><label>Type</label></td>

                            <td width="2%"><strong>:</strong></td>

                            <td width="16%">

                            <select name="peak2" tooltipText="Do you want to take this time range as Peak Time or Non-Peak Time, Tip : Remmber you can enter more then one open and close time of a facilities and decalre any time range as Peak Time or Non-Peak Time. ">

                            	<option value="1">Peak Time</option>

                                <option value="0" selected>Non-Peak Time</option>

                            </select></td>

                            <td width="17%"><div align="right">

                            <select name="week2" tooltiptext="After you have selected the time range, you can define this range to specify day of week or all week. Please note that system will verify the range and mis-conflict of time range for you.">

                            	<option value="0" selected>All Week</option>

                                <option value="1">Sunday</option>

                                <option value="2">Monday</option>

                                <option value="3">Tuesday</option>

                                <option value="4">Wednesday</option>

                                <option value="5">Thursday</option>

                                <option value="6">Friday</option>

                                <option value="7">Saturday</option>

                            </select>

                            </div></td>

                            <td width="23%"><div align="left">

                            <input type="submit" name="down2" value="V">

                            </div></td>

						</tr>

                        </table>                        </td>

					</tr>

                    </table>

                    <?php
    //	 print_r($_POST);
    if (isset($_POST[Delete2])) {
        $delete = explode('x', $_POST[Delete2]);
        //	print_r($delete);
        mysql_query("delete from track_time where sno = '$delete[1]' limit 1") or die(mysql_error());
    }
    $query  = "select * from track_time where track = '$unique_no'";
    $result = mysql_query($query);
    $count  = mysql_num_rows($result);
    if ($count == '0') {
        $disabled = "disabled = disabled";
    }
    if ($count == '1') {
        $dis = "disabled = disabled";
    }
    if ($count >= '1') {
?>

                    <table width="100%" border="0" align="center" class="sk_bok" cellspacing="0" cellpadding="5">

                    <tr>

                        <td width="4%" bgcolor="#FCECC7"><div align="center"><strong>#</strong></div></td>

                        <td width="23%" bgcolor="#FCECC7" style="border-left:1px solid #990011;"><div align="center"><strong>From</strong></div></td>

                        <td width="23%" bgcolor="#FCECC7" style="border-left:1px solid #990011;"><div align="center"><strong>To</strong></div></td>

                        <td width="21%" bgcolor="#FCECC7" style="border-left:1px solid #990011;"><div align="center"><strong>Peak / Non Peak</strong> </div></td>

                        <td width="21%" bgcolor="#FCECC7" style="border-left:1px solid #990011;"><div align="center"><strong>Week</strong></div></td>

                    </tr>

                    <?php
        $sr = 1;
        while ($row = mysql_fetch_array($result)) {
            $query1  = "select * from time_slot where id ='$row[from_time]' limit 1";
            $result1 = mysql_query($query1);
            while ($row1 = mysql_fetch_array($result1)) {
                $from_time = $row1[time_slot];
            }
            $query1  = "select * from time_slot where id ='$row[to_time]' limit 1";
            $result1 = mysql_query($query1);
            while ($row1 = mysql_fetch_array($result1)) {
                $to_time = $row1[time_slot];
            }
?>

                        <tr align="center">

                        	<td style="border-top:1px solid #990011;"><?php
            echo $sr;
?></td>

                            <td style="border-left:1px solid #990011; border-top:1px solid #990011;"><?php
            echo "$from_time";
?></td>

                            <td style="border-left:1px solid #990011; border-top:1px solid #990011;"><?php
            echo "$to_time ";
?></td>

                            <td style="border-left:1px solid #990011; border-top:1px solid #990011;"><?php
            if ($row[peak] == '1') {
                echo "Peak Hour";
            } else {
                echo "Non - Peak Hour";
            }
?>                            </td>

                            <td style="border-left:1px solid #990011; border-top:1px solid #990011;"><?php
            if ($row[weak] == '0') {
                echo "All Week";
            } elseif ($row[weak] == '1') {
                echo "Sunday";
            } elseif ($row[weak] == '2') {
                echo "Monday";
            } elseif ($row[weak] == '3') {
                echo "Tuesday";
            } elseif ($row[weak] == '4') {
                echo "Wednesday";
            } elseif ($row[weak] == '5') {
                echo "Thursday";
            } elseif ($row[weak] == '6') {
                echo "Friday";
            } elseif ($row[weak] == '7') {
                echo "Saturday";
            }
?>                            </td>

                        </tr>

                        <?php
            $sr++;
        }
?>

                        </table>

                        <?php
    }
?>

						<script type="text/javascript">

                            window.onload = function() {

                            setupDependencies('form'); //name of form(s). Seperate each with a comma (ie: 'weboptions', 'myotherform' )

      };

                        </script>

                        <br>						</td>

					</tr>

                    <tr>

                    	<td colspan="13" bgcolor="#944542" style="border-left:1px solid #b09852;border-right:1px solid #b09852; padding-left:15px; padding-top:5px; padding-bottom:5px;"><span class="fontitle"><strong>&nbsp;Advance Rules </strong></span></td>

					</tr>

                    <tr>

                    	<td colspan="13" style="border-left:1px solid #990011; border-right:1px solid #990011; border-bottom:1px solid #990011;">

                        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">

                        <tr>

                        	<td>Deposit(SGD)</td>

                            <td><strong>:</strong></td>

                            <td><input name="deposite2" type="text" value="<?php
    echo $_SESSION[facility][deposite2];
?>" size="5" maxlength="5" tooltipText="Enter the amount which will be displayed to user while booking the facilities and recipt of same will be issued, If the amount is ZERO then it will be consider as NO CHARGES" <?php
    echo $disabled;
?>></td>

                            <td><div align="right">Auto Approve </div></td>

                            <td><strong>:</strong></td>

                            <td colspan="8"><?php
    if ($_SESSION[facility][auto2] == '1') {
        $checked = "checked";
    } else {
        $checked = "";
    }
?>

                            <input name="auto2" type="checkbox" value="1" <?php
    echo $checked;
?> tooltipText="Do you want system to auto aprove the booking as soon as it is requested" <?php
    echo $disabled;
?>></td>

                            </tr>

                        <tr>

                        	<td colspan="13" bgcolor="#FCECC7">Limit : </td>

						</tr>

                        <tr>

                        	<td colspan="13">

                            <table width="100%" border="0" class="sk_bok" cellpadding="5" cellspacing="0">

                            <tr>

                            	<td width="31%">Maximum Booking Allowed Per Day </td>

                                <td width="39%"><?php
    if ($_SESSION[facility][booking_per_day] == '1') {
        $sel1 = "selected = selected";
    } elseif ($_SESSION[facility][booking_per_day] == '2') {
        $sel2 = "selected = selected";
    } elseif ($_SESSION[facility][booking_per_day] == '3') {
        $sel3 = "selected = selected";
    } elseif ($_SESSION[facility][booking_per_day] == '4') {
        $sel4 = "selected = selected";
    } elseif ($_SESSION[facility][booking_per_day] == '5') {
        $sel5 = "selected = selected";
    } elseif ($_SESSION[facility][booking_per_day] == '6') {
        $sel6 = "selected = selected";
    }
?>

                                <select name="booking_per_day" <?php
    echo $disabled;
?>>

                                	<option value="1" <?php
    echo $sel1;
?>>1 Booking Per Day</option>

                                    <option value="2" <?php
    echo $sel2;
?>>2 Booking Per Day</option>

                                    <option value="3" <?php
    echo $sel3;
?>>3 Booking Per Day</option>

                                    <option value="4" <?php
    echo $sel4;
?>>4 Booking Per Day</option>

                                    <option value="5" <?php
    echo $sel5;
?>>5 Booking Per Day</option>

                                    <option value="6" <?php
    echo $sel6;
?>>6 Booking Per Day</option>

								</select></td>

                                <td width="30%" rowspan="6" valign="top"><div align="justify">Note : <br>

                                              All rules and limit will be ignored below the step where N/A is selected. For example if you have selected Rule 1 as N/A in first drop down box then Rule 2 and rule 3 will be ignored. </div></td>

							</tr>

                            <tr>

                            	<td>Rule 1 </td>

                                <td><?php
    if ($_SESSION[facility][rule1_1] == '0') {
        $selrule1_0 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '1') {
        $selrule1_1 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '2') {
        $selrule1_2 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '3') {
        $selrule1_3 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '4') {
        $selrule1_4 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '5') {
        $selrule1_5 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '6') {
        $selrule1_6 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '6') {
        $selrule1_6 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '7') {
        $selrule1_7 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '8') {
        $selrule1_8 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '9') {
        $selrule1_9 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '9') {
        $selrule1_9 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '10') {
        $selrule1_10 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '11') {
        $selrule1_11 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '12') {
        $selrule1_12 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '13') {
        $selrule1_13 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '14') {
        $selrule1_14 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '15') {
        $selrule1_15 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '16') {
        $selrule1_16 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '17') {
        $selrule1_17 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '18') {
        $selrule1_18 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '19') {
        $selrule1_19 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '20') {
        $selrule1_20 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '21') {
        $selrule1_21 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '22') {
        $selrule1_22 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '23') {
        $selrule1_23 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '24') {
        $selrule1_24 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '25') {
        $selrule1_25 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '26') {
        $selrule1_26 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '27') {
        $selrule1_27 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '28') {
        $selrule1_28 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '29') {
        $selrule1_29 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_1] == '30') {
        $selrule1_30 = "selected = selected";
    }
?>

                                <select name="rule1_1" <?php
    echo $disabled;
?>>

                                      <option value="0" <?php
    echo $selrule1_0;
?>>N/A</option>

                                      <option value="1" <?php
    echo $selrule1_1;
?>>1</option>

                                      <option value="2" <?php
    echo $selrule1_2;
?>>2</option>

                                      <option value="3" <?php
    echo $selrule1_3;
?>>3</option>

                                      <option value="4" <?php
    echo $selrule1_4;
?>>4</option>

                                      <option value="5" <?php
    echo $selrule1_5;
?>>5</option>

                                      <option value="6" <?php
    echo $selrule1_6;
?>>6</option>

                                      <option value="7" <?php
    echo $selrule1_7;
?>>7</option>

                                      <option value="8" <?php
    echo $selrule1_8;
?>>8</option>

                                      <option value="9" <?php
    echo $selrule1_9;
?>>9</option>

                                      <option value="10" <?php
    echo $selrule1_10;
?>>10</option>

                                      <option value="11" <?php
    echo $selrule1_11;
?>>11</option>

                                      <option value="12" <?php
    echo $selrule1_12;
?>>12</option>

                                      <option value="13" <?php
    echo $selrule1_13;
?>>13</option>

                                      <option value="14" <?php
    echo $selrule1_14;
?>>14</option>

                                      <option value="15" <?php
    echo $selrule1_15;
?>>15</option>

                                      <option value="16" <?php
    echo $selrule1_16;
?>>16</option>

                                      <option value="17" <?php
    echo $selrule1_17;
?>>17</option>

                                      <option value="19" <?php
    echo $selrule1_18;
?>>18</option>

                                      <option value="20" <?php
    echo $selrule1_19;
?>>19</option>

                                      <option value="21" <?php
    echo $selrule1_20;
?>>20</option>

                                      <option value="22" <?php
    echo $selrule1_21;
?>>21</option>

                                      <option value="23" <?php
    echo $selrule1_22;
?>>22</option>

                                      <option value="24" <?php
    echo $selrule1_24;
?>>24</option>

                                      <option value="25" <?php
    echo $selrule1_25;
?>>25</option>

                                      <option value="26" <?php
    echo $selrule1_26;
?>>26</option>

                                      <option value="27" <?php
    echo $selrule1_27;
?>>27</option>

                                      <option value="28" <?php
    echo $selrule1_28;
?>>28</option>

                                      <option value="29" <?php
    echo $selrule1_29;
?>>29</option>

                                      <option value="30" <?php
    echo $selrule1_30;
?>>30</option>

									</select>

                                    <select name="rule1_2" <?php
    echo $disabled;
?>>

                                    <?php
    if ($_SESSION[facility][rule1_2] == '0') {
        $sel_rule2_1 = "selected = selected";
    } else {
        $sel_rule2_2 = "selected = selected";
    }
?>

                                    	<option value="0" <?php
    echo $sel_rule2_1;
?>>Week</option>

                                        <option value="1" <?php
    echo $sel_rule2_2;
?>>Month</option>

									</select>

                                    <?php
    if ($_SESSION[facility][rule1_3] == '0') {
        $rule1_3_1 = "selected = selected";
    } elseif ($_SESSION[facility][rule1_3] == '1') {
        $rule1_3_2 = "selected = selected";
    } else {
        $rule1_3_3 = "selected = selected";
    }
?>

                                    <select name="rule1_3" <?php
    echo $disabled;
?>>

										<option value="0"  <?php
    echo $rule1_3_1;
?>>Peak Time</option>

                                        <option value="1" <?php
    echo $rule1_3_2;
?>>Non-Peak Time</option>

                                        <option value="2" <?php
    echo $rule1_3_3;
?>>Any Time</option>

                                    </select></td>

                                </tr>

                                <tr>

	                                <td>Relation with Rule 1 </td>

                                    <td><?php
    if ($_SESSION[facility][logic_one] == '0') {
        $logic_one_1 = "selected = selected";
    } else {
        $logic_one_2 = "selected = selected";
    }
?>

                                    <select name="logic_one" <?php
    echo $disabled;
?>>

                                        <option value="0" <?php
    echo $logic_one_1;
?>>and</option>

                                        <option value="1" <?php
    echo $logic_one_2;
?>>or</option>

                                    </select></td>

								</tr>

                                <tr>

                                	<td>Rule 2 </td>

                                    <td><?php
    if ($_SESSION[facility][rule2_1] == '0') {
        $rule2_1_0 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '1') {
        $rule2_1_1 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '2') {
        $rule2_1_2 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '3') {
        $rule2_1_3 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '4') {
        $rule2_1_4 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '5') {
        $rule2_1_5 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '6') {
        $rule2_1_6 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '6') {
        $rule2_1_6 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '7') {
        $rule2_1_7 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '8') {
        $rule2_1_8 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '9') {
        $rule2_1_9 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '9') {
        $rule2_1_9 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '10') {
        $rule2_1_10 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '11') {
        $rule2_1_11 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '12') {
        $rule2_1_12 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '13') {
        $rule2_1_13 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '14') {
        $rule2_1_14 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '15') {
        $rule2_1_15 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '16') {
        $rule2_1_16 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '17') {
        $rule2_1_17 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '18') {
        $rule2_1_18 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '19') {
        $rule2_1_19 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '20') {
        $rule2_1_20 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '21') {
        $rule2_1_21 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '22') {
        $rule2_1_22 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '23') {
        $rule2_1_23 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '24') {
        $rule2_1_24 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '25') {
        $rule2_1_25 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '26') {
        $rule2_1_26 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '27') {
        $rule2_1_27 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '28') {
        $rule2_1_28 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '29') {
        $rule2_1_29 = "selected = selected";
    } elseif ($_SESSION[facility][rule2_1] == '30') {
        $rule2_1_30 = "selected = selected";
    }
?>

                                    <select name="rule2_1" <?php
    echo $disabled;
?>>

                                    	<option value="0" <?php
    echo $rule2_1_0;
?>>N/A</option>

                                        <option value="1" <?php
    echo $rule2_1_1;
?>>1</option>

										<option value="2" <?php
    echo $rule2_1_2;
?>>2</option>

                                        <option value="3" <?php
    echo $rule2_1_3;
?>>3</option>

                                        <option value="4" <?php
    echo $rule2_1_4;
?>>4</option>

                                        <option value="5" <?php
    echo $rule2_1_5;
?>>5</option>

                                        <option value="6" <?php
    echo $rule2_1_6;
?>>6</option>

                                        <option value="7" <?php
    echo $rule2_1_7;
?>>7</option>

                                        <option value="8" <?php
    echo $rule2_1_8;
?>>8</option>

                                        <option value="9" <?php
    echo $rule2_1_9;
?>>9</option>

                                        <option value="10" <?php
    echo $rule2_1_10;
?>>10</option>

                                        <option value="11" <?php
    echo $rule2_1_11;
?>>11</option>

                                        <option value="12" <?php
    echo $rule2_1_12;
?>>12</option>

                                        <option value="13" <?php
    echo $rule2_1_13;
?>>13</option>

                                       	<option value="14" <?php
    echo $rule2_1_14;
?>>14</option>

                                       	<option value="15" <?php
    echo $rule2_1_15;
?>>15</option>

                                       	<option value="16" <?php
    echo $rule2_1_16;
?>>16</option>

                                       	<option value="17" <?php
    echo $rule2_1_17;
?>>17</option>

                                       	<option value="19" <?php
    echo $rule2_1_18;
?>>18</option>

                                       	<option value="20" <?php
    echo $rule2_1_19;
?>>19</option>

                                       	<option value="21" <?php
    echo $rule2_1_20;
?>>20</option>

                                       	<option value="22" <?php
    echo $rule2_1_21;
?>>21</option>

                                       	<option value="23" <?php
    echo $rule2_1_22;
?>>22</option>

                                       	<option value="24" <?php
    echo $rule2_1_24;
?>>24</option>

                                       	<option value="25" <?php
    echo $rule2_1_25;
?>>25</option>

                                       	<option value="26" <?php
    echo $rule2_1_26;
?>>26</option>

                                       	<option value="27" <?php
    echo $rule2_1_27;
?>>27</option>

                                       	<option value="28" <?php
    echo $rule2_1_28;
?>>28</option>

                                       	<option value="29" <?php
    echo $rule2_1_29;
?>>29</option>

                                       	<option value="30" <?php
    echo $rule2_1_30;
?>>30</option>

									</select>

                                    <?php
    if ($_SESSION[facility][rule2_2] == '0') {
        $rule2_2_1 = "selected = selected";
    } else {
        $rule2_2_2 = "selected = selected";
    }
?>

                                    <select name="rule2_2" <?php
    echo $disabled;
?>>

                                    	<option value="0" <?php
    echo $rule2_2_1;
?>>Week</option>

                                        <option value="1" <?php
    echo $rule2_2_2;
?>>Month</option>

                                    </select>

                                    <?php
    if ($_SESSION[facility][rule2_3] == '0') {
        $rule2_3_1 = "selected = selected";
    } else {
        $rule2_3_2 = "selected = selected";
    }
?>

                                    <select name="rule2_3" <?php
    echo $disabled;
?>>

                                    	<option value="0" <?php
    echo $rule2_3_1;
?>>Peak Time</option>

                                        <option value="1" <?php
    echo $rule2_3_2;
?>>Non-Peak Time</option>

                                    </select>                                    </td>

								</tr>

                                <tr>

                                	<td>Relation with rule 2 </td>

                                    <td><?php
    if ($_SESSION[facility][logic_two] == '0') {
        $logic_two_1 = "selected = selected";
    } else {
        $logic_two_2 = "selected = selected";
    }
?>

                                    <select name="logic_two" <?php
    echo $disabled;
?>>

                                    	<option value="0" <?php
    echo $logic_two_1;
?>>and</option>

										<option value="1" <?php
    echo $logic_two_2;
?>>or</option>

                                    </select></td>

                                </tr>

                                <tr>

	                                <td>Rule 3 </td>

                                    <td><?php
    if ($_SESSION[facility][rule3_1] == '0') {
        $rule3_1_0 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '1') {
        $rule3_1_1 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '2') {
        $rule3_1_2 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '3') {
        $rule3_1_3 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '4') {
        $rule3_1_4 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '5') {
        $rule3_1_5 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '6') {
        $rule3_1_6 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '6') {
        $rule3_1_6 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '7') {
        $rule3_1_7 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '8') {
        $rule3_1_8 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '9') {
        $rule3_1_9 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '9') {
        $rule3_1_9 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '10') {
        $rule3_1_10 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '11') {
        $rule3_1_11 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '12') {
        $rule3_1_12 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '13') {
        $rule3_1_13 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '14') {
        $rule3_1_14 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '15') {
        $rule3_1_15 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '16') {
        $rule3_1_16 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '17') {
        $rule3_1_17 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '18') {
        $rule3_1_18 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '19') {
        $rule3_1_19 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '20') {
        $rule3_1_20 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '21') {
        $rule3_1_21 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '22') {
        $rule3_1_22 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '23') {
        $rule3_1_23 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '24') {
        $rule3_1_24 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '25') {
        $rule3_1_25 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '26') {
        $rule3_1_26 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '27') {
        $rule3_1_27 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '28') {
        $rule3_1_28 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '29') {
        $rule3_1_29 = "selected = selected";
    } elseif ($_SESSION[facility][rule3_1] == '30') {
        $rule3_1_30 = "selected = selected";
    }
?>

                                    <select name="rule3_1" <?php
    echo $disabled;
?>>

                                    	<option value="0" <?php
    echo $rule3_1_0;
?>>N/A</option>

                                        <option value="1" <?php
    echo $rule3_1_1;
?>>1</option>

                                        <option value="2" <?php
    echo $rule3_1_2;
?>>2</option>

                                        <option value="3" <?php
    echo $rule3_1_3;
?>>3</option>

                                        <option value="4" <?php
    echo $rule3_1_4;
?>>4</option>

                                        <option value="5" <?php
    echo $rule3_1_5;
?>>5</option>

                                        <option value="6" <?php
    echo $rule3_1_6;
?>>6</option>

                                        <option value="7" <?php
    echo $rule3_1_7;
?>>7</option>

                                        <option value="8" <?php
    echo $rule3_1_8;
?>>8</option>

                                        <option value="9" <?php
    echo $rule3_1_9;
?>>9</option>

                                        <option value="10" <?php
    echo $rule3_1_10;
?>>10</option>

                                        <option value="11" <?php
    echo $rule3_1_11;
?>>11</option>

                                        <option value="12" <?php
    echo $rule3_1_12;
?>>12</option>

                                        <option value="13" <?php
    echo $rule3_1_13;
?>>13</option>

                                        <option value="14" <?php
    echo $rule3_1_14;
?>>14</option>

                                        <option value="15" <?php
    echo $rule3_1_15;
?>>15</option>

                                        <option value="16" <?php
    echo $rule3_1_16;
?>>16</option>

                                        <option value="17" <?php
    echo $rule3_1_17;
?>>17</option>

                                        <option value="19" <?php
    echo $rule3_1_18;
?>>18</option>

                                        <option value="20" <?php
    echo $rule3_1_19;
?>>19</option>

                                        <option value="21" <?php
    echo $rule3_1_20;
?>>20</option>

                                        <option value="22" <?php
    echo $rule3_1_21;
?>>21</option>

                                        <option value="23" <?php
    echo $rule3_1_22;
?>>22</option>

                                        <option value="24" <?php
    echo $rule3_1_24;
?>>24</option>

                                        <option value="25" <?php
    echo $rule3_1_25;
?>>25</option>

										<option value="26" <?php
    echo $rule3_1_26;
?>>26</option>

                                        <option value="27" <?php
    echo $rule3_1_27;
?>>27</option>

                                        <option value="28" <?php
    echo $rule3_1_28;
?>>28</option>

                                        <option value="29" <?php
    echo $rule3_1_29;
?>>29</option>

                                        <option value="30" <?php
    echo $rule3_1_30;
?>>30</option>

									</select>

                                    <?php
    if ($_SESSION[facility][rule3_2] == '0') {
        $rule3_2_1 = "selected = selected";
    } else {
        $rule3_2_2 = "selected = selected";
    }
?>

                                    <select name="rule3_2" <?php
    echo $disabled;
?>>

                                    	<option value="0" <?php
    echo $rule3_2_1;
?>>Week</option>

                                        <option value="1" <?php
    echo $rule3_2_2;
?>>Month</option>

                                    </select>

                                    <?php
    if ($_SESSION[facility][rule3_3] == '0') {
        $rule3_3_1 = "selected = selected";
    } else {
        $rule3_3_2 = "selected = selected";
    }
?>

                                    <select name="rule3_3" <?php
    echo $disabled;
?>>

                                    	<option value="0" <?php
    echo $rule3_3_1;
?>>Peak Time</option>

										<option value="1" <?php
    echo $rule3_3_2;
?>>Non-Peak Time</option>

                                    </select></td>

								</tr>

                                </table>                                </td>

							</tr>

                            <tr>

                            	<td colspan="3" bgcolor="#FDF5E1">&nbsp;</td>

                                <td colspan="5" bgcolor="#FDF5E1">&nbsp;</td>

                                <td colspan="3" bgcolor="#FDF5E1">&nbsp;</td>

							    <td colspan="2" bgcolor="#FDF5E1">&nbsp;</td>

                            </tr>

                            <tr>

                            	<td colspan="8" bgcolor="#FDF5E1">Booking Open From

                                <label></label>

                                <?php
    if ($_SESSION[facility][open_from] == '0') {
        $open_from_0 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '1') {
        $open_from_1 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '2') {
        $open_from_2 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '3') {
        $open_from_3 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '4') {
        $open_from_4 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '5') {
        $open_from_5 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '6') {
        $open_from_6 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '6') {
        $open_from_6 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '7') {
        $open_from_7 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '8') {
        $open_from_8 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '9') {
        $open_from_9 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '9') {
        $open_from_9 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '10') {
        $open_from_10 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '11') {
        $open_from_11 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '12') {
        $open_from_12 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '13') {
        $open_from_13 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '14') {
        $open_from_14 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '15') {
        $open_from_15 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '16') {
        $open_from_16 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '17') {
        $open_from_17 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '18') {
        $open_from_18 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '19') {
        $open_from_19 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '20') {
        $open_from_20 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '21') {
        $open_from_21 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '22') {
        $open_from_22 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '23') {
        $open_from_23 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '24') {
        $open_from_24 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '25') {
        $open_from_25 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '26') {
        $open_from_26 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '27') {
        $open_from_27 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '28') {
        $open_from_28 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '29') {
        $open_from_29 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '30') {
        $open_from_30 = "selected = selected";
    } elseif ($_SESSION[facility][open_from] == '60') {
        $open_from_60 = "selected = selected";
    }
?>

                                <select name="open_from" <?php
    echo $disabled;
?>>

                                	<option value="0" <?php
    echo $open_from_0;
?>>N/A</option>

                                    <option value="1" <?php
    echo $open_from_1;
?>>1</option>

                                    <option value="2" <?php
    echo $open_from_2;
?>>2</option>

                                    <option value="3" <?php
    echo $open_from_3;
?>>3</option>

                                    <option value="4" <?php
    echo $open_from_4;
?>>4</option>

                                    <option value="5" <?php
    echo $open_from_5;
?>>5</option>

                                    <option value="6" <?php
    echo $open_from_6;
?>>6</option>

                                    <option value="7" <?php
    echo $open_from_7;
?>>7</option>

                                    <option value="8" <?php
    echo $open_from_8;
?>>8</option>

                                    <option value="9" <?php
    echo $open_from_9;
?>>9</option>

                                    <option value="10" <?php
    echo $open_from_10;
?>>10</option>

                                    <option value="11" <?php
    echo $open_from_11;
?>>11</option>

                                  	<option value="12" <?php
    echo $open_from_12;
?>>12</option>

                                  	<option value="13" <?php
    echo $open_from_13;
?>>13</option>

                                  	<option value="14" <?php
    echo $open_from_14;
?>>14</option>

                                  	<option value="15" <?php
    echo $open_from_15;
?>>15</option>

                                  	<option value="16" <?php
    echo $open_from_16;
?>>16</option>

                                  	<option value="17" <?php
    echo $open_from_17;
?>>17</option>

                                  	<option value="19" <?php
    echo $open_from_18;
?>>18</option>

                                  	<option value="20" <?php
    echo $open_from_19;
?>>19</option>

                                  	<option value="21" <?php
    echo $open_from_20;
?>>20</option>

                                  	<option value="22" <?php
    echo $open_from_21;
?>>21</option>

                                  	<option value="23" <?php
    echo $open_from_22;
?>>22</option>

                                  	<option value="24" <?php
    echo $open_from_24;
?>>24</option>

                                  	<option value="25" <?php
    echo $open_from_25;
?>>25</option>

                                  	<option value="26" <?php
    echo $open_from_26;
?>>26</option>

                                  	<option value="27" <?php
    echo $open_from_27;
?>>27</option>

                                  	<option value="28" <?php
    echo $open_from_28;
?>>28</option>

                                  	<option value="29" <?php
    echo $open_from_29;
?>>29</option>

                                  	<option value="30" <?php
    echo $open_from_30;
?>>30</option>

								  	<option value="60" <?php
    echo $open_from_60;
?>>60</option>

								</select>

                                Days and will be cancelled before

                                <?php
    if ($_SESSION[facility][closed_at] == '0') {
        $closed_at_0 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '1') {
        $closed_at_1 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '2') {
        $closed_at_2 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '3') {
        $closed_at_3 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '4') {
        $closed_at_4 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '5') {
        $closed_at_5 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '6') {
        $closed_at_6 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '6') {
        $closed_at_6 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '7') {
        $closed_at_7 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '8') {
        $closed_at_8 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '9') {
        $closed_at_9 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '9') {
        $closed_at_9 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '10') {
        $closed_at_10 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '11') {
        $closed_at_11 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '12') {
        $closed_at_12 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '13') {
        $closed_at_13 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '14') {
        $closed_at_14 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '15') {
        $closed_at_15 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '16') {
        $closed_at_16 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '17') {
        $closed_at_17 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '18') {
        $closed_at_18 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '19') {
        $closed_at_19 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '20') {
        $closed_at_20 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '21') {
        $closed_at_21 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '22') {
        $closed_at_22 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '23') {
        $closed_at_23 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '24') {
        $closed_at_24 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '25') {
        $closed_at_25 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '26') {
        $closed_at_26 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '27') {
        $closed_at_27 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '28') {
        $closed_at_28 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '29') {
        $closed_at_29 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '30') {
        $closed_at_30 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '48') {
        $closed_at_48 = "selected = selected";
    } elseif ($_SESSION[facility][closed_at] == '72') {
        $closed_at_72 = "selected = selected";
    }
?>

                                <select name="closed_at" <?php
    echo $disabled;
?>>

                                	<option value="0" <?php
    echo $closed_at_0;
?>>N/A</option>

                                    <option value="1" <?php
    echo $closed_at_1;
?>>1</option>

                                    <option value="2" <?php
    echo $closed_at_2;
?>>2</option>

                                    <option value="3" <?php
    echo $closed_at_3;
?>>3</option>

                                    <option value="4" <?php
    echo $closed_at_4;
?>>4</option>

                                    <option value="5" <?php
    echo $closed_at_5;
?>>5</option>

                                    <option value="6" <?php
    echo $closed_at_6;
?>>6</option>

                                    <option value="7" <?php
    echo $closed_at_7;
?>>7</option>

                                    <option value="8" <?php
    echo $closed_at_8;
?>>8</option>

                                    <option value="9" <?php
    echo $closed_at_9;
?>>9</option>

                                    <option value="10" <?php
    echo $closed_at_10;
?>>10</option>

                                    <option value="11" <?php
    echo $closed_at_11;
?>>11</option>

                                    <option value="12" <?php
    echo $closed_at_12;
?>>12</option>

                                    <option value="13" <?php
    echo $closed_at_13;
?>>13</option>

                                    <option value="14" <?php
    echo $closed_at_14;
?>>14</option>

                                    <option value="15" <?php
    echo $closed_at_15;
?>>15</option>

                                    <option value="16" <?php
    echo $closed_at_16;
?>>16</option>

                                    <option value="17" <?php
    echo $closed_at_17;
?>>17</option>

                                    <option value="19" <?php
    echo $closed_at_18;
?>>18</option>

                                    <option value="20" <?php
    echo $closed_at_19;
?>>19</option>

                                    <option value="21" <?php
    echo $closed_at_20;
?>>20</option>

                                    <option value="22" <?php
    echo $closed_at_21;
?>>21</option>

                                    <option value="23" <?php
    echo $closed_at_22;
?>>22</option>

                                    <option value="24" <?php
    echo $closed_at_24;
?>>24</option>

                                    <option value="25" <?php
    echo $closed_at_25;
?>>25</option>

                                    <option value="26" <?php
    echo $closed_at_26;
?>>26</option>

                                    <option value="27" <?php
    echo $closed_at_27;
?>>27</option>

                                    <option value="28" <?php
    echo $closed_at_28;
?>>28</option>

                                    <option value="29" <?php
    echo $closed_at_29;
?>>29</option>

                                    <option value="30" <?php
    echo $closed_at_30;
?>>30</option>

								    <option value="48" <?php
    echo $closed_at_48;
?>>48</option>

								    <option value="72" <?php
    echo $closed_at_72;
?>>72</option>

								</select>

                                Hrs if not confirmed </td>

                                <td colspan="3" bgcolor="#FDF5E1">&nbsp;</td>

                                <td colspan="2" bgcolor="#FDF5E1">&nbsp;</td>

							</tr>

                            <tr>

                            	<td colspan="13" bgcolor="#FDF5E1">&nbsp;</td>

                            </tr>

                            <tr>

                            	<td colspan="10" bgcolor="#FDF5E1"><p>

                                <?php
    if ($_SESSION[facility][os] == 'time_based') {
        $os_2 = "checked=checked";
    } else {
        $os_1 = "checked=checked";
    }
?>

                                <label>Session Based

                                <input type="radio" name="os" value="sess" <?php
    echo $os_1;
?>  <?php
    echo $disabled;
?>>

                                </label>

                                <label>Time Based

                                <input type="radio" name="os" value="time_based" <?php
    echo $os_2;
?> <?php
    echo $disabled;
?>>

                                </label>

                                <label style="margin-bottom: 1em; padding-bottom: 1em; border-bottom: 3px silver groove;">

                                <input name="hidden" type="hidden" class="DEPENDS ON os BEING time_based OR os BEING sess">

                                </label>

                                <label></label>

                                <label></label>

                                <label>Hrs

                                <input type="hrs" name="hrs" class="CONFLICTS WITH apache AND DEPENDS ON os BEING time_based" maxlength="5" size="5"  tooltiptext="Define how many hours will be defined as one session. (e.g 4 , if you enter 4 then system will take one booking for 4 hour)" <?php
    echo $disabled;
?> value="<?php
    echo $_SESSION[facility][hrs];
?>">

                                </label>

                                <label style="margin-bottom: 1em; padding-bottom: 1em; border-bottom: 3px silver groove;">

                                <input name="hidden" type="hidden" class="CONFLICTS WITH pass BEING EMPTY">

                                </label>

                                </p></td>

                                <td width="5%" bgcolor="#FDF5E1">&nbsp;</td>

                                <td width="1%" bgcolor="#FDF5E1">&nbsp;</td>

                                <td width="9%" bgcolor="#FDF5E1">&nbsp;</td>

							</tr>

                            <tr>

                            	<td colspan="13" bgcolor="#FCECC7">Auto Close Date

                                <label>

                                <?php
    if ($_SESSION[facility][auto_close] == '1') {
        $auto_close_1 = "checked=checked";
    } else {
        $auto_close_1 = "";
    }
?>

                                <input type="checkbox" name="auto_close" value="1" <?php
    echo $disabled;
?> tooltiptext="Check this box if you want system to close the booking of this facility at given date on either every month or year." <?php
    echo $auto_close_1;
?>>

                                </label>                                </td>

							</tr>

                            <tr>

                            	<td width="11%">From</td>

                                <td width="7%"><strong>:</strong></td>

                                <td width="20%"><label>

                                <input name="from_date" type="text" size="10" maxlength="10" readonly="" <?php
    echo $disabled;
?> value="<?php
    echo $_SESSION[facility][from_date];
?>">

                                <img src="images/icon-calender.gif" width="19" height="18"  onclick="displayCalendar(document.forms[0].from_date,'dd.mm.yyyy',this)" value="Cal"></label></td>

                                <td width="15%">&nbsp;</td>

                                <td width="2%">To</td>

                                <td width="5%"><strong>:</strong></td>

                                <td width="15%"><input name="to_date" type="text" size="10" maxlength="10" readonly="" <?php
    echo $disabled;
?> value="<?php
    echo $_SESSION[facility][to_date];
?>">

                                <img src="images/icon-calender.gif" width="19" height="18"  onclick="displayCalendar(document.forms[0].to_date,'dd.mm.yyyy',this)" value="Cal"></td>

                                <td width="6%"><div align="right">Frame</div></td>

                                <td width="1%"><strong>:</strong></td>

                                <td colspan="4"><label>

                                <?php
    if ($_SESSION[facility][frame] == '0') {
        $frame_1 = "selected = selected";
    } else {
        $frame_2 = "selected = selected";
    }
?>

                                <select name="frame" <?php
    echo $disabled;
?> tooltiptext="You want to disable this facilities on every month or every year of specified dates ?">

                                	<option value="0" <?php
    echo $frame_1;
?>>Month</option>

                                    <option value="1" <?php
    echo $frame_2;
?>>Year</option>

                                </select>

                                </label>                                </td>

							</tr>

                            <tr>

                            	<td colspan="2">Message</td>

                                <td><label>

                                <input type="text" name="message" <?php
    echo $disabled;
?> value="<?php
    echo $_SESSION[facility][message];
?>" >

                                </label></td>

                                <td colspan="2"><div align="right">Add to Calender </div></td>

                                <td><strong>:</strong></td>

                                <td><label>

                              	<?php
    if ($_SESSION[facility][auto_cal] == '1') {
        $auto_cal = "checked=checked";
    } else {
        $auto_cal = "";
    }
?>

                                <input type="checkbox" name="auto_cal" value="1" <?php
    echo $disabled;
?> <?php
    echo $auto_cal;
?> tooltiptext="Check this box if you want system to display this event on calander.">

                                </label></td>

                                <td colspan="6">&nbsp;</td>

							</tr>

                            <tr>

                    	<td colspan="13" bgcolor="#944542" style="border-left:1px solid #b09852;border-right:1px solid #b09852; padding-left:15px; padding-top:5px; padding-bottom:5px;"><span class="fontitle"><strong>&nbsp;Barring Rules </strong></span></td>

					</tr>

                    <tr>

                    	<td colspan="13" style="border-left:0px solid #b09852;border-right:0px solid #b09852; padding-left:5px; padding-top:5px; padding-bottom:5px;">User will be barred from booking this facility for <select name="month_blocked">

                        <option value="0" <?
    if ($_SESSION[facility][month_blocked] == 0) {
        echo "selected";
    }
?>>0</option>

                        <option value="1" <?
    if ($_SESSION[facility][month_blocked] == 1) {
        echo "selected";
    }
?>>1</option>

                        <option value="2" <?
    if ($_SESSION[facility][month_blocked] == 2) {
        echo "selected";
    }
?>>2</option>

                        <option value="3" <?
    if ($_SESSION[facility][month_blocked] == 3) {
        echo "selected";
    }
?>>3</option>

                        <option value="4" <?
    if ($_SESSION[facility][month_blocked] == 4) {
        echo "selected";
    }
?>>4</option>

                        <option value="5" <?
    if ($_SESSION[facility][month_blocked] == 5) {
        echo "selected";
    }
?>>5</option>

                        </select> month(s) if they are absent <select name="absent_amount"> 

                        <option value="0" <?
    if ($_SESSION[facility][absent_amount] == 0) {
        echo "selected";
    }
?>>0</option>

                        <option value="1" <?
    if ($_SESSION[facility][absent_amount] == 1) {
        echo "selected";
    }
?>>1</option>

                        <option value="2" <?
    if ($_SESSION[facility][absent_amount] == 2) {
        echo "selected";
    }
?>>2</option>

                        <option value="3" <?
    if ($_SESSION[facility][absent_amount] == 3) {
        echo "selected";
    }
?>>3</option>

                        <option value="4" <?
    if ($_SESSION[facility][absent_amount] == 4) {
        echo "selected";
    }
?>>4</option>

                        <option value="5" <?
    if ($_SESSION[facility][absent_amount] == 5) {
        echo "selected";
    }
?>>5</option>

                        </select> times over a period of <select name="month_period"> <option value="0" <?
    if ($_SESSION[facility][month_period] == 0) {
        echo "selected";
    }
?>>0</option>

                        <option value="1" <?
    if ($_SESSION[facility][month_period] == 1) {
        echo "selected";
    }
?>>1</option>

                        <option value="2" <?
    if ($_SESSION[facility][month_period] == 2) {
        echo "selected";
    }
?>>2</option>

                        <option value="3" <?
    if ($_SESSION[facility][month_period] == 3) {
        echo "selected";
    }
?>>3</option>

                        <option value="4" <?
    if ($_SESSION[facility][month_period] == 4) {
        echo "selected";
    }
?>>4</option>

                        <option value="5" <?
    if ($_SESSION[facility][month_period] == 5) {
        echo "selected";
    }
?>>5</option>

                        

                        </select> month(s).</td>

					</tr>

                    <tr>

                    	<td colspan="13" bgcolor="#944542" 

                        style="border-left:1px solid #b09852;border-right:1px solid #b09852; padding-left:15px; 

                        padding-top:5px; padding-bottom:5px;">

                        <span class="fontitle"><strong>&nbsp;Advanced Booking Period </strong></span></td>

                    </tr>

                    <tr>

                        <td colspan="13"  align="left" >

                        Permit Booking after  <input type="text" name="adv_book_days"  id="adv_book_days" 

                        value="<?php
    echo $adv_book_days;
?>" size="5"/> days

                        </td>

                    </tr>

                          </table>                        </td>

					  </tr>

                        <tr>

                        	<td>&nbsp;</td>

                            <td>&nbsp;</td>

                            <td colspan="11"><div align="right">

                            <label></label>

                            <input type="submit" name="Submit2" value="Update" <?php
    echo $disabled;
?>>

                            </div></td>

                        </tr>

                        <tr>

                        	<td>&nbsp;</td>

                            <td>&nbsp;</td>

                            <td colspan="11"><label></label></td>

                        </tr>

                      </table>

                      	</form>

                  </td>

                  </tr>

                    <tr>

                      <td colspan="3">&nbsp;</td>

                    </tr>

           	  </table>

                  	<?php
}
?>

                  	<?php //print_r($_POST);
if (isset($_POST[type]) && $_POST[type] == 'delete') {
    $can_date   = date('d-m-Y H:i:s');
    $postreason = $_POST[reason];
    $query      = "DELETE FROM my_booking where sno = '$_POST[booking_no]'";
    mysql_query($query) or die(mysql_error());
    echo '<script language=JavaScript>';
    echo 'alert("Lapsed booking have been deleted!")';
    //echo 'self.location.href="booking.php?crypted=$_GET[crypted]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&id=$_GET[id]&newbook=$_GET[newbook]";';
    echo '</script>';
}
if (isset($_POST[type]) && $_POST[type] == 'cancle') {
    $can_date   = date('d-m-Y H:i:s');
    $postreason = $_POST[reason];
    $query      = "update my_booking set status ='$statuscancel[$postreason]',cancle_reson ='$_POST[reason]',amount_returned ='$_POST[refund_amount]',cancle_booking_date_time='$can_date',cancelled_by='$s_id' where sno = '$_POST[booking_no]' limit 1";
    mysql_query($query) or die(mysql_error());
    echo '<script language=JavaScript>';
    echo 'alert("You have made a booking cancellation!")';
    //echo 'self.location.href="booking.php?crypted=$_GET[crypted]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&id=$_GET[id]&newbook=$_GET[newbook]";';
    echo '</script>';
    // get user detail who book the facility
    //if ($_POST['reason'] == '6' or $_POST['reason'] == '11')
    if ($_POST['reason'] == '1' or $_POST['reason'] == '2' or $_POST['reason'] == '3' or $_POST['reason'] == '4' or $_POST['reason'] == '5' or $_POST['reason'] == '6' or $_POST['reason'] == '7' or $_POST['reason'] == '8' or $_POST['reason'] == '9' or $_POST['reason'] == '10' or $_POST['reason'] == '11' or $_POST['reason'] == '12') {
        $sqlbooked           = "SELECT * FROM my_booking WHERE sno = '$_POST[booking_no]'";
        $resultbooked        = mysql_query($sqlbooked);
        $rowbooked           = mysql_fetch_array($resultbooked);
        $residentid          = $rowbooked['uid'];
        $facilitybooked      = $rowbooked['unique_no'];
        $datebooked          = $rowbooked['date_of_booking'];
        $cancelled_by        = $rowbooked['cancelled_by'];
        $cancelled_date_time = $rowbooked['cancle_booking_date_time'];
        $timeslot            = $rowbooked['from_time'] . " to " . $rowbooked['to_time'];
        $cancel_reason       = $rowbooked['cancle_reson'];
        $sqlfacility         = "SELECT * FROM facility WHERE unique_no  = '$facilitybooked'";
        $resultfacility      = mysql_query($sqlfacility);
        $rowfacility         = mysql_fetch_array($resultfacility);
        $facilityname        = $rowfacility['name'];
        $sqlremarks          = "SELECT * FROM cancel_reasons WHERE id = " . $cancel_reason;
        $resultremarks       = mysql_query($sqlremarks);
        $rowremarks          = mysql_fetch_array($resultremarks);
        $cancel_remarks      = $rowremarks['title'];
        $sqlresident         = "SELECT * FROM user_account WHERE id = '$residentid'";
        $resultresident      = mysql_query($sqlresident);
        $rowresident         = mysql_fetch_array($resultresident);
        $residentuser        = $rowresident['username'];
        $sqlcancelby         = "SELECT * FROM user_account WHERE id = '$cancelled_by'";
        $resultcancelby      = mysql_query($sqlcancelby);
        $rowcancelby         = mysql_fetch_array($resultcancelby);
        $cancelbyuser        = $rowcancelby['username'];
        // illegal booking or absent
        //$Fromname 		= $_POST['name'];
        //if ($_POST['email'] != '')
        //{
        //$Fromaddress 	= $_POST['email'];
        //}
        //else
        //{
        $Fromaddress         = "ardmorepark@ardmorepark.com.sg";
        //}
        $mailsubject         = 'Cancellation from ' . $facilityname;
        //GET PARAMETER FROM URL..
        $email               = 'ardmorepark@ardmorepark.com.sg';
        //$email = 'shah@axon.com.sg';
        //$message = 'test';
        //$message = '<center><img height="70" hspace="14" src="http://axonprojects.com/maxime-dev/images/logo.jpg" width="175"><br><br></center>';
        $message1            = '<b><font color="#690708" face="Tahoma" size="2">Dear Condo Manager, <br><br></b>The following booking for the above facility has been cancelled:</font>';
        $message1 .= '<hr color="#690708">';
        $message1 .= '<table width="100%" border="0" cellspacing="0" cellpadding="5">';
        $message1 .= '<tr>';
        $message1 .= '<td width="15%" style="border-bottom:1px solid #999999;"><font color="#690708" face="Tahoma" size="2"><strong>Name</strong></font></td>';
        $message1 .= '<td width="85%" style="border-left: 1px solid #999999; border-bottom:1px solid #999999;"><font color="#690708" face="Tahoma" size="2">' . $residentuser . '</font></td>';
        $message1 .= '</tr>';
        $message1 .= '<tr>';
        $message1 .= '<td style="border-bottom:1px solid #999999;"><font color="#690708" face="Tahoma" size="2"><strong>Date and Time of Booking of Booking</strong></font></td>';
        $message1 .= '<td style="border-left: 1px solid #999999; border-bottom:1px solid #999999;"><font color="#690708" face="Tahoma" size="2">' . $datebooked . ' from ' . $timeslot . '</font></td>';
        $message1 .= '</tr>';
        $message1 .= '<tr>';
        $message1 .= '<td style="border-bottom:1px solid #999999;"><font color="#690708" face="Tahoma" size="2"><strong>Remarks</strong></font></td>';
        $message1 .= '<td style="border-left: 1px solid #999999; border-bottom:1px solid #999999;"><font color="#690708" face="Tahoma" size="2">' . $cancel_remarks . '</font></td>';
        $message1 .= '</tr>';
        $message1 .= '<tr>';
        $message1 .= '<td style="border-bottom:1px solid #999999;"><font color="#690708" face="Tahoma" size="2"><strong>&nbsp;</strong></font></td>';
        $message1 .= '<td style="border-left: 1px solid #999999; border-bottom:1px solid #999999;"><font color="#690708" face="Tahoma" size="2">Booking was cancelled by ' . $cancelbyuser . ' on ' . $cancelled_date_time . '</font></td>';
        $message1 .= '</tr>';
        $message1 .= '</table>';
        $message1 .= '<hr color="#690708"><br>';
        $message1 .= '<font face="Tahoma" size="1">Ardmore Park, 13 Ardmore Park #01-01 Singapore 259961</font>';
        //		$headers = "From: $Fromname info@asiatechqc.com\nBcc: shah@axon.com.sg\nContent-Type: text/html; charset=iso-8859-1";
        $headers   = "From: $Fromname <$Fromaddress>\nReply-To: $Fromaddress\nBcc: shah@axon.com.sg\nContent-Type: text/html; charset=iso-8859-1";
        //$header = 'From: dinesh.kumar@siliconbiztech.com'."\r\n".'Reply-To: dinesh.kumar@siliconbiztech.com\nBcc: shah@axon.com.sg';
        $mail_sent = mail($email, $mailsubject, $message1, $headers);
        //
    }
} else if (isset($_POST[type]) && $_POST[type] == 'approve') {
    $a_date = date('d-m-Y H:i:s');
    $query  = "update my_booking set status ='1',cancle_reson ='$_POST[reason]',amount_recived ='$_POST[refund_amount2]',date_of_conf='$a_date' where sno = '$_POST[booking_no]' limit 1";
    mysql_query($query) or die(mysql_error());
    // only if booking approve by club then sent out an email alert
    if ($_SESSION['user_type'] == 2) {
        $sqlbooked      = "SELECT * FROM my_booking WHERE sno = '$_POST[booking_no]'";
        $resultbooked   = mysql_query($sqlbooked);
        $rowbooked      = mysql_fetch_array($resultbooked);
        $residentid     = $rowbooked['uid'];
        $facilitybooked = $rowbooked['unique_no'];
        $datebooked     = $rowbooked['date_of_booking'];
        $approved_by    = $rowbooked['date_of_conf'];
        $timeslot       = $rowbooked['from_time'] . " to " . $rowbooked['to_time'];
        $sqlfacility    = "SELECT * FROM facility WHERE unique_no  = '$facilitybooked'";
        $resultfacility = mysql_query($sqlfacility);
        $rowfacility    = mysql_fetch_array($resultfacility);
        $facilityname   = $rowfacility['name'];
        $queryclub      = "select * from user_account where crypted = '$_GET[crypted]' and id = '$s_id' limit 1";
        $resultclub = mysql_query($queryclub) or die(mysql_error());
        $rowclub         = mysql_fetch_array($resultclub);
        $usernameapprove = $rowclub[username];
        $sqlresident     = "SELECT * FROM user_account WHERE id = '$residentid'";
        $resultresident  = mysql_query($sqlresident);
        $rowresident     = mysql_fetch_array($resultresident);
        $residentuser    = $rowresident['username'];
        // illegal booking or absent
        //$Fromname 		= $_POST['name'];
        //if ($_POST['email'] != '')
        //{
        //$Fromaddress 	= $_POST['email'];
        //}
        //else
        //{
        $Fromaddress     = "ardmorepark@ardmorepark.com.sg";
        //}
        $mailsubject     = 'Approval for ' . $facilityname . " by Club user";
        //GET PARAMETER FROM URL..
        $email           = 'ardmorepark@ardmorepark.com.sg';
        //$email = 'shah@axon.com.sg';
        //$message = 'test';
        //$message = '<center><img height="70" hspace="14" src="http://axonprojects.com/maxime-dev/images/logo.jpg" width="175"><br><br></center>';
        $message1        = '<b><font color="#690708" face="Tahoma" size="2">Dear Condo Manager, <br><br></b>The following booking for the above facility has been approved:</font>';
        $message1 .= '<hr color="#690708">';
        $message1 .= '<table width="100%" border="0" cellspacing="0" cellpadding="5">';
        $message1 .= '<tr>';
        $message1 .= '<td width="15%" style="border-bottom:1px solid #999999;"><font color="#690708" face="Tahoma" size="2"><strong>Name</strong></font></td>';
        $message1 .= '<td width="85%" style="border-left: 1px solid #999999; border-bottom:1px solid #999999;"><font color="#690708" face="Tahoma" size="2">' . $residentuser . '</font></td>';
        $message1 .= '</tr>';
        $message1 .= '<tr>';
        $message1 .= '<td style="border-bottom:1px solid #999999;"><font color="#690708" face="Tahoma" size="2"><strong>Date and Time of Booking of Booking</strong></font></td>';
        $message1 .= '<td style="border-left: 1px solid #999999; border-bottom:1px solid #999999;"><font color="#690708" face="Tahoma" size="2">' . changeformat($datebooked) . ' from ' . $timeslot . '</font></td>';
        $message1 .= '</tr>';
        $message1 .= '<tr>';
        $message1 .= '<td style="border-bottom:1px solid #999999;"><font color="#690708" face="Tahoma" size="2"><strong>&nbsp;</strong></font></td>';
        $message1 .= '<td style="border-left: 1px solid #999999; border-bottom:1px solid #999999;"><font color="#690708" face="Tahoma" size="2">Booking was approved by ' . $usernameapprove . ' on ' . $approved_by . '</font></td>';
        $message1 .= '</tr>';
        $message1 .= '</table>';
        $message1 .= '<hr color="#690708"><br>';
        $message1 .= '<font face="Tahoma" size="1">Ardmore Park, 13 Ardmore Park #01-01 Singapore 259961</font>';
        //		$headers = "From: $Fromname info@asiatechqc.com\nBcc: shah@axon.com.sg\nContent-Type: text/html; charset=iso-8859-1";
        $headers   = "From: $Fromname <$Fromaddress>\nReply-To: $Fromaddress\nBcc: shah@axon.com.sg\nContent-Type: text/html; charset=iso-8859-1";
        //$header = 'From: dinesh.kumar@siliconbiztech.com'."\r\n".'Reply-To: dinesh.kumar@siliconbiztech.com\nBcc: shah@axon.com.sg';
        $mail_sent = mail($email, $mailsubject, $message1, $headers);
    }
    //
}
?>

            			<?
if ($_GET['page'] == 'book_now' && $_GET['next'] == 'next') {
    // two hour booking only
?>

                        <table width="100%" border="0" align="center">

                      		<form name="form1" method="post" action="booking.php?crypted=<?php
    echo $_GET[crypted];
?>&id=<?php
    echo $_GET[id];
?>&page=<?php
    echo $_GET[page];
?>&user_id=<?php
    echo $_GET[user_id];
?>&fac=<?php
    echo $_GET[fac];
?>&newbook=0">

                            <tr>

                            <td colspan="9">

                            <table width="100%" cellpadding="5" cellspacing="0" style="border:1px solid #333333;">

                            <tr> 

                        		<td bgcolor="#994947" style="border-right:1px solid #333333;"> 

                          		<div align="center" class="fontitle">#1</div></td>

                        		<td bgcolor="#994947" style="border-right:1px solid #333333;"> 

                          		<div align="center"><span class="fontitle">Select</span></div></td>

                        		<td bgcolor="#994947" style="border-right:1px solid #333333;"> 

                          		<div align="center" class="fontitle">From Time</div>                        </td>

                        		<td bgcolor="#994947" style="border-right:1px solid #333333;"> 

                          		<div align="center" class="fontitle">To Time</div>                        </td>

                        		<?
    if ($user_type != '0') {
?>

                   			  	<td bgcolor="#994947" style="border-right:1px solid #333333;"> 

                          		<div align="center" class="fontitle">Resident</div>                        </td>

                                <?
    }
?>

                        		<!--td bgcolor="#994947" style="border-right:1px solid #333333;"> 

                          		<div align="center"><span class="fontitle">Deposit Status</span></div>                        </td-->

                       		  <td bgcolor="#994947"> 

                       	      <div align="center" class="fontitle">Remarks</div></td>

                              <?
    if ($user_type == '1') {
?>

                   			  <td bgcolor="#994947" style="border-left:1px solid #333333;"> 

                       	      <div align="center" class="fontitle">Receipt</div></td>

                                <?
    }
?>

                      		</tr>

                            <?
    $timeNOW   = date("G");
    //$timeNOW = 9;
    $hourSTART = $timeNOW + 1;
    $hourMED   = $timeNOW + 2;
    if ($hourSTART == '21') {
        $hourEND = $timeNOW + 2;
    } else {
        $hourEND = $timeNOW + 3;
    }
    if (strlen($hourSTART) == 1) {
        $hourSTART = str_pad($hourSTART, 2, "0", STR_PAD_LEFT);
    } else {
        $hourSTART = $hourSTART;
    }
    if (strlen($hourMED) == 1) {
        $hourMED = str_pad($hourMED, 2, "0", STR_PAD_LEFT);
    } else {
        $hourMED = $hourMED;
    }
    if (strlen($hourEND) == 1) {
        $hourEND = str_pad($hourEND, 2, "0", STR_PAD_LEFT);
    } else {
        $hourEND = $hourEND;
    }
    // dont know why now its become 00
    $hourSTART        = $hourSTART . ":00";
    $hourEND          = $hourEND . ":00";
    $hourMED          = $hourMED . ":00";
    $day_tocheck      = date("d");
    $month_tocheck    = date("m");
    $year_tocheck     = date("Y");
    $selected_date    = date("d-m-Y");
    $check_facility   = "SELECT * FROM facility WHERE sno = '$_GET[fac]'";
    $result_facility  = mysql_query($check_facility);
    $row_facility     = mysql_fetch_array($result_facility);
    $unique_facility  = $row_facility['unique_no'];
    $name_fac         = $row_facility['name'];
    $sr               = 1;
    $newselected_date = explode("-", $selected_date);
    $checknewdate     = $newselected_date[2] . "-" . $newselected_date[1] . "-" . $newselected_date[0];
    //$check_sql = "SELECT * FROM my_booking WHERE unique_no = '$unique_facility' AND status = '1' AND day = '$day_tocheck' AND month = '$month_tocheck' AND year = '$year_tocheck' AND from_time >= '$hourSTART' AND to_time <= '$hourEND'";
    while ($sr <= 2) {
        $check_sql    = "SELECT * FROM my_booking WHERE unique_no = '$unique_facility' AND status = '1' AND date_of_booking = '$checknewdate' AND from_time = '$hourSTART'";
        $result_sql   = mysql_query($check_sql);
        $row_sql      = mysql_fetch_array($result_sql);
        $order_status = $row_sql['status'];
        $row_num      = mysql_num_rows($result_sql);
        if ($row_num == 1) {
            $dont_sel = "disabled";
        } else {
            $dont_sel = "";
        }
        // find out if peak or non-peak
        $sql_facility1st    = "SELECT id FROM time_slot WHERE time_slot = '$hourSTART'";
        $result_facility1st = mysql_query($sql_facility1st);
        $row_facility1st    = mysql_fetch_array($result_facility1st);
        $timeId             = $row_facility1st['id'];
        $rangebefore        = date("w", (mktime(0, 0, 0, $month_tocheck, $day_tocheck, $year_tocheck))) + 1;
        $sql_find           = "SELECT * FROM track_time WHERE track = '$unique_facility' AND weak = $rangebefore AND from_time <= $timeId AND to_time >= $timeId";
        $result_find        = mysql_query($sql_find);
        $row_find           = mysql_fetch_array($result_find);
        $peaktime           = $row_find['peak'];
        $time_fram          = "$hourSTART-$hourMED&$peaktime";
?>

                            <tr bgcolor="<?php
        echo $color;
?>" <?
        if ($msg != '') {
?>onMouseover="ddrivetip('<?php
            echo " $msg ";
?>')";

 onMouseout="hideddrivetip()" <?
        }
?> > 

                        <td align="center" valign="top" style="border-right:1px solid #333333;border-top:1px solid #333333;"> 

                        <div align="center"> 

                        <?php
        echo $sr;
?>                          </div>                        </td>

                        <td valign="top" style="border-right:1px solid #333333;border-top:1px solid #333333;"><label> 

                        <div align="center"> 

                         <?
        if ($dont_sel != '') {
            echo "<font color='#FF0000'><strong>X</strong></font>";
        } else {
?><input name="time_fram" type="radio" value="<?php
            echo $time_fram;
?>" <?php
            echo "$checked";
?> <?php
            echo $dont_sel;
?> <?
            if ($msg != '') {
?>title="<?php
                echo $msg;
?>" <?
            }
?> onclick="alert('<?php
            echo "You have selected  $name_fac  for date  $selected_date from $hourSTART hrs to $hourMED hrs";
?> ');"   ><?
        }
?>

                        </div>

                        </label></td>

                        <td valign="top" style="border-right:1px solid #333333;border-top:1px solid #333333;"> 

                        <div align="center"> <?php
        //echo $hourSTART;
        if (strlen($hourSTART) == 4) {
            $hourSTART = str_pad($hourSTART, 5, "0", STR_PAD_LEFT);
        } else {
            $hourSTART = $hourSTART;
        }
        if (strlen($hourMED) == 4) {
            $hourMED = str_pad($hourMED, 5, "0", STR_PAD_LEFT);
        } else {
            $hourMED = $hourMED;
        }
        echo $hourSTART;
        $hourSTART = $hourMED;
?>                          </div>                        </td>

                        <td valign="top" style="border-right:1px solid #333333;border-top:1px solid #333333;"> 

                        <div align="center"> 

                        <?php
        echo $hourMED;
        $hourMED = $hourEND;
?>                          </div>                        </td>

                        <?
        if ($user_type != '0') {
?>

                   		<td valign="top" align="center" style="border-right:1px solid #333333;border-top:1px solid #333333;"> 

                        <?php
            if ($registered_by_id == $id || $user_type == '1' || $rid == $id || $user_type == '2') {
                echo $registered_by;
            }
            echo "&nbsp;";
?>                                               </td><?
        }
?>

                        <!--td valign="top" align="center" style="border-right:1px solid #333333;border-top:1px solid #333333;"> 

                <?php
        /* $dont_sel ='';
        
        if($order_status == '1' && $auto_apporve != '1')
        
        {
        
        echo $icon = "PAID";
        
        }
        
        elseif($order_status == '0' && $auto_apporve != '1')
        
        {
        
        echo $icon = "&nbsp;";
        
        }
        
        elseif($order_status == '2')
        
        {
        
        echo $icon = "&nbsp;";
        
        }
        
        elseif($dont_sel != '')
        
        {
        
        echo $icon = "&nbsp;";
        
        }
        
        else
        
        {
        
        if($row[peak] =='1')
        
        {
        
        echo $icon = "&nbsp;";
        
        }
        
        else
        
        {
        
        echo $icon = "&nbsp;";
        
        }
        
        } */
?>                              </td-->

                        <td valign="top" align="center" style="border-top:1px solid #333333;">

						

						<?
        // check time now
        $checking_cancel = date("Y-m-dHi");
        if ($user_type == '0') {
            if ($registered_by_id == $id || $rid == $id) {
                if ($order_status == '0') {
                    echo "Pending<br>";
                    if ($allowed_cancel >= $checking_cancel) {
?>

													[ <a href="redirect.php?<?php
                        echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=1";
?>" onclick="return validateprompt();">Cancel</a> ]

													<?
                    }
                } else if ($order_status == '1') {
                    echo "Approved<br>";
                    if ($allowed_cancel >= $checking_cancel) {
?>

													[ <a href="redirect.php?<?php
                        echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=2";
?>" onclick="return validateprompt();">Cancel</a> ]

													<?
                    }
                } else {
                    echo "&nbsp;";
                }
            } else
            // if booking made by other resident
                if ($order_status == '1' || $order_status == '0') {
                echo "Already Booked";
            }
            // if no booking done
            else {
                echo "&nbsp;";
            }
        } else if ($user_type == '1') {
            if ($order_status == '0') {
                echo "Pending<br>";
                // if cancel within time limit
                if ($allowed_cancel >= $checking_cancel) {
?>

                                                <a href="redirect.php?<?php
                    echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=approve";
?>">Approve</a> ] [ <a href="redirect.php?<?php
                    echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=7";
?>" onclick="return validateprompt();">Cancel</a> ]

                                                <?
                }
                // if still not paid but limit has reach
                else {
?> 

                                                [ <a href="redirect.php?<?php
                    echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=approve";
?>">Approve</a> ] [ <a href="redirect.php?<?php
                    echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=9";
?>" onclick="return validateprompt();">Cancel</a> ]

                                                  <?
                }
            } else if ($order_status == '1') {
                echo "Approved<br>";
                // can still cancel as long as limit not reach
                if ($allowed_cancel >= $checking_cancel) {
?>

                                                [ <a href="redirect.php?<?php
                    echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=8";
?>" onclick="return validateprompt();">Cancel</a> ]

                                                <?
                }
                // illegal if more than time limit, but need so that they can release the booking for other residents
                else {
?>

                                                [ <a href="redirect.php?<?php
                    echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=9";
?>" onclick="return validateprompt();">Cancel</a> ]

                                                <?
                }
                $compare_date = date("Y-m-d");
                // check once approved, to show absent link
                if ($date_of_booking == $compare_date) {
                    $breakfromtime = explode(":", $from_time_recorded);
                    $breaktotime   = $breakfromtime[0] . ":30";
                    $breaktime     = date("H:i");
                    if ($breaktime >= $from_time_recorded && $breaktime <= $to_time_recorded)
                    //if ($breaktime >= '02:56' && $breaktime <= '03:04')
                        {
?>

													[ <a href="redirect.php?<?php
                        echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=11";
?>">Absent</a> ]

													<?
                    }
                    //check also for rain on same day if outdoor
                    $sqloutdoor    = "SELECT type FROM facility WHERE unique_no = '$unique_no'";
                    $resultoutdoor = mysql_query($sqloutdoor);
                    $outdoorrow    = mysql_fetch_array($resultoutdoor);
                    if ($outdoorrow['type'] == 1) {
                        $breakfromtime      = explode(":", $from_time_recorded);
                        $breakfromtimestart = $breakfromtime[0];
                        if ($breakfromtimestart[0] == 0) {
                            $newbreakfromtime = "0" . ($breakfromtimestart[1] - 1) . ":30";
                        } else {
                            $newbreakfromtime = ($breakfromtimestart - 1) . ":30";
                        }
                        $newbreaktotime = $breakfromtime . ":30";
                        $breaktime      = date("H:i");
                        if ($breaktime >= $from_time_recorded && $breaktime <= $to_time_recorded) {
                            //echo $breaktime . ">=" . $newbreakfromtime . "&&" . $hreaktime . "<=" . $newbreaktotime;
?>

														[ <a href="redirect.php?<?php
                            echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=10";
?>">Rain</a> ]

														<?
                        }
                    }
                }
            } else {
                echo "&nbsp;";
            }
        } else if ($user_type == '2') {
            if ($order_status == '0') {
                echo "Pending<br>";
                if ($allowed_cancel >= $checking_cancel) {
?>

                                                <a href="redirect.php?<?php
                    echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=approve";
?>">Approve</a> ] [ <a href="redirect.php?<?php
                    echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=3";
?>" onclick="return validateprompt();">Cancel</a> ]

                                                <?
                }
            } else if ($order_status == '1') {
                echo "Approved<br>";
                if ($allowed_cancel >= $checking_cancel) {
?>

                                                [ <a href="redirect.php?<?php
                    echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=4";
?>" onclick="return validateprompt();">Cancel</a> ]

                                                <?
                }
                $compare_date = date("Y-m-d");
                // check once approved, to show absent link
                if ($date_of_booking == $compare_date) {
                    $breakfromtime = explode(":", $from_time_recorded);
                    $breaktotime   = $breakfromtime[0] . ":30";
                    $breaktime     = date("H:i");
                    if ($breaktime >= $from_time_recorded && $breaktime <= $to_time_recorded)
                    //if ($breaktime >= '02:56' && $breaktime <= '03:04')
                        {
?>

													[ <a href="redirect.php?<?php
                        echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=6";
?>">Absent</a> ]

													<?
                    }
                    //check also for rain on same day if outdoor
                    $sqloutdoor    = "SELECT type FROM facility WHERE unique_no = '$unique_no'";
                    $resultoutdoor = mysql_query($sqloutdoor);
                    $outdoorrow    = mysql_fetch_array($resultoutdoor);
                    if ($outdoorrow['type'] == 1) {
                        $breakfromtime      = explode(":", $from_time_recorded);
                        $breakfromtimestart = $breakfromtime[0];
                        if ($breakfromtimestart[0] == 0) {
                            $newbreakfromtime = "0" . ($breakfromtimestart[1] - 1) . ":30";
                        } else {
                            $newbreakfromtime = ($breakfromtimestart - 1) . ":30";
                        }
                        $newbreaktotime = $breakfromtime . ":30";
                        $breaktime      = date("H:i");
                        if ($breaktime >= $from_time_recorded && $breaktime <= $to_time_recorded)
                        //if ($breaktime >= '02:56' && $breaktime <= '03:04')
                            {
                            echo $breaktime . ">=" . $newbreakfromtime . "&&" . $breaktime . "<=" . $newbreaktotime;
?>

														[ <a href="redirect.php?<?php
                            echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=5";
?>">Rain</a> ]

														<?
                        }
                    }
                }
            } else {
                echo "&nbsp;";
            }
        }
?>						</td>

                        	<?php
        if ($user_type == '1') {
?>

                        		<td valign="top" style="border-left:1px solid #333333;border-top:1px solid #333333;"> 

                          		<div align="center"> 

                            	<?php
            if ($order_status == '0' or $order_status == '1' and $amount_recived == '') {
                //echo "<img src=images/dollar_icon_gray.jpg>";
                echo "&nbsp;";
            } elseif (($order_status == '0' || $order_status == '1') && $user_type == 1) {
                echo "<a href=javascript:openwindow('receipt.php?id=$my_booking_no')><strong>View</strong></a>";
            } else {
                echo "&nbsp;";
            }
            $show         = '';
            $order_status = "";
?>

                          		</div>                                </td>

                                <?
        }
?>

                      		</tr>

                            <?
        $sr++;
    }
?>

                         <tr> 

                <td colspan="9" style="border-top:1px solid #333333;"><label> 

                <?php
    if ($count_dont_sel == $sr) {
        $dis = "disabled=disabled";
    }
    $date_sel = date("d-m-Y");
?>

                <input type="hidden" name="date_sel" value="<?
    echo $date_sel;
?>">

                <input type="submit" name="Submit4" value="Book Now"  <?php
    echo $dis;
?>>

                </label>                </td>

                </tr>

							</table>

                            </td>

                            </tr>

                            </form>

              </table>

						<?
} else if ($_GET[page] == 'book_now' && $_GET['next'] == '') {
    $curent_date = date('d-m-Y');
    if ($_GET[st] == '1') {
        echo "<div align=center>Booking placed </div>";
    }
?>

            				<form name="form1" id="frm_placeorder" method="post" action="booking.php?crypted=<?php
    echo $_GET[crypted];
?>&id=<?php
    echo $_GET[id];
?>&page=<?php
    echo $_GET[page];
?>&user_id=<?php
    echo $_GET[user_id];
?>&fac=<?php
    echo $_GET[fac];
?>&newbook=0">

                            <table width="100%" border="0" align="center" class="sk_bok_green">

                            <tr>

                       		  <td style="padding-top: 5px; padding-bottom: 5px;" colspan="10">

                              <table border="0" cellpadding="0" cellspacing="0" width="100%">

                              <tr>

                              <td align="left" width="85%" bgcolor="#994947" colspan="10">

                              <span class="fontitle"><strong> &nbsp;Place Booking</strong></span>                              </td>

                              <tr>

                              <td align="left" width="85%">

                              <p><font color="#FF0000" size="2">Note:</font><font size="2"><br>

                              Please refer to the <a href="bylaws.php?crypted=<?
    echo $_GET['crypted'];
?>">By-Laws</a> for regulations and booking restrictions.</font><br>

                            	</p>                              </td>

                              </tr>

                              <tr>

                              <td align="left" width="15%">

                             <!-- <span class="fontitle"></span>-->

                             	<?php
    /*Code Added By Robin on 23-09-2013*/
    if ($user_type == 0) {
?>

                               <br/>  

                              	<span style="line-height:20px;color:#FF0000;">

                                    <strong> Booking less than 3 days is not allowed for the facilities BBQ Pit,Entertainment Room,

                                    North Function Room,South Function Room. <br/>Please proceed to Management Office for walk-in booking.</strong>

                                </span>   

                                <br/>  
                               <em><strong>Note:Please choose Facility and  Date to display Booking Slots automatically.</strong></em>

                                <?php
    }
?>                         

								</td>

                              </tr>

                              </table>                              </td>

                      		</tr>

                            <tr>

                        		<td colspan="10"><?php
    $query  = "select * from facility where sno = '$_GET[fac]' limit 1";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result)) {
        $open_from     = $row[open_from];
        $os            = $row[os];
        $hours         = $row[hours];
        $indooroutdoor = $row[type];
        $unique_no     = $row[unique_no];
        $deposite      = $row[deposite];
        $auto_apporve  = $row[auto_apporve];
        if ($_SESSION['user_type'] == '1') {
            $open_from = '10000';
        }
        $closed_at            = $row[closed_at];
        $auto_close_date      = $row[auto_close_date];
        $messageclosed        = $row[message];
        $facility_closed_from = $row[from_date];
        $facility_closed_to   = $row[to_date];
        $max_booking_per_day  = $row[max_booking_per_day];
        $rule1_1              = $row[rule1_1];
        $rule1_2              = $row[rule1_2];
        $rule1_3              = $row[rule1_3];
        $relation_rule_1      = $row[relation_rule_1];
        $rule2_1              = $row[rule2_1];
        $rule2_2              = $row[rule2_2];
        $rule2_3              = $row[rule2_3];
        $relation_rule_2      = $row[relation_rule_2];
        $rule3_1              = $row[rule3_1];
        $rule3_2              = $row[rule3_2];
        $rule3_3              = $row[rule3_3];
        /**Rules Added for Tennis By Vasanth**/
        $relation_rule_4      = $row[relation_rule_4];
        $rule4_1              = $row[rule4_1];
        $rule4_2              = $row[rule4_2];
        $rule4_3              = $row[rule4_3];
        $rule5_1              = $row[rule5_1];
        $rule5_2              = $row[rule5_2];
        $rule5_3              = $row[rule5_3];
        /**End of Code**/
        $closedFrom           = $row[from_date];
        $closedTo             = $row[to_date];
    }
    // to check if facility has peak hour or not
    if ($rule1_3 == '0' || $rule2_3 == '0' || $rule3_3 == '0') {
        $display_legend = 1;
    } else {
        $display_legend = 0;
    }
    if ($_POST[date_sel] != '') {
        //print_r($_POST);
        if (isset($_POST[Submit4])) {
            $date_explode  = explode('-', $_POST[date_sel]);
            // since cant change the date_of_booking using normal date functions, have to get the day, month and year individually because the date of booking is referring to the date of the booking, not date of entry.
            //$day = $date_explode[0];
            //$month = $date_explode[1];
            //$year = $date_explode[2];
            $day           = date("d");
            $month         = date("m");
            $year          = date("Y");
            $time_explode  = explode('-', $_POST[time_fram]);
            $from_time_sel = "$time_explode[0]";
            $peak_time_exp = explode('&', $time_explode[1]);
            $to_time_sel   = "$peak_time_exp[0]";
            $time_type     = $peak_time_exp[1];
            // check for time_type
            if ($_SESSION['holiday']) {
                $time_type = 1;
            } else {
                $time_type = $time_type;
            }
            //
            if ($auto_apporve == '1') {
                $status = '1';
            } else {
                $status = '0';
            }
            if ($deposite == '' or $deposite <= '0') {
                $payment_status = "3";
            } else {
                $payment_status = "0";
            }
            $checkdating  = explode("-", $_POST[date_sel]);
            $checkdatenow = $checkdating[2] . "-" . $checkdating[1] . "-" . $checkdating[0];
            $query        = "select * from my_booking where unique_no = '$unique_no' and uid ='$_GET[user_id]' and status !='2' and from_time ='$from_time_sel' and to_time ='$to_time_sel' and date_of_booking ='$checkdatenow'";
            $result       = mysql_query($query);
            $is_there     = mysql_num_rows($result);
            if ($is_there == '0') {
                if ($unique_no == '1198430241') {
                    $new_unique_no = '1193717225';
                    $whatfacility  = 'T';
                } else if ($unique_no == '1193717225') {
                    $new_unique_no = '1198430241';
                    $whatfacility  = 'T';
                } else if ($unique_no == '1294727326') {
                    $new_unique_no = '1294727362';
                    $whatfacility  = 'P';
                } else {
                    $new_unique_no = '1294727326';
                    $whatfacility  = 'P';
                }
                $checkdating  = explode("-", $_POST[date_sel]);
                $checkdatenow = $checkdating[2] . "-" . $checkdating[1] . "-" . $checkdating[0];
                $query        = "select * from my_booking where unique_no = '$new_unique_no' and uid ='$_GET[user_id]' and status ='1' and from_time ='$from_time_sel' and to_time ='$to_time_sel' and date_of_booking ='$checkdatenow'";
                $result       = mysql_query($query);
                $is_there     = mysql_num_rows($result);
                if ($is_there != '0' && $user_type != 1) {
                    if ($whatfacility == 'T') {
                        //echo "here";
                        echo '<script language=JavaScript>';
                        echo 'alert("Booking of 2 courts for the same hour is not permitted!")';
                        //echo 'self.location.href="booking.php?crypted=$_GET[crypted]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&id=$_GET[id]&newbook=$_GET[newbook]";';
                        echo '</script>';
                    } else if ($whatfacility == 'P') {
                        echo '<script language=JavaScript>';
                        echo 'alert("Booking of 2 Pool Tables for the same hour is not permitted!")';
                        //echo 'self.location.href="booking.php?crypted=$_GET[crypted]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&id=$_GET[id]&newbook=$_GET[newbook]";';
                        echo '</script>';
                    }
                } else {
                    // check for bbq pit restrictions
                    $month_limit     = 2;
                    $month_diff      = 1;
                    $num_total       = 0;
                    $lastmonth       = date("m", (mktime(0, 0, 0, date("m") - $month_diff, date("d"), date("Y"))));
                    $lastday         = date("t", (mktime(0, 0, 0, date("m") - $month_diff, date("d"), date("Y"))));
                    $nextmonth       = date("m", (mktime(0, 0, 0, date("m") + $month_diff, date("d"), date("Y"))));
                    $nextday         = date("t", (mktime(0, 0, 0, date("m") + $month_diff, date("d"), date("Y"))));
                    $lastyear        = date("Y", (mktime(0, 0, 0, date("m") - $month_diff, date("d"), date("Y"))));
                    $nextyear        = date("Y", (mktime(0, 0, 0, date("m") + $month_diff, date("d"), date("Y"))));
                    // first check all booking falling under this month and yext month
                    $dateLOWERlimit1 = $lastyear . "-" . $lastmonth . "-01";
                    $dateUPPERlimit1 = $lastday . "-" . $lastmonth . "-" . $lastyear;
                    $dateLOWERlimit2 = "01-" . $nextmonth . "-" . $nextyear;
                    $dateUPPERlimit2 = $nextyear . "-" . $nextmonth . "-" . $nextday;
                    //$sql_check = "SELECT * FROM my_booking WHERE unique_no = '1193718731' AND status != '2' AND ((date_of_booking >= '$dateLOWERlimit1' AND date_of_booking <= '$dateUPPERlimit2')) AND uid = '$_GET[user_id]'";
                    $sql_check       = "SELECT * FROM my_booking WHERE unique_no = '1193718731' AND ((status = '1') OR (status = '0')) AND uid = '$_GET[user_id]'";
                    $result_check    = mysql_query($sql_check);
                    $num_check       = mysql_num_rows($result_check);
                    if ($num_check != 0) {
                        while ($row_check = mysql_fetch_array($result_check)) {
                            $date_taking  = explode("-", $row_check['date_of_booking']);
                            $day          = $date_taking[2];
                            $month        = $date_taking[1];
                            $year         = $date_taking[0];
                            $tochecklower = $year . "-" . $month . "-" . $day;
                            if ($tochecklower >= $dateLOWERlimit1 && $tochecklower <= $dateUPPERlimit2) {
                                $sql_holiday    = "SELECT * FROM calender_event WHERE (heading = 'PUBLIC HOLIDAY' OR heading = 'PUBLIC HOLIDAY EVE') AND ((day = '$day' AND month_no = '$month' AND year = '$year'))";
                                $result_holiday = mysql_query($sql_holiday);
                                $num_rows       = mysql_num_rows($result_holiday);
                                if ($num_rows != 0) {
                                    $row_holiday = mysql_fetch_array($result_holiday);
                                    // check if its weekend or friday
                                    $rangebefore = mktime(0, 0, 0, $month, $day, $year);
                                    if ((date("w", $rangebefore) == 0) || (date("w", $rangebefore) == 5) || (date("w", $rangebefore) == 6)) {
                                        $num_total++;
                                    } else {
                                        $num_total++;
                                    }
                                } else {
                                    $rangebefore = mktime(0, 0, 0, $month, $day, $year);
                                    if ((date("w", $rangebefore) == 0) || (date("w", $rangebefore) == 5) || (date("w", $rangebefore) == 6)) {
                                        $num_total++;
                                    } else {
                                        $num_total++;
                                    }
                                }
                            }
                        }
                    } // second check for the date of holidays or eve holidays
                    // 310108 : added to check to make sure only weekends public holidays applicable
                    $checknew            = explode("-", $_POST[date_sel]);
                    $monthnow            = $checknew[1];
                    $daynow              = $checknew[0];
                    $yearnow             = $checknew[2];
                    $rangenow            = mktime(0, 0, 0, $monthnow, $daynow, $yearnow);
                    // also check if the date selected is eve or public  holiday 
                    $sql_holidaycheck    = "SELECT * FROM calender_event WHERE (heading = 'PUBLIC HOLIDAY' OR heading = 'PUBLIC HOLIDAY EVE') AND day = '$daynow' AND month_no = '$monthnow' AND year = '$yearnow'";
                    $result_holidaycheck = mysql_query($sql_holidaycheck);
                    $num_rowscheck       = mysql_num_rows($result_holidaycheck);
                    if ($num_rowscheck != 0) {
                        $yesholiday = 1;
                    } else {
                        $yesholiday = 0;
                    }
                    //echo $yesholiday;
                    if ($user_type != 1 && $num_total >= $month_limit && $unique_no == '1193718731' && ((date("w", $rangenow) == 0) || (date("w", $rangenow) == 5) || (date("w", $rangenow) == 6) || ($yesholiday == 1))) {
                        //echo "here";
                        echo '<script language=JavaScript>';
                        echo 'alert("You have reached a maximum of 2

bookings for Fridays, Saturdays, Sundays, Eve of Public Holiday and Public

Holiday. You can make the next booking 2 months after your first booking.")';
                        //echo 'self.location.href="booking.php?crypted=$_GET[crypted]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&id=$_GET[id]&newbook=$_GET[newbook]";';
                        echo '</script>';
                    } else {
                        //
                        $time_of_booking      = date('H:i:s');
                        //$date_of_booking = date('d-m-Y');
                        // date of booking was taken as date selected. Not sure why when he has exploded the date selected and put into correct column. So, in this case, $date_0f_booking is derived used date functions and inserted into my_booking (ignore this because it doesnt work)
                        //$query = "insert into my_booking (uid,unique_no,status,payment_status,date_of_booking,time_of_booking,day,month,year,from_time,to_time,time_type)values('$_GET[user_id]','$unique_no','$status','$payment_status','$date_of_booking','$time_of_booking','$day','$month','$year','$from_time_sel','$to_time_sel','$time_type')  ";
                        $spot                 = time() + (1 * $closed_at * 60 * 60);
                        $lapsed_date          = date("YmdHis", $spot);
                        /*Code Added By Robin on 05-09-2013*/
                        /*if($user_type == 0){
                        
                        $_fac_id	=	(int)$_GET['fac'];	
                        
                        $sql=	"SELECT num_days FROM `advance_booking`  WHERE facility_id='$_fac_id'";
                        
                        $res_adv	=	mysql_query($sql); 
                        
                        $row_adv	=	mysql_fetch_array($res_adv);
                        
                        $adv_book_days	=	$row_adv['num_days'];	
                        
                        //Adding advance booking days
                        
                        if(!empty($adv_book_days)){
                        
                        
                        
                        $curent_date_1	=	date("d-m-Y",strtotime("+". $adv_book_days.' days'));
                        
                        if(strtotime($_POST['date_sel']) <= strtotime($curent_date_1)){ 
                        
                        $_POST['date_sel']	=	$curent_date_1;		
                        
                        }
                        
                        
                        
                        }
                        
                        }*/
                        /*Code Added By Robin on 05-09-2013*/
                        $date_choosen         = explode("-", $_POST[date_sel]);
                        $date_facility_booked = $date_choosen[2] . "-" . $date_choosen[1] . "-" . $date_choosen[0];
                        // 3 days before date of booking
                        //echo $closed_at;
                        //echo $from_time_sel;
                        $breakpart            = explode(":", $from_time_sel);
                        $firstpart            = $breakpart[0];
                        //echo $firstpart[1];
                        if ($firstpart[0] == 0) {
                            $firstpart[1] = $firstpart[1] - 1;
                            $breakpart1   = "0" . $firstpart[1] . "00";
                        } else {
                            $breakpart1 = $breakpart[0] - 1;
                            $breakpart1 = $breakpart1 . "00";
                        }
                        if ($closed_at == '72') {
                            $allday = date("Y-m-d", (mktime(0, 0, 0, $date_choosen[1], $date_choosen[0] - 3, $date_choosen[2])));
                            if (strlen($breakpart[0]) == 1) {
                                $newbreakpart = str_pad($breakpart[0], 2, "0", STR_PAD_LEFT);
                            } else {
                                $newbreakpart = $breakpart[0];
                            }
                            $allowed_cancel = $allday . $newbreakpart . "00";
                        } else {
                            if (strlen($breakpart1) == 1) {
                                $newbreakpart = str_pad($breakpart1, 2, "0", STR_PAD_LEFT);
                            } else {
                                $newbreakpart = $breakpart1;
                            }
                            $allowed_cancel = $date_facility_booked . $newbreakpart;
                        }
                        //$allday  = date("t", (mktime(0, 0, 0, $date_choosen[1]-3, $date_choosen[0], $date_choosen[2])));
                        // check if this is the issue that is causing the different time, in the event it causes other issues, remove the next 3 lines
                        $daynow           = date("d");
                        $monthnow         = date("m");
                        $yearnow          = date("Y");
                        // limit set is so far 3 days
                        $datesnow         = $yearnow . "-" . $monthnow . "-" . $daynow;
                        $dayslaterwouldbe = date("Y-m-d", mktime(0, 0, 0, $monthnow, $daynow + 3, $yearnow));
                        //exit;
                        // 04 Aug 2009 - added to check first if slots have been taken or not
                        $nogo             = 0;
                        $checkingsql      = "SELECT * FROM my_booking WHERE date_of_booking = '$date_facility_booked' AND unique_no = '$unique_no' AND from_time = '$from_time_sel' AND to_time = '$to_time_sel' AND (status = 0 OR status = 1)";
                        $resultchecking   = mysql_query($checkingsql);
                        $num_rows         = mysql_num_rows($resultchecking);
                        if ($num_rows > 0) {
                            $nogo = 1;
                            echo '<script language=JavaScript>';
                            echo 'alert("The slot chosen have been booked by another resident. Please choose a new available slot.")';
                            //echo 'self.location.href="booking.php?crypted=$_GET[crypted]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&id=$_GET[id]&newbook=$_GET[newbook]";';
                            echo '</script>';
                        }
                        $tennisCourt1         = '12';
                        $tennisCourt2         = '14';
                        $date_facility_booked = $date_choosen[2] . "-" . $date_choosen[1] . "-" . $date_choosen[0];
                        $get_yearz            = $date_choosen[2];
                        $get_monthz           = $date_choosen[1];
                        $get_dayz             = $date_choosen[0];
                        if (($user_type != '1') && ($tennisCourt1 || $tennisCourt2)) {
                            $tenniz       = "SELECT date_of_booking FROM `my_booking` WHERE uid = '$userid' AND status < '2' AND DAY(date_of_booking) = '$get_dayz' AND YEAR(date_of_booking) = '$get_yearz' AND MONTH(date_of_booking) = '$get_monthz' AND unique_no IN (1193717225,1198430241)";
                            $res_tenniz   = mysql_query($tenniz);
                            $tennisRules1 = mysql_num_rows($res_tenniz);
                        }
                        // 04 Aug 2009 - end
                        if ($nogo == 0) {
                            if ($tennisRules1 >= 2) {
                                echo "<script language='javascript'>";
                                echo "alert('You have exceeded the Booking Limit');";
                                echo "</script>";
                            } else {
                                //if($_SERVER['REMOTE_ADDR'] == '122.164.244.253'){ echo "Hello"; exit;}
                                $checkingsql    = "SELECT * FROM my_booking WHERE date_of_booking = '$date_facility_booked' AND unique_no = '$unique_no' AND from_time = '$from_time_sel' AND to_time = '$to_time_sel' AND (status = 0 OR status = 1)";
                                $resultchecking = mysql_query($checkingsql);
                                $num_rows       = mysql_num_rows($resultchecking);
                                if ($num_rows > 0) {
                                    $nogo = 1;
                                    echo '<script language=JavaScript>';
                                    echo 'alert("The slot chosen have been booked by another resident. Please choose a new available slot.")';
                                    //echo 'self.location.href="booking.php?crypted=$_GET[crypted]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&id=$_GET[id]&newbook=$_GET[newbook]";';
                                    echo '</script>';
                                } else {
                                    $query = "insert into my_booking (uid,rid,unique_no,status,payment_status,date_of_booking,time_of_booking,day,month,year,from_time,to_time,time_type,lapsed_date,allowed_cancel)values('$_GET[user_id]','$id','$unique_no','$status','$payment_status','$date_facility_booked','$time_of_booking','$daynow','$monthnow','$yearnow','$from_time_sel','$to_time_sel','$time_type','$lapsed_date','$allowed_cancel')  ";
                                    mysql_query($query);
                                }
                            }
                            //exit;
                            $_SESSION['newbook'] = 1;
                            if ($dayslaterwouldbe >= $date_facility_booked) {
                                $paymentdue = "immediately, ";
                            } else {
                                $paymentdue = "within 3 days of bookings, ";
                            }
                            // calculate first in three days later what date it is
                            // if need deposit, to inform resident to pay 3 days from date of booking
                            if ($auto_apporve != 1) {
                                echo '<script language=JavaScript>';
                                echo 'alert("A new booking is successfully registered. Kindly refer to the booking table for details. A deposit of $200 is required when making a booking. Residents using e-bookings will have to make payment at Management Office ' . $paymentdue . 'failing which the booking will be cancelled and the facility will be open for booking again.")';
                                //echo 'self.location.href="booking.php?crypted=$_GET[crypted]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&id=$_GET[id]&newbook=$_GET[newbook]";';
                                echo '</script>';
                            } else {
                                echo '<script language=JavaScript>';
                                echo 'alert("A new booking is successfully registered. Kindly refer to the booking table for details.")';
                                //echo 'self.location.href="booking.php?crypted=$_GET[crypted]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&id=$_GET[id]&newbook=$_GET[newbook]";';
                                echo '</script>';
                            }
                        }
                    }
                }
            }
        }
        //start Date
        $exp_date             = $_POST[date_sel];
        $curent_date          = $exp_date;
        //start of day funcation
        $exp1_date            = explode("-", $exp_date);
        //print_r($exp1_date);
        $day                  = $exp1_date[0];
        $month                = $exp1_date[1];
        $year                 = $exp1_date[2];
        $opening              = mktime(0, 0, 0, $month, $day, $year);
        $now                  = time();
        $starting_date_choose = floor($closed_at / 24);
        $dayselepsed          = ceil(($opening - $now) / (1 * 24 * 60 * 60));
        //echo "((" . $dayselepsed . "<" . $starting_date_choose . "||" . $dayselepsed . "< 0) &&" . $starting_date_choose . "> 1)";
        /*if($dayselepsed  < 0)				   
        
        {
        
        echo "<div align=center><font color=red>Please choose date from today onwards</font></div>";
        
        $curent_date = date('d-m-Y');
        
        $error =1;
        
        }*/
        //elseif($dayselepsed >= $open_from)
        //elseif($dayselepsed > $open_from)
        if ($dayselepsed > $open_from) {
            if ($open_from == '60') {
                echo "<div align=center><font color=red>Please choose date not more than 2 months from today.</font></div>";
            } else if ($open_from == '30') {
                echo "<div align=center><font color=red>Please choose date not more than 1 month from today.</font></div>";
            } else {
                //echo "<div align=center><font color=red>Please choose date not more than $open_from days from today.</font></div>";
                echo "<div align=center><font color=red>Please choose date not more than 3 days from today.</font></div>";
            }
            $curent_date = date('d-m-Y');
            $error       = 1;
        } else {
            $error = 0;
        }
    } else {
        $error = 1;
    }
?>                                </td>

                      		</tr>

                      		<tr>

                            <?
    if ($user_type == '0') {
?>

                              <td colspan="10">

                              <table width="100%" cellpadding="0" cellspacing="0" border="0">

                              <tr>

                              <td width="11%" align="left">

                           	  <input type="hidden" name="menu1" value="<?
        echo $_GET[user_id];
?>">								                            Select Facilites :                           	    </td>

                                <td width="24%"><?php
        if ($_GET[user_id] == '') {
            $dis = "disabled";
            $msg = "Please Select User";
        } else {
            $msg = "Select Facilites";
            $dis = "";
        }
?>

                            	<select name="menu2" onChange="MM_jumpMenu('parent',this,0)" <?php
        echo $dis;
?>>

                              		<option value="booking.php?crypted=<?php
        echo "$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]";
?>"><?php
        echo $msg;
?></option>

                              		<?php
        $query  = "select * from facility where enable ='1' ORDER BY name ASC";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result)) {
            if ($_GET[fac] == $row[sno]) {
                $sel_fac = "selected = selected";
            } else {
                $sel_fac = "";
            }
            echo " <option value=booking.php?crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$row[sno] $sel_fac>$row[name]</option>";
        }
?>

                       		  </select></td>

                                <td width="5%">Date :</td>

                                <td width="22%" align="left">

                                <?php
        /*Code added to display retrieve Booking period*/
        /*
        $_fac_id	=	(int)$_GET['fac'];	
        
        $sql=	"SELECT num_days FROM `advance_booking`  WHERE facility_id='$_fac_id'";
        
        $res_adv	=	mysql_query($sql); 
        
        $row_adv	=	mysql_fetch_array($res_adv);
        
        $adv_book_days	=	$row_adv['num_days'];	*/
        /*Adding advance booking days*/
        /*if(!empty($adv_book_days)){
        
        $curent_date	=	date("d-m-Y",strtotime("+". $adv_book_days.' days'));
        
        if(strtotime($_POST['date_sel']) <= strtotime($curent_date)){ 
        
        $curent_date	=	$_POST['date_sel'];		
        
        }
        
        else{
        
        $curent_date	=	date("d-m-Y");	*/
?>

                                    	<script language="javascript">

									<!--		alert("Advanced bookings are permitted for up to 3 days, inclusive of the day of booking");-->

										</script>

                                    <?php
        /*}
        
        
        
        }*/
        /*Code added to retrieve Advanced Booking period*/
?>

                                

                                <label>
								<?php
        /*Code Added By Robin on 30-01-2014*/
        //echo "<br/>Autoapprove is ".$auto_apporve;
        if ($auto_apporve != 1) {
            $_fac_id       = (int) $_GET['fac'];
            $sql           = "SELECT num_days FROM `advance_booking`  WHERE facility_id='$_fac_id'";
            $res_adv       = mysql_query($sql);
            $row_adv       = mysql_fetch_array($res_adv);
            $adv_book_days = $row_adv['num_days'];
            $date_sel      = $_POST['date_sel'];
            if ($adv_book_days != '') {
                $adv_date    = strtotime("+" . $adv_book_days . " day");
                $curent_date = date("d-m-Y", $adv_date);
            }
            if ($date_sel != '') {
                if (strtotime($date_sel) < $adv_date) {
                    $curent_date = date("d-m-Y", $adv_date);
                } else {
                    $curent_date = date("d-m-Y", strtotime($date_sel));
                }
            }
        }
        /*Code Added By Robin on 30-01-2014*/
?>
                          		<input name="date_sel" type="text" value="<?php
        echo $curent_date;
?>" size="15" maxlength="10" readonly="" onchange="document.forms['form1'].submit();">

                          		</label>

                            	<img src="images/icon-calender.gif" alt="View Calender" width="19" height="18"  onclick="displayCalendar(document.forms[0].date_sel,'dd-mm-yyyy',this)" value="Cal">                           	    </td>

                                <td width="38%"><INPUT TYPE="image" SRC="images/buttons/searchbutton.jpg" align="absmiddle" <?php
        echo $dis;
?>></td>

                              </tr>

                                </table>

                              </td>

                              <?
    } else {
?><br>

                            <td width="7%">User</td>

                                <td width="1%"><strong>:</strong></td>

                                <td width="20%"><?php
        if ($user_type == '0') {
            $funcation_dis = "disabled = disabled";
        }
?>

                            	<select name="menu1" onChange="MM_jumpMenu('parent',this,0)" <?php
        echo $funcation_dis;
?> >

                              		<option value="booking.php?crypted=<?php
        echo "$_GET[crypted]&id=$_GET[id]&page=book_now";
?>">Select User</option>

                              		<?php
        $query  = "select * from user_account where active ='1' ORDER BY username ASC";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result)) {
            if ($_GET[user_id] == $row[id]) {
                $sel = "selected = selected";
            } else {
                $sel = "";
            }
            echo " <option value=booking.php?crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$row[id] $sel>$row[username]</option>";
        }
?>

								</select>                              </td>

                        		<td width="13%">Select Facilites </td>

                        		<td width="1%"><strong>:</strong></td>

                        		<td width="14%"><?php
        if ($_GET[user_id] == '') {
            $dis = "disabled";
            $msg = "Please Select User";
        } else {
            $msg = "Select Facilites";
            $dis = "";
        }
?>

                            	<select name="menu2" onChange="MM_jumpMenu('parent',this,0)" <?php
        echo $dis;
?>>

                              		<option value="booking.php?crypted=<?php
        echo "$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]";
?>"><?php
        echo $msg;
?></option>

                              		<?php
        $query  = "select * from facility where enable ='1' ORDER BY name ASC";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result)) {
            if ($_GET[fac] == $row[sno]) {
                $sel_fac = "selected = selected";
            } else {
                $sel_fac = "";
            }
            echo " <option value=booking.php?crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$row[sno] $sel_fac>$row[name]</option>";
        }
?>

                          		</select>                              </td>

                        		<td width="8%">

               				  <div align="right"> Date </div>                  </td>

                        		<td width="1%"><strong>:</strong></td>

                        		<td width="17%"><label>

                          		<input name="date_sel" type="text" value="<?php
        echo $curent_date;
?>" size="8" maxlength="10" readonly="">

                          		</label>

                            	<img src="images/icon-calender.gif" alt="View Calender" width="19" height="18"  onclick="displayCalendar(document.forms[0].date_sel,'dd-mm-yyyy',this)" value="Cal">

                           	  <label></label></td>

                                <td width="18%">

<INPUT TYPE="image" SRC="images/buttons/searchbutton.jpg" <?php
        echo $dis;
?>>                  </td>

                            <?
    }
?>

                            </tr>

                            <tr>

                              <td colspan="10"><?php
    if ($error != '1') {
        $time_of_booking       = '';
        $newdatetocheck        = explode("-", $_POST['date_sel']);
        $checknewdate          = $newdatetocheck[2] . "-" . $newdatetocheck[1] . "-" . $newdatetocheck[0];
        $query_my_booking      = "select * from my_booking where unique_no = '$unique_no' and date_of_booking = '$checknewdate' and uid = '$_GET[user_id]' and ((`status` = '0') or (`status` = '1'))";
        $result_my_query       = mysql_query($query_my_booking);
        // get the type for the user being booked
        $query_my_user         = "select * from user_account WHERE id = '$_GET[user_id]'";
        $result_my_user        = mysql_query($query_my_user);
        $row_my_user           = mysql_fetch_array($result_my_user);
        $user_type_booked      = $row_my_user['user_type'];
        $count_booking_for_day = mysql_num_rows($result_my_query);
        //echo $count_booking_for_day .  ">=" . $max_booking_per_day; 
        //exit;
        if ($count_booking_for_day >= $max_booking_per_day && $user_type_booked != '1') {
            $all_system_disabled = "1";
            $all_system_msg      = "only $max_booking_per_day booking allowed in a day";
        }
        // get the other facilities from the other groups
        $sqlgroup     = "SELECT group_id FROM group_link WHERE unique_no = '$unique_no'";
        $resultgroup  = mysql_query($sqlgroup);
        $rowgroup     = mysql_fetch_array($resultgroup);
        // now check what other facility belong to same group
        $sqlothers    = "SELECT * FROM group_link WHERE group_id = '$rowgroup[group_id]' AND unique_no != '$unique_no'";
        $resultothers = mysql_query($sqlothers);
        while ($rowothers = mysql_fetch_array($resultothers)) {
            $time_of_booking  = '';
            $newdatetocheck   = explode("-", $_POST['date_sel']);
            $checknewdate     = $newdatetocheck[2] . "-" . $newdatetocheck[1] . "-" . $newdatetocheck[0];
            $query_my_booking = "select * from my_booking where unique_no = '$rowothers[unique_no]' and date_of_booking = '$checknewdate' and uid = '$_GET[user_id]' and ((`status` = '0') or (`status` = '1'))";
            $result_my_query  = mysql_query($query_my_booking);
            // get the type for the user being booked
            $count_booking_for_day += mysql_num_rows($result_my_query);
            //echo $count_booking_for_day .  ">=" . $max_booking_per_day; 
            //exit;
            if ($count_booking_for_day >= $max_booking_per_day && $user_type_booked != '1') {
                $all_system_disabled = "1";
                $all_system_msg      = "only $max_booking_per_day booking allowed in a day";
            }
        }
        $query_facility  = "select * from facility where unique_no ='$unique_no' limit 1";
        $result_facility = mysql_query($query_facility);
        while ($row_facility = mysql_fetch_array($result_facility)) {
            $name_fac     = $row_facility[name];
            $auto_apporve = $row_facility['auto_apporve'];
        }
        $today_week                 = date(w);
        $date_exp_sel               = explode('-', $_POST[date_sel]);
        $mon_sel_sel                = $date_exp_sel[1];
        $day_sel_sel                = $date_exp_sel[0];
        $year_sel_sel               = $date_exp_sel[2];
        $stamp                      = mktime(0, 0, 0, $mon_sel_sel, $day_sel_sel - 1, $year_sel_sel);
        $weak                       = date("w", $stamp);
        //exit;
        // today week is for finding out which week she belongs to
        $today_week                 = $weak;
        $week_starting_date         = mktime(0, 0, 0, $mon_sel_sel, $day_sel_sel - $today_week, $year_sel_sel);
        $week_starting_date         = date("d-m-Y", $week_starting_date);
        $week_starting_date         = explode('-', $week_starting_date);
        $no_of_days_in_curent_month = date('t');
        $start_day_week             = $week_starting_date[0];
        $start_month_week           = $week_starting_date[1];
        $start_year_week            = $week_starting_date[2];
        (int) $tottal_booking_in_week = 0;
        (int) $tottal_booking_in_week_peek_time = 0;
        (int) $tottal_booking_in_week_nonpeek_time = 0;
        (int) $tottal_booking_in_curent_month = 0;
        (int) $tottal_booking_in_curent_month_in_peak_time = 0;
        (int) $tottal_booking_in_curent_month_in_nonpeak_time = 0;
        //echo "<p>";
        for ($i = 0; $i <= 6; $i++) //find week details
            {
            $week_days    = mktime(0, 0, 0, $start_month_week, $start_day_week + $i, $start_year_week);
            $week_days    = date("Y-m-d", $week_days);
            $query_count  = "select * from my_booking where date_of_booking = '$week_days' and unique_no = '$unique_no' and uid = '$_GET[user_id]' and ((`status` = '0') or (`status` = '1'))";
            //echo "<br>";
            $result_count = mysql_query($query_count);
            while ($row_count = mysql_fetch_array($result_count)) {
                $tottal_booking_in_week = $tottal_booking_in_week + 1;
                if ($row_count[time_type] == '1') {
                    $tottal_booking_in_week_peek_time = $tottal_booking_in_week_peek_time + 1;
                } else {
                    $tottal_booking_in_week_nonpeek_time = $tottal_booking_in_week_nonpeek_time + 1;
                }
            }
        }
        // now find out grouup if they exceeded limit as well
        $sqlgroup         = "SELECT group_id FROM group_link WHERE unique_no = '$unique_no'";
        $resultgroup      = mysql_query($sqlgroup);
        $rowgroup         = mysql_fetch_array($resultgroup);
        // now check what other facility belong to same group
        $sqlothers        = "SELECT * FROM group_link WHERE group_id = '$rowgroup[group_id]' AND unique_no != '$unique_no'";
        $resultothers     = mysql_query($sqlothers);
        // and do the checking again
        $start_day_week   = $week_starting_date[0];
        $start_month_week = $week_starting_date[1];
        $start_year_week  = $week_starting_date[2];
        while ($rowothers = mysql_fetch_array($resultothers)) {
            for ($i = 0; $i <= 6; $i++) //find week details
                {
                $week_days    = mktime(0, 0, 0, $start_month_week, $start_day_week + $i, $start_year_week);
                $week_days    = date("Y-m-d", $week_days);
                $query_count  = "select * from my_booking where date_of_booking = '$week_days' and unique_no = '$rowothers[unique_no]' and uid = '$_GET[user_id]' and ((`status` = '0') or (`status` = '1'))";
                //echo "<br>";
                $result_count = mysql_query($query_count);
                while ($row_count = mysql_fetch_array($result_count)) {
                    $tottal_booking_in_week = $tottal_booking_in_week + 1;
                    if ($row_count[time_type] == '1') {
                        $tottal_booking_in_week_peek_time = $tottal_booking_in_week_peek_time + 1;
                    } else {
                        $tottal_booking_in_week_nonpeek_time = $tottal_booking_in_week_nonpeek_time + 1;
                    }
                }
            }
        }
        // this checks for month limit
        $start_month_month = date(m);
        $start_year_month  = date(Y);
        $start_day_month   = 0;
        for ($i = 1; $i <= $no_of_days_in_curent_month; $i++) //find month details
            {
            $month_days   = mktime(0, 0, 0, $start_month_month, $start_day_month + $i, $start_year_month);
            $month_days   = date("Y-m-d", $month_days);
            $query_count  = "select * from my_booking where date_of_booking = '$month_days' and unique_no = '$unique_no' and uid = '$_GET[user_id]' and  ((`status` = '0') or (`status` = '1'))";
            //echo "<br>";
            $result_count = mysql_query($query_count);
            while ($row_count = mysql_fetch_array($result_count)) {
                $tottal_booking_in_curent_month = $tottal_booking_in_curent_month + 1;
                if ($row_count[time_type] == '1') {
                    $tottal_booking_in_curent_month_in_peak_time = $tottal_booking_in_curent_month_in_peak_time + 1;
                } else {
                    $tottal_booking_in_curent_month_in_nonpeak_time = $tottal_booking_in_curent_month_in_nonpeak_time + 1;
                }
            }
        }
        // now find out grouup if they exceeded limit as well
        $sqlgroup          = "SELECT group_id FROM group_link WHERE unique_no = '$unique_no'";
        $resultgroup       = mysql_query($sqlgroup);
        $rowgroup          = mysql_fetch_array($resultgroup);
        // now check what other facility belong to same group
        $sqlothers         = "SELECT * FROM group_link WHERE group_id = '$rowgroup[group_id]' AND unique_no != '$unique_no'";
        $resultothers      = mysql_query($sqlothers);
        $start_month_month = date(m);
        $start_year_month  = date(Y);
        $start_day_month   = 0;
        while ($rowothers = mysql_fetch_array($resultothers)) {
            for ($i = 1; $i <= $no_of_days_in_curent_month; $i++) //find month details
                {
                $month_days   = mktime(0, 0, 0, $start_month_month, $start_day_month + $i, $start_year_month);
                $month_days   = date("Y-m-d", $month_days);
                $query_count  = "select * from my_booking where date_of_booking = '$month_days' and unique_no = '$unique_no' and uid = '$_GET[user_id]' and status  !=2";
                //echo "<br>";
                $result_count = mysql_query($query_count);
                while ($row_count = mysql_fetch_array($result_count)) {
                    $tottal_booking_in_curent_month = $tottal_booking_in_curent_month + 1;
                    if ($row_count[time_type] == '1') {
                        $tottal_booking_in_curent_month_in_peak_time = $tottal_booking_in_curent_month_in_peak_time + 1;
                    } else {
                        $tottal_booking_in_curent_month_in_nonpeak_time = $tottal_booking_in_curent_month_in_nonpeak_time + 1;
                    }
                }
            }
        }
        //echo "You have " . $bar_counter . " in the system.";
        /*   echo "
        
        Tottal Booking in a day : $count_booking_for_day ;<br>
        
        Booking in Curent Month :	$tottal_booking_in_curent_month , 
        
        <br> 
        
        Booking in Curent Month Peak Time: $tottal_booking_in_curent_month_in_peak_time,<br>
        
        Booking in Curent Month Non Peak Time: $tottal_booking_in_curent_month_in_nonpeak_time<br>
        
        Total Booking in this week :  $tottal_booking_in_week<br>
        
        Total Booking in this Peak Time week :  $tottal_booking_in_week_peek_time<br>
        
        Total Booking in this Non Peak Time week :  $tottal_booking_in_week_nonpeek_time<br>
        
        ------------<br>
        
        
        
        ------------<br>$rule1_2d
        
        ";		 	   */
        //exit;	
        $rule1 = 0;
        $rule2 = 0;
        $rule3 = 0;
        $rule4 = 0; //4 and 5 rules were added by vasanth
        $rule5 = 0;
        if ($rule1_2 == '1') // if the first rule is month
            {
            if ($rule1_3 == '0') // seeing no of booking allowed in peak time
                {
                if ($tottal_booking_in_curent_month_in_peak_time >= $rule1_1 and $all_system_disabled == '' && $user_type_booked != '1') {
                    //echo "1";
                    $all_system_disabled_peak = "1";
                    $all_system_msg_peak      = "only $rule1_1 booking allowed in a month at peak time you have already booked  $tottal_booking_in_curent_month_in_peak_time in this month";
                    $rule1                    = 1;
                } else {
                    $all_system_disabled_peak = $all_system_disabled_peak;
                    //	$all_system_msg_peak ='';
                    $rule1                    = 0;
                }
            } elseif ($rule1_3 == '1') // non peak time
                {
                if ($rule1_1 >= $tottal_booking_in_curent_month_in_nonpeak_time and $all_system_disabled == '' && $user_type_booked != '1') {
                    $all_system_disabled_nonpeak = "1";
                    $all_system_msg_nonpeak      = "only $rule1_1 booking allowed in a month at Non-Peak time you have already booked  $tottal_booking_in_curent_month_in_nonpeak_time in this month";
                    $rule1                       = 1;
                } else {
                    $all_system_disabled = $all_system_disabled;
                    //	$all_system_msg ='';
                    $rule1               = 0;
                }
            } else // any time
                {
                if ($rule1_1 <= $tottal_booking_in_curent_month and $all_system_disabled == '' && $user_type_booked != '1') {
                    $all_system_disabled = "1";
                    $all_system_msg      = "only $rule1_1 booking allowed in a month  you have already booked  $tottal_booking_in_curent_month in this month";
                    $rule1               = 1;
                } else {
                    $all_system_disabled = $all_system_disabled;
                    //$all_system_msg ='';
                    $rule1               = 0;
                }
            }
        } else { // if rule 1 is week
            if ($rule1_3 == '0') // no of booking allowed in peak time
                {
                if ($rule1_1 <= $tottal_booking_in_week_peek_time and $all_system_disabled == '' && $user_type_booked != '1') {
                    //echo "2";
                    $all_system_disabled_peak = "1";
                    $all_system_msg_peak      = "only $rule1_1 booking allowed in a week at peak time you have already booked  $tottal_booking_in_week_peek_time in this week";
                    $rule1                    = 1;
                } else {
                    $all_system_disabled_peak = $all_system_disabled_peak;
                    $all_system_msg_peak      = '';
                    $rule1                    = 0;
                }
            } elseif ($rule1_3 == '1') // non peak time
                {
                if ($rule1_1 <= $tottal_booking_in_week_nonpeek_time and ($all_system_disabled == '' || $all_system_disabled == 0) && $user_type_booked != '1') {
                    $all_system_disabled_nonpeak = "1";
                    $all_system_msg_nonpeak      = "only $rule1_1 booking allowed in a week at Non-Peak time you have already booked  $tottal_booking_in_week_nonpeek_time in this week";
                    $rule1                       = 1;
                } else {
                    $all_system_disabled = $all_system_disabled;
                    //	$all_system_msg ='';
                    $rule1               = 0;
                }
            } else // any time
                {
                if ($rule1_1 <= $tottal_booking_in_week and $all_system_disabled == '' && $user_type_booked != '1') {
                    $all_system_disabled = "1";
                    $all_system_msg      = "only $rule1_1 booking allowed in a week  you have already booked  $tottal_booking_in_week in this week";
                    $rule1               = 1;
                } else {
                    $all_system_disabled = $all_system_disabled;
                    //	$all_system_msg ='';
                    $rule1               = 0;
                }
            }
        }
        //end of rule 1
        if ($relation_rule_1 == '0') // if its and
            {
            if ($rule2_2 == '1') // seeing if the secound rule is upon month or week
                {
                if ($rule2_3 == '0') // seeing no of booking allowed in peak time
                    {
                    if ($rule2_1 <= $tottal_booking_in_curent_month_in_peak_time and $all_system_disabled == '' && $user_type_booked != '1') {
                        //echo "3";
                        $all_system_disabled_peak = "1";
                        $all_system_msg_peak      = "only $rule2_1 booking allowed in a month at peak time you have already booked  $tottal_booking_in_curent_month_in_peak_time in this month";
                        $rule2                    = 1;
                    } else {
                        $all_system_disabled_peak = $all_system_disabled_peak;
                        //	$all_system_msg_peak ='';
                        $rule2                    = 0;
                    }
                } elseif ($rule2_3 == '1') // non peak time
                    {
                    if ($rule2_1 <= $tottal_booking_in_curent_month_in_nonpeak_time and $all_system_disabled == '' && $user_type_booked != '1') {
                        $all_system_disabled_nonpeak = "1";
                        $all_system_msg_nonpeak      = "only $rule2_1 booking allowed in a month at Non-Peak time you have already booked  $tottal_booking_in_curent_month_in_nonpeak_time in this month";
                        $rule2                       = 1;
                    } else {
                        $all_system_disabled = $all_system_disabled;
                        //	$all_system_msg ='';
                        $rule2               = 0;
                    }
                } else // any time
                    {
                    if ($rule2_1 <= $tottal_booking_in_curent_month and $all_system_disabled == '' && $user_type_booked != '1') {
                        $all_system_disabled = "1";
                        $all_system_msg      = "only $rule2_1 booking allowed in a month  you have already booked  $tottal_booking_in_curent_month in this month";
                        $rule2               = 1;
                    } else {
                        $all_system_disabled = $all_system_disabled;
                        //		$all_system_msg ='';
                        $rule2               = 0;
                    }
                }
            } else { // if rule 2 is weak
                if ($rule2_3 == '0') // seeing no of booking allowed in peak time
                    {
                    if ($rule2_1 >= $tottal_booking_in_week_peek_time and $all_system_disabled == '' && $user_type_booked != '1') {
                        //echo "4";
                        $all_system_disabled_peak = "1";
                        $all_system_msg_peak      = "only $max_booking_per_day booking allowed in a week at peak time you have already booked  $tottal_booking_in_week_peek_time in this week";
                        $rule2                    = 1;
                    } else {
                        $all_system_disabled_peak = $all_system_disabled_peak;
                        //	$all_system_msg_peak ='';
                        $rule2                    = 0;
                    }
                } elseif ($rule2_3 == '1') // non peak time
                    {
                    //echo $rule2_1 . "<=" . $tottal_booking_in_week_nonpeek_time . " and " . $all_system_disabled . "==''" . " && " . $user_type_booked . "!=1";
                    if ($rule2_1 <= $tottal_booking_in_week_nonpeek_time and $all_system_disabled == '' && $user_type_booked != '1') {
                        $all_system_disabled_nonpeak = "1";
                        $all_system_msg_nonpeak      = "only $rule2_1 booking allowed in a week at Non-Peak time you have already booked  $tottal_booking_in_week_nonpeek_time in this week";
                        $rule2                       = 1;
                    } else {
                        $all_system_disabled = $all_system_disabled;
                        //	$all_system_msg ='';
                        $rule2               = 0;
                    }
                } else // any time
                    {
                    if ($rule2_1 <= $tottal_booking_in_week and $all_system_disabled == '' && $user_type_booked != '1') {
                        $all_system_disabled = "1";
                        $all_system_msg      = "only $rule2_1 booking allowed in a week  you have already booked  $tottal_booking_in_week in this week";
                        $rule2               = 1;
                    } else {
                        $all_system_disabled = $all_system_disabled;
                        //	$all_system_msg ='';
                        $rule2               = 0;
                    }
                }
            } //end of rule 2
        } elseif ($relation_rule_2 == 1 and $rule2 == '1' && $user_type_booked != '1') // if and is not there mean there is or
            {
            $all_system_disabled = "1";
        }
        // end of relation 2
        if ($relation_rule_2 == '0' or ($relation_rule_2 == '1' and $relation_rule_1 == '0' and $rule2 == '1' and $rule2_1 != '0')) // if its and
            {
            if ($rule3_2 == '1') // seeing if the secound rule is upon month or week
                {
                if ($rule3_3 == '0') // seeing no of booking allowed in peak time
                    {
                    if ($rule3_1 <= $tottal_booking_in_curent_month_in_peak_time and $all_system_disabled == '' && $user_type_booked != '1') {
                        //echo "5";
                        $all_system_disabled_peak = "1";
                        $all_system_msg_peak      = "only $rule3_1 booking allowed in a month at peak time you have already booked  $tottal_booking_in_curent_month_in_peak_time in this month";
                        $rule3                    = 1;
                    } else {
                        $all_system_disabled_peak = $all_system_disabled_peak;
                        //$all_system_msg_peak ='';
                        $rule3                    = 0;
                    }
                } elseif ($rule3_3 == '1') // non peak time
                    {
                    if ($rule2_1 <= $tottal_booking_in_curent_month_in_nonpeak_time and $all_system_disabled == '' && $user_type_booked != '1') {
                        $all_system_disabled_nonpeak = "1";
                        $all_system_msg_nonpeak      = "only $rule3_1 booking allowed in a month at Non-Peak time you have already booked  $tottal_booking_in_curent_month_in_nonpeak_time in this month";
                        $rule3                       = 1;
                    } else {
                        $all_system_disabled = $all_system_disabled;
                        //			$all_system_msg ='';
                        $rule3               = 0;
                    }
                } else // any time
                    {
                    if ($rule3_1 <= $tottal_booking_in_curent_month and $all_system_disabled == '' && $user_type_booked != '1') {
                        $all_system_disabled = "1";
                        $all_system_msg      = "only $rule3_1 booking allowed in a month  you have already booked  $tottal_booking_in_curent_month in this month";
                        $rule3               = 1;
                    } else {
                        $all_system_disabled = $all_system_disabled;
                        //			$all_system_msg ='';
                        $rule3               = 0;
                    }
                }
            } else { // if rule 2 is weak
                if ($rule3_3 == '0') // seeing no of booking allowed in peak time
                    {
                    if ($rule3_1 >= $tottal_booking_in_week_peek_time and $all_system_disabled == '' && $user_type_booked != '1') {
                        //echo "6";
                        $all_system_disabled_peak = "1";
                        $all_system_msg_peak      = "only $rule3_1 booking allowed in a week at peak time you have already booked  $tottal_booking_in_week_peek_time in this week";
                        $rule3                    = 1;
                    } else {
                        $all_system_disabled_peak = $all_system_disabled_peak;
                        $all_system_msg_peak      = '';
                        $rule3                    = 0;
                    }
                } elseif ($rule3_3 == '1') // non peak time
                    {
                    if ($rule3_1 <= $tottal_booking_in_week_nonpeek_time and $all_system_disabled == '' && $user_type_booked != '1') {
                        $all_system_disabled_nonpeak = "1";
                        $all_system_msg_nonpeak      = "only $rule3_1 booking allowed in a week at Non-Peak time you have already booked  $tottal_booking_in_week_nonpeek_time in this week";
                        $rule3                       = 1;
                    } else {
                        $all_system_disabled = $all_system_disabled;
                        //		$all_system_msg ='';
                        $rule3               = 0;
                    }
                } else // any time
                    {
                    if ($rule3_1 <= $tottal_booking_in_week and $all_system_disabled == '' && $user_type_booked != '1') {
                        $all_system_disabled = "1";
                        $all_system_msg      = "only $rule3_1 booking allowed in a week  you have already booked  $tottal_booking_in_week in this week";
                        $rule3               = 1;
                    } else {
                        $all_system_disabled = $all_system_disabled;
                        //		$all_system_msg ='';
                        $rule3               = 0;
                    }
                }
            }
            //end of rule 2
        }
        if ($relation_rule_2 == 1 and $rule3_1 != '0') // if and is not there mean there is or
            {
            if ($rule2 == '1' and $all_system_disabled_nonpeak == '1' and $tottal_booking_in_week_peek_time == '0') {
                //echo "$rule2 =='1' and $all_system_disabled_nonpeak =='1' and $tottal_booking_in_week_peek_time =='0' ";
                $all_system_disabled_nonpeak = $all_system_disabled_nonpeak;
                $all_system_disabled_peak    = $all_system_disabled_peak;
            }
            if ($tottal_booking_in_week_nonpeek_time > $rule2_1 && $user_type_booked != '1') {
                //echo "7";
                $all_system_disabled_peak = '1';
                //	$all_system_disabled_peak ='1';
            }
            if ($tottal_booking_in_week_nonpeek_time == $rule3_1 && $user_type_booked != '1') {
                $all_system_disabled_peak    = '1';
                $all_system_disabled_nonpeak = '1';
            }
        }
        // end of relation 3 
        //Rules 4 and 5 added for tennis court 1 & 2 to allow user to book 3non-peak and peak - Added by Vasanth
        $rule4 = 0; //4 and 5 rules were added by vasanth
        $rule5 = 0;
    }
    // additional this to counter tennis court ruling - added on 20 Jan
    // 1st need to check all booking for both tennis court to check if both exceed the limit
    if (($unique_no == '1193717225' || $unique_no == '1198430241') && $user_type_booked != '1') {
        //echo "here";
        $sqltennis    = "SELECT * FROM facility WHERE unique_no = '1193717225' OR unique_no = '1198430241'";
        $resulttennis = mysql_query($sqltennis);
        (int) $tottal_booking_in_week_tennis = 0;
        (int) $tottal_booking_in_week_peek_time_tennis = 0;
        (int) $tottal_booking_in_week_nonpeek_time_tennis = 0;
        (int) $tottal_booking_in_curent_month_tennis = 0;
        (int) $tottal_booking_in_curent_month_in_peak_time_tennis = 0;
        (int) $tottal_booking_in_curent_month_in_nonpeak_time_tennis = 0;
        while ($rowtennis = mysql_fetch_array($resulttennis)) {
            //echo "here";
            $date_exp_sel               = explode('-', $_POST[date_sel]);
            $mon_sel_sel                = $date_exp_sel[1];
            $day_sel_sel                = $date_exp_sel[0];
            $year_sel_sel               = $date_exp_sel[2];
            $stamp                      = mktime(0, 0, 0, $mon_sel_sel, $day_sel_sel - 1, $year_sel_sel);
            $weak                       = date("w", $stamp); //calculate week no from selected date
            //exit;
            // today week is for finding out which week she belongs to
            $today_week                 = $weak;
            $week_starting_date         = mktime(0, 0, 0, $mon_sel_sel, $day_sel_sel - $today_week, $year_sel_sel);
            $week_starting_date         = date("d-m-Y", $week_starting_date);
            $week_starting_date         = explode('-', $week_starting_date);
            $no_of_days_in_curent_month = date('t');
            $start_day_week             = $week_starting_date[0];
            $start_month_week           = $week_starting_date[1];
            $start_year_week            = $week_starting_date[2];
            //echo "<p>";
            for ($i = 0; $i <= 6; $i++) //find week details
                {
                $week_days    = mktime(0, 0, 0, $start_month_week, $start_day_week + $i, $start_year_week);
                $week_days    = date("Y-m-d", $week_days);
                $query_count  = "select * from my_booking where date_of_booking = '$week_days' and unique_no = '$rowtennis[unique_no]' and uid = '$_GET[user_id]' and ((`status` = '0') or (`status` = '1'))";
                //echo "<br>";
                //exit;
                $result_count = mysql_query($query_count);
                while ($row_count = mysql_fetch_array($result_count)) {
                    //$tottal_booking_in_week = $tottal_booking_in_week +1;
                    if ($row_count[time_type] == '1') {
                        $tottal_booking_in_week_peek_time_tennis = $tottal_booking_in_week_peek_time_tennis + 1;
                    } else {
                        $tottal_booking_in_week_nonpeek_time_tennis = $tottal_booking_in_week_nonpeek_time_tennis + 1;
                    }
                }
            }
        }
        // now check the value for each peak time or non-peak time for tennis court only
        $tottal_booking_in_week_nonpeek_time_tennis;
        $tottal_booking_in_week_peek_time_tennis;
        //echo $rule3_1;
        $total_tennis = $tottal_booking_in_week_nonpeek_time_tennis + $tottal_booking_in_week_peek_time_tennis;
        //Code Added By Vasanth to allow the users for 3x booking in nonpeaktime								
        if ($total_tennis == '4') {
            $all_system_disabled_peak_tennis    = '1';
            $all_system_disabled_nonpeak_tennis = '1';
        }
        if ($tottal_booking_in_week_nonpeek_time_tennis == '4') {
            $all_system_disabled_peak_tennis    = '1';
            $all_system_disabled_nonpeak_tennis = '1';
        }
        if ($tottal_booking_in_week_nonpeek_time_tennis == $rule2_1 && $tottal_booking_in_week_peek_time_tennis == 0) {
            $all_system_disabled_nonpeak        = '1';
            $all_system_disabled_nonpeak_tennis = '1';
            $all_system_disabled_peak_tennis    = '1';
            $all_system_disabled_peak_          = '1';
        }
        if (($tottal_booking_in_week_peek_time_tennis == '1') && ($tottal_booking_in_week_nonpeek_time_tennis == '3')) {
            $all_system_disabled_peak_tennis    = '1';
            $all_system_disabled_nonpeak_tennis = '1';
        }
        if ($tottal_booking_in_week_peek_time_tennis == '2') {
            $all_system_disabled_peak_tennis = '1';
        }
        if ($tottal_booking_in_week_nonpeek_time_tennis > $rule2_1 && $tottal_booking_in_week_nonpeek_time_tennis < $rule3_1) {
            $all_system_disabled_nonpeak        = '';
            $all_system_disabled_nonpeak_tennis = '';
            $all_system_disabled_peak_tennis    = '1';
            $all_system_disabled_peak_          = '1';
        }
        //else
        if ($tottal_booking_in_week_peek_time_tennis == $rule1_1 && $tottal_booking_in_week_nonpeek_time_tennis == $rule2_1) {
            $all_system_disabled_nonpeak_tennis = '1';
            $all_system_disabled_peak_tennis    = '1';
            $all_system_disabled                = '1';
        }
        //else
        //Commented By Vasanth - To allow the user to restrict from 3x bookings
        // if ($tottal_booking_in_week_nonpeek_time_tennis == $rule3_1)
        // {echo "14";
        // $all_system_disabled_nonpeak_tennis = '1';
        // $all_system_disabled_peak_tennis = '1';
        // $all_system_disabled_nonpeak = '1';
        // $all_system_disabled_peak = '1';
        // $all_system_disabled = '1';
        // }
        //else
        //{
        //	$all_system_disabled_nonpeak_tennis = '';
        //	$all_system_disabled_peak_tennis = '';
        //	$all_system_disabled_nonpeak = '';
        //	$all_system_disabled_peak = '';
        //}
    }
    // end of additonal
    // additional this to counter pool table ruling - added on 11 Feb 2009
    // 1st need to check all booking for both tennis court to check if both exceed the limit
    if (($unique_no == '1294727326' || $unique_no == '1294727362') && $user_type_booked != '1') {
        //echo "here";
        $sqlpools    = "SELECT * FROM facility WHERE unique_no = '1294727326' OR unique_no = '1294727362'";
        $resultpools = mysql_query($sqlpools);
        (int) $tottal_booking_in_week_pools = 0;
        (int) $tottal_booking_in_week_peek_time_pools = 0;
        (int) $tottal_booking_in_week_nonpeek_time_pools = 0;
        (int) $tottal_booking_in_curent_month_pools = 0;
        (int) $tottal_booking_in_curent_month_in_peak_time_pools = 0;
        (int) $tottal_booking_in_curent_month_in_nonpeak_time_pools = 0;
        while ($rowpools = mysql_fetch_array($resultpools)) {
            //echo "here";
            $date_exp_sel               = explode('-', $_POST[date_sel]);
            $mon_sel_sel                = $date_exp_sel[1];
            $day_sel_sel                = $date_exp_sel[0];
            $year_sel_sel               = $date_exp_sel[2];
            $stamp                      = mktime(0, 0, 0, $mon_sel_sel, $day_sel_sel - 1, $year_sel_sel);
            $weak                       = date("w", $stamp);
            //exit;
            // today week is for finding out which week she belongs to
            $today_week                 = $weak;
            $week_starting_date         = mktime(0, 0, 0, $mon_sel_sel, $day_sel_sel - $today_week, $year_sel_sel);
            $week_starting_date         = date("d-m-Y", $week_starting_date);
            $week_starting_date         = explode('-', $week_starting_date);
            $no_of_days_in_curent_month = date('t');
            $start_day_week             = $week_starting_date[0];
            $start_month_week           = $week_starting_date[1];
            $start_year_week            = $week_starting_date[2];
            //echo "<p>";
            for ($i = 0; $i <= 6; $i++) //find week details
                {
                $week_days    = mktime(0, 0, 0, $start_month_week, $start_day_week + $i, $start_year_week);
                $week_days    = date("Y-m-d", $week_days);
                $query_count  = "select * from my_booking where date_of_booking = '$week_days' and unique_no = '$rowpools[unique_no]' and uid = '$_GET[user_id]' and ((`status` = '0') or (`status` = '1'))";
                //echo "<br>";
                //exit;
                $result_count = mysql_query($query_count);
                while ($row_count = mysql_fetch_array($result_count)) {
                    //$tottal_booking_in_week = $tottal_booking_in_week +1;
                    if ($row_count[time_type] == '1') {
                        $tottal_booking_in_week_peek_time_pools = $tottal_booking_in_week_peek_time_pools + 1;
                    } else {
                        $tottal_booking_in_week_nonpeek_time_pools = $tottal_booking_in_week_nonpeek_time_pools + 1;
                    }
                }
            }
        }
        // now check the value for each peak time or non-peak time for pools only
        //echo $tottal_booking_in_week_nonpeek_time_tennis;
        //echo $rule2_1;
        if ($tottal_booking_in_week_nonpeek_time_pools <= $rule1_1) {
            $all_system_disabled_nonpeak       = '';
            $all_system_disabled_nonpeak_pools = '';
            $all_system_disabled_peak_pools    = '';
            $all_system_disabled_peak_         = '';
        }
        /*
        
        if ($tottal_booking_in_week_nonpeek_time_pools > $rule2_1 && $tottal_booking_in_week_nonpeek_time_pools < $rule3_1)
        
        {
        
        $all_system_disabled_nonpeak = '';
        
        $all_system_disabled_nonpeak_pools = '';
        
        $all_system_disabled_peak_pools = '1';
        
        $all_system_disabled_peak_ = '1';
        
        }*/
        //else
        /*if ($tottal_booking_in_week_nonpeek_time_pools > $rule1_1)*/
        /*Commented By Robin*/
        /*Added By Robin*/
        if ($tottal_booking_in_week_nonpeek_time_pools >= $rule1_1) {
            /*Added By Robin*/
            $all_system_disabled_nonpeak_pools = '1';
            $all_system_disabled_peak_pools    = '1';
            $all_system_disabled               = '1';
        }
        //else
        /*if ($tottal_booking_in_week_nonpeek_time_pools == $rule3_1)
        
        {
        
        $all_system_disabled_nonpeak_pools = '1';
        
        $all_system_disabled_peak_pools = '1';
        
        $all_system_disabled_nonpeak = '1';
        
        $all_system_disabled_peak = '1';
        
        $all_system_disabled = '1';
        
        }*/
        //else
        //{
        //	$all_system_disabled_nonpeak_tennis = '';
        //	$all_system_disabled_peak_tennis = '';
        //	$all_system_disabled_nonpeak = '';
        //	$all_system_disabled_peak = '';
        //}
    }
    // end of additonal 11 Feb 2009
    $checkdating           = explode("-", $_POST[date_sel]);
    $checkwithdate         = $checkdating[2] . "-" . $checkdating[1] . "-" . $checkdating[0];
    $query_my_booking      = "select * from my_booking where unique_no = '$unique_no' and date_of_booking = '$checkwithdate' and uid = '$_GET[user_id]' and ((status = '0') or (status = '1'))";
    $result_my_query       = mysql_query($query_my_booking);
    $count_booking_for_day = mysql_num_rows($result_my_query);
    if ($count_booking_for_day == $max_booking_per_day && $user_type_booked != '1') {
        $all_system_disabled = "1";
        $all_system_msg      = "only $max_booking_per_day booking allowed in a day";
    }
    // get the other facilities from the other groups
    $sqlgroup     = "SELECT group_id FROM group_link WHERE unique_no = '$unique_no'";
    $resultgroup  = mysql_query($sqlgroup);
    $rowgroup     = mysql_fetch_array($resultgroup);
    // now check what other facility belong to same group
    $sqlothers    = "SELECT * FROM group_link WHERE group_id = '$rowgroup[group_id]' AND unique_no != '$unique_no'";
    $resultothers = mysql_query($sqlothers);
    while ($rowothers = mysql_fetch_array($resultothers)) {
        $time_of_booking  = '';
        $newdatetocheck   = explode("-", $_POST['date_sel']);
        $checknewdate     = $newdatetocheck[2] . "-" . $newdatetocheck[1] . "-" . $newdatetocheck[0];
        $query_my_booking = "select * from my_booking where unique_no = '$rowothers[unique_no]' and date_of_booking = '$checkwithdate' and uid = '$_GET[user_id]' and ((status = '0') or (status = '1'))";
        $result_my_query  = mysql_query($query_my_booking);
        // get the type for the user being booked
        $count_booking_for_day += mysql_num_rows($result_my_query);
        //echo $count_booking_for_day .  ">=" . $max_booking_per_day; 
        //exit;
        if ($count_booking_for_day >= $max_booking_per_day && $user_type_booked != '1') {
            $all_system_disabled = "1";
            $all_system_msg      = "only $max_booking_per_day booking allowed in a day";
        }
    }
    // if time-based facility
    if ($error != '1' and $os == 'time_based') {
        $selected_date = $_POST[date_sel];
        $today_date    = date('d-m-Y');
?>

							<br>

							<table width="100%" border="0" align="center">

                      		<tr> 

                        		<td colspan="9"><?php
        $currentdatetocheck = explode("-", $curent_date);
        $new_current_date   = $currentdatetocheck[2] . "-" . $currentdatetocheck[1] . "-" . $currentdatetocheck[0];
        $sqlbar             = "SELECT * FROM table_barred WHERE user_id = '$_GET[user_id]' AND facility_id = '$unique_no' AND bar_expiry >= '$new_current_date'";
        $resultbar = mysql_query($sqlbar) or mysql_error();
        $bar_counter = mysql_num_rows($resultbar);
        //echo "<br>You have " . $bar_counter . " barred.";
        if ($bar_counter > 0) {
            //$all_system_disabled = '1';
            $facility_bar   = '1';
            $all_system_msg = 'Please contact Management for further details';
        }
        ///	echo $facility_bar;
        //echo "hello";
        if ($all_system_disabled == "1" && $facility_bar != "1" && $_SESSION['newbook'] != 1 && $user_type_booked != '1') {
            //echo $all_system_disabled;
            //echo "<br>";
            $_SESSION['next2hour'] == 1;
            echo "<div align=center>   <img src=images/buttons/warning-button.jpg width=580 height=53 > </div>";
            $msg            = "You Have Reached The Limit For this facility";
            $all_system_msg = 'You Have Reached The Limit For this facility';
        } else if ($facility_bar == '1') {
            $all_system_disabled = '1';
            $all_system_msg      = 'Please contact Management for further details';
            echo "<div align=center>   <img src=images/buttons/barred.jpg width=580 height=53 > </div>";
        }
        //else
        //echo $auto_close_date;
        // check for public holiday
        $day            = $checkdating[0];
        $month          = $checkdating[1];
        $year           = $checkdating[2];
        $sql_holiday    = "SELECT * FROM calender_event WHERE heading = 'PUBLIC HOLIDAY' AND ((day = '$day' AND month_no = '$month' AND year = '$year')) AND active = '1'";
        $result_holiday = mysql_query($sql_holiday);
        $num_rows       = mysql_num_rows($result_holiday);
        if ($num_rows == 1) {
            //echo "<center><b><font style='font-size:12px;color:#2A55FF'>Date selected falls on Public Holiday. Please note any bookings made will be considered as peak hour booking.</font></b></center>";
            $_SESSION['holiday'] = true;
        } else {
            $_SESSION['holiday'] = false;
        }
        // end
?></td>

                      		</tr>

                            <tr>

                            <?
        if ($all_system_disabled == '1' && ($_SESSION['newbook'] != 1 || $_SESSION['next2hour'] == 1) && $user_type == '2') {
?>

                            <td colspan="9" align="right">

                            &raquo; <a href="booking.php?crypted=<?
            echo $_GET['crypted'];
?>&page=book_now&id=<?
            echo $_GET['id'];
?>&fac=<?
            echo $_GET['fac'];
?>&user_id=<?
            echo $_GET['user_id'];
?>&next=next">Next 2 hours</a>&nbsp;&nbsp;                            </td>

                            </tr>

                            <?
        }
?>

                            

							<?
        if ($auto_close_date == 1) {
            $getselecteddate   = explode("-", $_POST['date_sel']);
            $facilityfromddate = explode(".", $facility_closed_from);
            $facilitytodate    = explode(".", $facility_closed_to);
            $newfacilityfrom   = $facilityfromddate[2] . $facilityfromddate[1] . $facilityfromddate[0];
            $newfacilityto     = $facilitytodate[2] . $facilitytodate[1] . $facilitytodate[0];
            $checkingyear      = $getselecteddate[2] . $getselecteddate[1] . $getselecteddate[0];
            //echo $newfacilityfrom . "<=" . $checkingyear . "&&" . $checkingyear . "<=" . $newfacilityto;
            if ($newfacilityfrom <= $checkingyear && $checkingyear <= $newfacilityto) {
                $facility_closed = '1';
                //$all_system_msg = 'Facility closed for ' . $messageclosed;
            } else {
                $facility_closed = '0';
            }
        }
?>

                            

                            <?
        if ($facility_closed == 0) {
?>

                            <tr>

                            <td colspan="9">

                            <table width="100%" cellpadding="5" cellspacing="0" style="border:1px solid #333333;">

                            <tr> 

                        		<td bgcolor="#994947" style="border-right:1px solid #333333;"> 

                          		<div align="center" class="fontitle">#1</div></td>

                        		<td bgcolor="#994947" style="border-right:1px solid #333333;"> 

                          		<div align="center"><span class="fontitle">Select</span></div></td>

                        		<td bgcolor="#994947" style="border-right:1px solid #333333;"> 

                          		<div align="center" class="fontitle">From Time</div>                        </td>

                        		<td bgcolor="#994947" style="border-right:1px solid #333333;"> 

                          		<div align="center" class="fontitle">To Time</div>                        </td>

                                <?
            if ($user_type != '0') {
?>

                   			    <td bgcolor="#994947" style="border-right:1px solid #333333;"> 

                          		<div align="center" class="fontitle">Resident</div>                        </td>

                                <?
            }
?>

                        		<!--td bgcolor="#994947" style="border-right:1px solid #333333;"> 

                          		<div align="center"><span class="fontitle">Deposit Status</span></div>                        </td-->

                       		  <td bgcolor="#994947"> 

                       	      <div align="center" class="fontitle">Remarks</div></td>

                              <?
            if ($user_type == '1') {
?>

                   			  <td bgcolor="#994947" style="border-left:1px solid #333333;"> 

                       	      <div align="center" class="fontitle">Receipt</div></td>

                                <?
            }
?>

                      		</tr>

                      		

                      	<?php
            $sr             = 1;
            $count_dont_sel = 1;
            //$weak = date(w);
            $date_exp       = explode('-', $selected_date);
            $mon_sel        = $date_exp[1];
            $day_sel        = $date_exp[0];
            $year_sel       = $date_exp[2];
            $stamp          = mktime(0, 0, 0, $mon_sel, $day_sel + 1, $year_sel);
            $weak           = date('w', $stamp);
            $weak           = $weak;
            if ($weak == 0) {
                $weak = 7;
            }
            $query  = "select * from track_time where track = '$unique_no' and (weak = '0' or weak='$weak') order by peak, from_time ASC";
            //exit;
            $result = mysql_query($query);
            while ($row = mysql_fetch_array($result)) {
                $query1  = "select * from time_slot  where id = '$row[from_time]' limit 1";
                $result1 = mysql_query($query1);
                while ($row1 = mysql_fetch_array($result1)) {
                    $from_time        = $row1[time_slot];
                    $from_time_div    = $from_time / 60;
                    $from_min_div_exp = explode(':', $from_time);
                    $extra_min        = $from_min_div_exp[1];
                    $from_time_min    = (int) $extra_min + $from_min_div;
                }
                $query1  = "select * from time_slot  where id = '$row[to_time]' limit 1";
                $result1 = mysql_query($query1);
                while ($row1 = mysql_fetch_array($result1)) {
                    $to_time             = $row1[time_slot];
                    $to_time_div         = $to_time / 60;
                    $to_time_min_div_exp = explode(':', $to_time);
                    $from_min_div        = $to_time_min_div_exp[1] + $from_min_div;
                }
                $hrs = ($to_time_div - $from_time_div) * 60;
                if ($hrs >= $hours) {
                    $hrs = round($hrs / $hours);
                    for ($i = 1; $i <= $hrs; $i++) {
                        $from_time_exp = explode(':', $from_time);
                        //print_r($from_time_exp);
                        $to_time       = $from_time_exp[0] + $hours;
                        $from_time     = "$from_time_exp[0]:$from_time_exp[1]";
                        if ($display_legend != 1) {
                            $color = '#fdf5e2';
                        } else if ($row[peak] == '0' && $_SESSION['holiday'] != TRUE) {
                            $color = '#cbe8c6';
                        } else if ($row[peak] == '0' && $_SESSION['holiday'] == TRUE) {
                            // need to say to consider peak as well.
                            $color = '#ffdcd8';
                        } else if ($row[peak] == '1') {
                            $color = '#ffdcd8';
                        } else if ($row[peak] == '2') {
                            $color = '#fdf5e2';
                        }
                        if ($to_time == 24 and $from_time_exp[1] > '00') {
                            $skip = 1;
                        } else {
                            $skip = 0;
                        }
                        if ($skip != 1) {
                            //	$today_date = 
                            //	echo "$selected_date != $today_date";
                            //	$selected_date = $_POST[date_sel];
                            $now_hrs        = date('G');
                            $now_min        = date('i');
                            $newselectedate = explode("-", $selected_date);
                            $newdatetocheck = $newselectedate[2] . "-" . $newselectedate[1] . "-" . $newselectedate[0];
                            if ($selected_date == $today_date) {
                                if ($now_hrs >= $from_time_exp[0] and $now_min >= $from_time_exp[1]) {
                                    $dont_sel = "disabled = disabled";
                                    $msg      = "Time frame has lapsed";
                                }
                            }
                            $to_time = "$to_time:$from_time_exp[1]";
                            if ($dont_sel == '' || $dont_sel != '') {
                                //if ($user_type != '0') {
                                $query_my_booking = "select * from my_booking where unique_no = '$unique_no' and date_of_booking = '$newdatetocheck' and  ((status = '0') or (status = '1'))";
                                //}
                                //else
                                //{
                                //$query_my_booking = "select * from my_booking where unique_no = '$unique_no' and date_of_booking = '$selected_date' and uid = $_GET[user_id] and status !='2' ";
                                //}
                                $result_my_query  = mysql_query($query_my_booking);
                                while ($row_my = mysql_fetch_array($result_my_query)) {
                                    $fram_user_from_time       = $row_my[from_time];
                                    $fram_user_to_time         = $row_my[to_time];
                                    $explode_fram_user_to_time = explode(':', $fram_user_to_time);
                                    //	echo "$fram_user_from_time == $from_time";
                                    if ($fram_user_from_time == $from_time) {
                                        $my_booking_no            = $row_my[sno];
                                        $dont_sel                 = "disabled = disabled";
                                        $msg                      = "Slot used by other user";
                                        $registered_by_id         = $row_my[uid];
                                        $rid                      = $row_my[rid];
                                        $checked                  = "";
                                        $order_status             = $row_my[status];
                                        $amount_recived           = $row_my[amount_recived];
                                        $time_of_booking          = $row_my[time_of_booking];
                                        $allowed_cancel           = $row_my[allowed_cancel];
                                        $date_of_booking          = $row_my[date_of_booking];
                                        $greybar_info             = $row_my[day] . "-" . $row_my[month] . "-" . $row_my[year];
                                        $cancle_booking_date_time = $row_my[cancle_booking_date_time];
                                        $query_user               = "select * from user_account where id = '$registered_by_id'";
                                        $query_result             = mysql_query($query_user);
                                        while ($row_user = mysql_fetch_array($query_result)) {
                                            $registered_by = $row_user[username];
                                        }
                                    }
                                }
                            }
                            if (strlen($from_time) == 1) {
                                $from_time = str_pad($from_time, 2, "0", STR_PAD_LEFT);
                            } else {
                                $from_time = $from_time;
                            }
                            if (strlen($to_time) == 1) {
                                $to_time = str_pad($to_time, 2, "0", STR_PAD_LEFT);
                            } else {
                                $to_time = $to_time;
                            }
                            //if($closed_at)
                            if ($selected_date == $today_date) {
                                $from_time_exp = explode(':', $from_time);
                                (int) $mod = $from_time_exp[0] - $now_hrs;
                                // echo "$mod <= $closed_at";
                                $timenow = date("G:s");
                                if (strlen($timenow) == 4) {
                                    $timenow = str_pad($timenow, 5, "0", STR_PAD_LEFT);
                                } else {
                                    $timenow = $timenow;
                                }
                                if ($mod <= $closed_at and $dont_sel == '') {
                                    $dont_sel = "disabled = disabled";
                                    $msg      = "You can book this slot";
                                }
                            }


                            //Book Slot Open
                            if ($dont_sel == '' and $dont_sel != "disabled = disabled") {
                                $msg     = "You can book this slot ";
                                $checked = "checked";
                            }

                            $time_fram = "$from_time-$to_time&$row[peak]";
                            if (($order_status == '1' or $order_status == '0'))
                            // if($order_status =='1' or $order_status =='0')
                                {
                                $dont_sel       = "disabled = disabled";
                                $all_system_msg = "Slot In Use ";
                            } else if ($timenow >= $from_time) {
                                $dont_sel = "disabled = disabled";
                                $msg      = "Time frame has lapsed";
                                $checked  = "";
                            } else {
                                $dont_sel       = "";
                                $all_system_msg = "";
                            }
                            //echo $_SESSION['holiday'];
                            //echo $row[peak];
                            if ($all_system_disabled == '1' && $user_type_booked != '1') {
                                $dont_sel = "disabled = disabled";
                                $msg      = $all_system_msg;
                                $checked  = "";
                            } elseif ($row[peak] == '1' and ($all_system_disabled_peak == '1' || $all_system_disabled_peak_tennis == '1' || $all_system_disabled_peak_pools == '1') && $user_type_booked != '1') {
                                $dont_sel = "disabled = disabled";
                                $msg      = "You Exceeded Limit For Peak Time";
                                $checked  = "";
                            } elseif ($row[peak] == '0' and ($all_system_disabled_nonpeak == '1' || $all_system_disabled_nonpeak_tennis == '1' || $all_system_disabled_nonpeak_pools == '1') && $user_type_booked != '1' && $_SESSION['holiday'] != 1) {
                                $dont_sel = "disabled = disabled";
                                $msg      = "You Exceeded Limit For Non-Peak Time";
                                $checked  = "";
                            } elseif ($row[peak] == '0' and $_SESSION['holiday'] == 1 and $all_system_disabled_peak == '1' && $user_type_booked != '1') {
                                //echo "goinghere";
                                $dont_sel = "disabled = disabled";
                                $msg      = "You Exceeded Limit For Peak Time";
                                $checked  = "";
                            }
                            // check for if entertainment room is book for pool tables - start 11 Feb 2009								
                            if ($unique_no == '1294727326' || $unique_no == '1294727362') {
                                $newunique_no     = '1294727179';
                                $query_my_booking = "select * from my_booking where unique_no = '$newunique_no' and date_of_booking = '$newdatetocheck' and  ((status = '0') or (status = '1'))";
                                //}
                                //else
                                //{
                                //$query_my_booking = "select * from my_booking where unique_no = '$unique_no' and date_of_booking = '$selected_date' and uid = $_GET[user_id] and status !='2' ";
                                //}
                                $result_my_query  = mysql_query($query_my_booking);
                                $have_entertain   = mysql_num_rows($result_my_query);
                                while ($row_my = mysql_fetch_array($result_my_query)) {
                                    $fram_user_from_time = $row_my[from_time];
                                    $fram_user_to_time   = $row_my[to_time];
                                    if ($fram_user_to_time == '15:00') {
                                        $fram_user_to_time   = '16:00';
                                        $fram_user_from_time = '09:00';
                                    }
                                    $explode_fram_user_to_time = explode(':', $fram_user_to_time);
                                    //	echo "$fram_user_from_time == $from_time";
                                    if ($fram_user_from_time == $from_time) {
                                        $my_booking_no            = $row_my[sno];
                                        $dont_sel                 = "disabled = disabled";
                                        $msg                      = "Slot used by other user";
                                        $registered_by_id         = $row_my[uid];
                                        $rid                      = $row_my[rid];
                                        $checked                  = "";
                                        //$order_status  =  $row_my[status];
                                        $order_status_entertain   = $row_my[status];
                                        $amount_recived           = $row_my[amount_recived];
                                        $time_of_booking          = $row_my[time_of_booking];
                                        $allowed_cancel           = $row_my[allowed_cancel];
                                        $date_of_booking          = $row_my[date_of_booking];
                                        $greybar_info             = $row_my[day] . "-" . $row_my[month] . "-" . $row_my[year];
                                        $cancle_booking_date_time = $row_my[cancle_booking_date_time];
                                        $query_user               = "select * from user_account where id = '$registered_by_id'";
                                        $query_result             = mysql_query($query_user);
                                        while ($row_user = mysql_fetch_array($query_result)) {
                                            $registered_by = $row_user[username];
                                            if ($unique_no != '1294727326' || $unique_no != '1294727362') {
                                                $registered_by = '';
                                            }
                                        }
                                    }
                                    if (strlen($from_time) == 1) {
                                        $from_time = str_pad($from_time, 2, "0", STR_PAD_LEFT);
                                    } else {
                                        $from_time = $from_time;
                                    }
                                    if (strlen($to_time) == 1) {
                                        $to_time = str_pad($to_time, 2, "0", STR_PAD_LEFT);
                                    } else {
                                        $to_time = $to_time;
                                    }
                                    //if($closed_at)
                                    if ($selected_date == $today_date) {
                                        $from_time_exp = explode(':', $from_time);
                                        (int) $mod = $from_time_exp[0] - $now_hrs;
                                        // echo "$mod <= $closed_at";
                                        $timenow = date("G:s");
                                        if (strlen($timenow) == 4) {
                                            $timenow = str_pad($timenow, 5, "0", STR_PAD_LEFT);
                                        } else {
                                            $timenow = $timenow;
                                        }
                                        if ($mod <= $closed_at and $dont_sel == '') {
                                            $dont_sel = "disabled = disabled";
                                            $msg      = "You can book this slot";
                                        }
                                    }
                                    $time_fram = "$from_time-$to_time&$row[peak]";
                                    //echo $from_time . " >= ";
                                    //echo $fram_user_from_time . " && ";
                                    //echo $from_time . " < ";
                                    //echo $fram_user_to_time;
                                    if (($order_status_entertain == '1' or $order_status_entertain == '0') && ($from_time >= $fram_user_from_time && $from_time < $fram_user_to_time))
                                    // if($order_status =='1' or $order_status =='0')
                                        {
                                        $dont_sel       = "disabled = disabled";
                                        $msg            = "Entertainment Room session booked";
                                        $all_system_msg = "Slot In Use ";
                                    } else if ($timenow >= $from_time) {
                                        $dont_sel = "disabled = disabled";
                                        $msg      = "Time frame has lapsed";
                                        $checked  = "";
                                    }
                                    /*else
                                    
                                    {
                                    
                                    $dont_sel = "";
                                    
                                    $all_system_msg = "";
                                    
                                    }*/
                                    if ($dont_sel == '' and $dont_sel != "disabled = disabled") {
                                        $msg     = "You can book this slot ";
                                        $checked = "checked";
                                    }
                                    //echo $_SESSION['holiday'];
                                    //echo $row[peak];
                                    if ($all_system_disabled == '1' && $user_type_booked != '1') {
                                        $dont_sel = "disabled = disabled";
                                        $msg      = $all_system_msg;
                                        $checked  = "";
                                    } elseif ($row[peak] == '0' and ($all_system_disabled_nonpeak == '1' || $all_system_disabled_nonpeak_pools == '1') && $user_type_booked != '1' && $_SESSION['holiday'] != 1) {
                                        $dont_sel = "disabled = disabled";
                                        $msg      = "You Exceeded Limit For Non-Peak Time";
                                        $checked  = "";
                                    }
                                }
                            }
                            // Lapse Date Checking
                            $datenow = date('d-m-Y'); 
                            $selected_date    = $_POST[date_sel]; 
                            $dnow=date('Y-m-d', strtotime($datenow));
                            $sdate=date('Y-m-d', strtotime($selected_date));

                            if($sdate < $dnow) { 
                                $msg      = "Time Frame Has lapsed";
                                $checked  = "";
                                $dont_sel = "disabled = disabled";
                            }  
                            // end 11 Feb 2009
?>

                      	<tr bgcolor="<?php
                            echo $color;
?>" <?
                            if ($msg != '') {
?>onMouseover="ddrivetip('<?php
                                echo " $msg ";
?>')";

 onMouseout="hideddrivetip()" <?
                            }
?>> 

                        <td align="center" valign="top" style="border-right:1px solid #333333;border-top:1px solid #333333;"> 

                        <div align="center"> 

                        <?php
                            echo $sr;
?>                          </div>                        </td>

                        <td valign="top" style="border-right:1px solid #333333;border-top:1px solid #333333;"><label> 

                        <div align="center"> 

                        <?php
                            if ($dont_sel != '') {
                                $count_dont_sel++;
                            }
?>

                        <?
                            if ($dont_sel != '') {
                                echo "<font color='#FF0000'><strong>X</strong></font>";
                            } else {
?><input name="time_fram" type="radio" value="<?php
                                echo $time_fram;
?>" <?php
                                echo "$checked";
?> <?php
                                echo $dont_sel;
?> <?
                                if ($msg != '') {
?>title="<?php
                                    echo $msg;
?>" <?
                                }
?> onclick="alert('<?php
                                echo "You have selected  $name_fac  for date  $selected_date from $from_time hrs to $to_time hrs";
?> ');"   ><?
                            }
?>

                        </div>

                        </label></td>

                        <td valign="top" style="border-right:1px solid #333333;border-top:1px solid #333333;"> 

                        <div align="center"> <?php
                            if (strlen($from_time) == 4) {
                                $from_time = str_pad($from_time, 5, "0", STR_PAD_LEFT);
                            } else {
                                $from_time = $from_time;
                            }
                            if (strlen($to_time) == 4) {
                                $to_time = str_pad($to_time, 5, "0", STR_PAD_LEFT);
                            } else {
                                $to_time = $to_time;
                            }
                            echo $from_time;
                            $from_time_recorded = $from_time;
                            $to_time_recorded   = $to_time;
?>                          </div>                        </td>

                        <?php
                            $from_time = $to_time;
?>

                        <td valign="top" style="border-right:1px solid #333333;border-top:1px solid #333333;"> 

                        <div align="center"> 

                        <?php
                            echo $to_time;
?>                          </div>                        </td>

                        <?
                            if ($user_type != '0') {
?>

                   		<td valign="top" align="center" style="border-right:1px solid #333333;border-top:1px solid #333333;"> 

                        <?php
                                if ($registered_by_id == $id || $user_type == '1' || $rid == $id || $user_type == '2') {
                                    echo $registered_by;
                                }
                                echo "&nbsp;";
?>                                               </td>

                        <?
                            }
?>

                        <!--td valign="top" align="center" style="border-right:1px solid #333333;border-top:1px solid #333333;"> 

                <?php
                            /* 
                            
                            $dont_sel ='';
                            
                            if($order_status == '1' && $auto_apporve != '1')
                            
                            {
                            
                            echo $icon = "PAID";
                            
                            }
                            
                            elseif($order_status == '0' && $auto_apporve != '1')
                            
                            {
                            
                            echo $icon = "&nbsp;";
                            
                            }
                            
                            elseif($order_status == '2')
                            
                            {
                            
                            echo $icon = "&nbsp;";
                            
                            }
                            
                            elseif($dont_sel != '')
                            
                            {
                            
                            echo $icon = "&nbsp;";
                            
                            }
                            
                            else
                            
                            {
                            
                            if($row[peak] =='1')
                            
                            {
                            
                            echo $icon = "&nbsp;";
                            
                            }
                            
                            else
                            
                            {
                            
                            echo $icon = "&nbsp;";
                            
                            }
                            
                            } */
?>                              </td-->

                        <td valign="top" align="center" style="border-top:1px solid #333333;">

						

						<?
                            // check time now
                            $checking_cancel = date("Y-m-dHi");
                            if ($user_type == '0') {
                                if ($registered_by_id == $id || $rid == $id) {
                                    if ($order_status == '0') {
                                        echo "Pending<br>";
                                        if ($allowed_cancel >= $checking_cancel) {
?>

													[ <a href="redirect.php?<?php
                                            echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=1";
?>" onclick="return validateprompt();">Cancel</a> ]

													<?
                                        }
                                    } else if ($order_status == '1') {
                                        echo "Approved<br>";
                                        //echo $allowed_cancel . ">=" . $checking_cancel;
                                        if ($allowed_cancel >= $checking_cancel) {
                                            //echo $allowed_cancel . ">=" . $checking_cancel;
?>

													[ <a href="redirect.php?<?php
                                            echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=2";
?>" onclick="return validateprompt();">Cancel</a> ]

													<?
                                        }
                                    } else {
                                        echo "&nbsp;";
                                    }
                                } else
                                // if booking made by other resident
                                    if ($order_status == '1' || $order_status == '0') {
                                    echo "Already Booked";
                                }
                                // if no booking done
                                else {
                                    echo "&nbsp;";
                                }
                            } else if ($user_type == '1') {
                                if ($order_status == '0') {
                                    echo "Pending<br>";
                                    // if cancel within time limit
                                    if ($allowed_cancel >= $checking_cancel) {
?>

                                                [ <a href="redirect.php?<?php
                                        echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=approve";
?>">Approve</a> ] [ <a href="redirect.php?<?php
                                        echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=7";
?>" onclick="return validateprompt();">Cancel</a> ]

                                                <?
                                    }
                                    // if still not paid but limit has reach
                                    else {
?> 

                                                [ <a href="redirect.php?<?php
                                        echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=approve";
?>">Approve</a> ] [ <a href="redirect.php?<?php
                                        echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=9";
?>" onclick="return validateprompt();">Cancel</a> ]

                                                  <?
                                    }
                                } else if ($order_status == '1') {
                                    echo "Approved<br>";
                                    // can still cancel as long as limit not reach
                                    if ($allowed_cancel >= $checking_cancel) {
?>

                                                [ <a href="redirect.php?<?php
                                        echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=8";
?>" onclick="return validateprompt();">Cancel</a> ]

                                                <?
                                    }
                                    // illegal if more than time limit, but need so that they can release the booking for other residents
                                    else {
?>

                                                [ <a href="redirect.php?<?php
                                        echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=9";
?>" onclick="return validateprompt();">Cancel</a> ]

                                                <?
                                    }
                                    $compare_date = date("Y-m-d");
                                    // check once approved, to show absent link
                                    if ($date_of_booking == $compare_date) {
                                        $breakfromtime = explode(":", $from_time_recorded);
                                        $breaktotime   = $breakfromtime[0] . ":30";
                                        $breaktime     = date("H:i");
                                        if ($breaktime >= $from_time_recorded && $breaktime <= $to_time_recorded)
                                        //if ($breaktime >= '02:56' && $breaktime <= '03:04')
                                            {
?>

													[ <a href="redirect.php?<?php
                                            echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=11";
?>">Absent</a> ]

													<?
                                        }
                                        //check also for rain on same day if outdoor
                                        $sqloutdoor    = "SELECT type FROM facility WHERE unique_no = '$unique_no'";
                                        $resultoutdoor = mysql_query($sqloutdoor);
                                        $outdoorrow    = mysql_fetch_array($resultoutdoor);
                                        if ($outdoorrow['type'] == 1) {
                                            $breakfromtime      = explode(":", $from_time_recorded);
                                            $breakfromtimestart = $breakfromtime[0];
                                            if ($breakfromtimestart[0] == 0) {
                                                $newbreakfromtime = "0" . ($breakfromtimestart[1] - 1) . ":30";
                                            } else {
                                                $newbreakfromtime = ($breakfromtimestart - 1) . ":30";
                                            }
                                            $newbreaktotime = $breakfromtime . ":30";
                                            $breaktime      = date("H:i");
                                            if ($breaktime >= $from_time_recorded && $breaktime <= $to_time_recorded)
                                            //if ($breaktime >= '02:56' && $breaktime <= '03:04')
                                                {
?>

														[ <a href="redirect.php?<?php
                                                echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=10";
?>">Rain</a> ]

														<?
                                            }
                                        }
                                    }
                                } else {
                                    echo "&nbsp;";
                                }
                            } else if ($user_type == '2') {
                                if ($order_status == '0') {
                                    echo "Pending<br>";
                                    if ($allowed_cancel >= $checking_cancel) {
?>

                                                [ <a href="redirect.php?<?php
                                        echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=approve";
?>">Approve</a> ] [ <a href="redirect.php?<?php
                                        echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=3";
?>" onclick="return validateprompt();">Cancel</a> ]

                                                <?
                                    }
                                    // if still not paid but limit has reach
                                    else {
?> 

                                                [ <a href="redirect.php?<?php
                                        echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=approve";
?>">Approve</a> ]

                                                  <?
                                    }
                                } else if ($order_status == '1') {
                                    echo "Approved<br>";
                                    if ($allowed_cancel >= $checking_cancel) {
?>

                                                [ <a href="redirect.php?<?php
                                        echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=4";
?>" onclick="return validateprompt();">Cancel</a> ]

                                                <?
                                    }
                                    $compare_date = date("Y-m-d");
                                    // check once approved, to show absent link
                                    if ($date_of_booking == $compare_date) {
                                        $breakfromtime = explode(":", $from_time_recorded);
                                        $breaktotime   = $breakfromtime[0] . ":30";
                                        $breaktime     = date("H:i");
                                        if ($breaktime >= $from_time_recorded && $breaktime <= $breaktotime)
                                        //if ($breaktime >= '02:56' && $breaktime <= '03:04')
                                            {
?>

													[ <a href="redirect.php?<?php
                                            echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=6";
?>">Absent</a> ]

													<?
                                        }
                                        //check also for rain on same day if outdoor
                                        $sqloutdoor    = "SELECT type FROM facility WHERE unique_no = '$unique_no'";
                                        $resultoutdoor = mysql_query($sqloutdoor);
                                        $outdoorrow    = mysql_fetch_array($resultoutdoor);
                                        if ($outdoorrow['type'] == 1) {
                                            $breakfromtime      = explode(":", $from_time_recorded);
                                            $breakfromtimestart = $breakfromtime[0];
                                            if ($breakfromtimestart[0] == 0) {
                                                $newbreakfromtime = "0" . ($breakfromtimestart[1] - 1) . ":30";
                                            } else {
                                                $newbreakfromtime = ($breakfromtimestart - 1) . ":30";
                                            }
                                            $newbreaktotime = $breakfromtime[0] . ":30";
                                            $breaktime      = date("H:i");
                                            if ($breaktime >= $from_time_recorded && $breaktime <= $to_time_recorded)
                                            //if ($breaktime >= '02:56' && $breaktime <= '03:04')
                                                {
                                                //echo $breaktime . ">=" . $newbreakfromtime . "&&" . $breaktime . "<=" . $newbreaktotime;
?>

                                                        

														[ <a href="redirect.php?<?php
                                                echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=5";
?>">Rain</a> ]

														<?
                                            }
                                        }
                                    }
                                } else {
                                    echo "&nbsp;";
                                }
                            }
?>						</td>

                        	<?php
                            if ($user_type == '1') {
?>

                        		<td valign="top" style="border-left:1px solid #333333;border-top:1px solid #333333;"> 

                          		<div align="center"> 

                            	<?php
                                if ($order_status == '0' or $order_status == '1' and $amount_recived == '') {
                                    //echo "<img src=images/dollar_icon_gray.jpg>";
                                    echo "&nbsp;";
                                } elseif (($order_status == '0' || $order_status == '1') && $user_type == 1) {
                                    echo "<a href=javascript:openwindow('receipt.php?id=$my_booking_no')><strong>View</strong></a>";
                                } else {
                                    echo "&nbsp;";
                                }
                                $show         = '';
                                $order_status = "";
?>

                          		</div>                                </td>

                                <?
                            }
?>

                      		</tr>

                            <?
                            if ($user_type != '0' && $time_of_booking != '') {
?>

                            <tr bgcolor="#CCCCCC">

                            <td colspan="10" style="font-size: 11px;"><i><?php
                                if ($time_of_booking != '')
                                    echo "<b>Booked on </b>$greybar_info at $time_of_booking";
                                $time_of_booking = '';
?>&nbsp;&nbsp; 

							<?php
                                if ($date_of_conf != '') {
                                    echo " | <b>Approved on </b>$date_of_conf";
                                }
                                if ($cancle_booking_date_time != '') {
                                    echo " | <b>Cancelled on </b>$row[cancle_booking_date_time]";
                                }
?> </i></td>

                      	</tr>

                        <?
                            }
?>

                      	<?
                            $dont_sel         = "";
                            $msg              = "";
                            $registered_by_id = '';
                            $registered_by    = '';
                            $greybar_info     = '';
                            $order_status     = "";
                            $icon             = "";
                            $sr++;
                        }
                    }
                }
            }
?>

                            </table>                            </td>

                            </tr>

                      		

            <tr> 

                <td colspan="2"><label> 

                <?php
            if ($count_dont_sel == $sr) {
                $dis = "disabled=disabled";
            }
?>

                <input type="submit" name="Submit4" value="Book Now" <?php
            if ($user_type != '0') {
?> id="book_now" <?php
            }
?>  <?php
            echo $dis;
?>>

                </label>

				<?php
            //Script added By Vasanth to check the advance booking dates [23-Nov-2015]
            $selected_date    = $_POST[date_sel];
            $Getselected_date = explode("-", $selected_date);
            $choosen_date     = $Getselected_date[2] . "-" . $Getselected_date[1] . "-" . $Getselected_date[0];
            $popupOne         = date('Y-m-d', strtotime(' +3 day'));
            if ($choosen_date > $popupOne) {
                $_fac      = $_GET['fac'];
                $sql       = "SELECT popup FROM `facility` WHERE sno='$_fac '";
                $res_popup = mysql_query($sql);
                $row_popup = mysql_fetch_array($res_popup);
?>
				
					<div id="element_to_pop_up" title="">

					<p><?= stripslashes($row_popup['popup']) ?></p>

					</div>
			 <?
            }
            //End Of Code - Script added By Vasanth
?>      

                </td>

                <td colspan="7">

                <?
            if ($display_legend == 1) {
?> 

                <table width="100%" border="0">

                <tr> 

                	<td>

                    <div align="right">Legend: <img src="images/legend.jpg" width="510" height="17" align="absmiddle"></div>                    </td>

                </tr>

                </table>

                <?
            } else {
                echo "&nbsp;";
            }
?></td>

			</tr>

            <?
        } else {
?>

            <tr>

            <td colspan="9" align="center">

            Facility is currently closed from  <?
            echo $facility_closed_from;
?> to <?
            echo $facility_closed_to;
?> - <?
            echo $messageclosed;
?>            </td>

            </tr>

            <?
        }
?>

            </table>

            <?php
    }
    // if session based
    elseif ($error != '1' and $os == 'sess') {
        $selected_date = $_POST[date_sel];
        $today_date    = date('d-m-Y');
        // curent_date is the date selected page
        $curent_date;
?>

            <table width="100%" border="0" align="center">

            <tr> 

            <td colspan="9">

            <?
        $currentdatetocheck = explode("-", $curent_date);
        $new_current_date   = $currentdatetocheck[2] . "-" . $currentdatetocheck[1] . "-" . $currentdatetocheck[0];
        $sqlbar             = "SELECT * FROM table_barred WHERE user_id = '$_GET[user_id]' AND facility_id = '$unique_no' AND bar_expiry >= '$new_current_date'";
        $resultbar = mysql_query($sqlbar) or mysql_error();
        $bar_counter = mysql_num_rows($resultbar);
        //echo "<br>You have " . $bar_counter . " barred.";
        if ($bar_counter > 0) {
            //$all_system_disabled = '1';
            $facility_bar   = '1';
            $all_system_msg = 'Please contact Management for further details';
        }
?>

									<?php
        if ($all_system_disabled == "1" && $facility_bar != "1" && $_SESSION['newbook'] != 1 && $user_type_booked != '1') {
            echo "<div align=center>   <img src=images/buttons/warning-button.jpg width=580 height=53 > </div>";
            $msg            = "You Have Reached The Limit For this facility";
            $all_system_msg = 'You Have Reached The Limit For this facility';
        } else if ($facility_bar == '1') {
            $all_system_disabled = '1';
            $all_system_msg      = 'Please contact Management for further details';
            echo "<div align=center>   <img src=images/buttons/barred.jpg width=580 height=53 > </div>";
        }
?>            </td>

		</tr>

        <?
        if ($auto_close_date == 1) {
            $getselecteddate   = explode("-", $_POST['date_sel']);
            $facilityfromddate = explode(".", $facility_closed_from);
            $facilitytodate    = explode(".", $facility_closed_to);
            $newfacilityfrom   = $facilityfromddate[2] . $facilityfromddate[1] . $facilityfromddate[0];
            $newfacilityto     = $facilitytodate[2] . $facilitytodate[1] . $facilitytodate[0];
            $checkingyear      = $getselecteddate[2] . $getselecteddate[1] . $getselecteddate[0];
            //echo $newfacilityfrom . "<=" . $checkingyear . "&&" . $checkingyear . "<=" . $newfacilityto;
            if ($newfacilityfrom <= $checkingyear && $checkingyear <= $newfacilityto) {
                $facility_closed = '1';
                //$all_system_msg = 'Facility closed for ' . $messageclosed;
            } else {
                $facility_closed = '0';
            }
        }
?>

                            

                            <?
        if ($facility_closed == 0) {
?>

                            

        <tr>

        	<td colspan="9">

            <table width="100%" cellpadding="5" cellspacing="0" border="0" style="border:1px solid #333333;">

            <tr> 

        	<td bgcolor="#994947" style="border-right:1px solid #333333;"> 

            <div align="center" class="fontitle">#2</div>                        </td>

            <td bgcolor="#994947" style="border-right:1px solid #333333;"> 

            <div align="center"><span class="fontitle">Select</span></div>                        </td>

            <td bgcolor="#994947" style="border-right:1px solid #333333;"> 

            <div align="center" class="fontitle">From Time</div>                        </td>

            <td bgcolor="#994947" style="border-right:1px solid #333333;"> 

            <div align="center" class="fontitle">To Time</div>                        </td>

            <?
            if ($user_type != '0') {
?>

            <td bgcolor="#994947" style="border-right:1px solid #333333;"> 

            <div align="center" class="fontitle">Resident</div>                        </td>

            <?
            }
?>

            <td bgcolor="#994947" style="border-right:1px solid #333333;"> 

            <div align="center"><span class="fontitle">Deposit Status</span></div>                        </td>

            <td bgcolor="#994947"> 

              <div align="center" class="fontitle">Remarks</div></td>

              <?
            if ($user_type == '1') {
?>

		    <td bgcolor="#994947" style="border-left:1px solid #333333;"> 

              <div align="center" class="fontitle">Receipt</div></td> <?
            }
?>

        </tr>

        

        <?php
            $sr             = 1;
            $count_dont_sel = 1;
            //$weak = date(w);
            $date_exp       = explode('-', $selected_date);
            $mon_sel        = $date_exp[1];
            $day_sel        = $date_exp[0];
            $year_sel       = $date_exp[2];
            $stamp          = mktime(0, 0, 0, $mon_sel, $day_sel, $year_sel);
            $weak           = date('w', $stamp);
            $weak           = $weak + 1;
            $query          = "select * from track_time where track = '$unique_no' and (weak = '0' or weak='$weak') order by peak, from_time ASC";
            $result         = mysql_query($query);
            while ($row = mysql_fetch_array($result)) {
                $query1  = "select * from time_slot  where id = '$row[from_time]' limit 1";
                $result1 = mysql_query($query1);
                while ($row1 = mysql_fetch_array($result1)) {
                    $from_time = $row1[time_slot];
                }
                $query1  = "select * from time_slot  where id = '$row[to_time]' limit 1";
                $result1 = mysql_query($query1);
                while ($row1 = mysql_fetch_array($result1)) {
                    $to_time = $row1[time_slot];
                }
                if ($display_legend != 1) {
                    $color = '#fdf5e2';
                } else if ($row[peak] == '0') {
                    $color = '#cbe8c6';
                } else if ($row[peak] == '1') {
                    $color = '#ffdcd8';
                } else if ($row[peak] == '2') {
                    $color = '#fdf5e2';
                }
                if ($selected_date == $today_date) {
                    (int) $mod = $from_time_exp[0] - $now_hrs;
                    if ($mod <= $closed_at) {
                        $dont_sel = "disabled = disabled";
                        $msg      = "You can book this slot";
                    }
                }
                $chose_date       = explode("-", $selected_date);
                $choosen_date     = $chose_date[2] . "-" . $chose_date[1] . "-" . $chose_date[0];
                $query_my_booking = "select * from my_booking where unique_no = '$unique_no' and date_of_booking = '$choosen_date' and ((status = '0') OR (status = '1')) ";
                $result_my_query  = mysql_query($query_my_booking);
                while ($row_my = mysql_fetch_array($result_my_query)) {
                    $fram_user_from_time = $row_my[from_time];
                    $fram_user_to_time   = $row_my[to_time];
                    $status              = $row_my[status];
                    if ($status == '1') {
                        //	echo 	$icon = "<img src=images/3.jpg>";
                    }
                    $date_of_booking           = $row_my[date_of_booking];
                    $explode_fram_user_to_time = explode(':', $fram_user_to_time);
                    //echo "$fram_user_from_time == $from_time";
                    //$dont_sel = '';
                    if ($fram_user_from_time == $from_time and $row_my[status] != '2') {
                        $dont_sel                 = "disabled = disabled";
                        $msg                      = "Time from used by other user";
                        $registered_by_id         = $row_my[uid];
                        $rid                      = $roy_my[rid];
                        $checked                  = "";
                        $order_status             = $row_my[status];
                        $allowed_cancel           = $row_my[allowed_cancel];
                        $amount_recived           = $row_my[amount_recived];
                        $my_booking_no            = $row_my[sno];
                        $date_of_conf             = $row_my[date_of_conf];
                        $time_of_booking          = $row_my[time_of_booking];
                        $date_of_booking          = $row_my[date_of_booking];
                        $cancle_booking_date_time = $row_my[cancle_booking_date_time];
                        $greybar_info             = $row_my[day] . "-" . $row_my[month] . "-" . $row_my[year];
                        $query_user               = "select * from user_account where id = '$registered_by_id'";
                        $query_result             = mysql_query($query_user);
                        while ($row_user = mysql_fetch_array($query_result)) {
                            $registered_by = $row_user[username];
                        }
                    }
                }
                if (strlen($from_time) == 1) {
                    $from_time = str_pad($from_time, 2, "0", STR_PAD_LEFT);
                } else {
                    $from_time = $from_time;
                }
                if (strlen($to_time) == 1) {
                    $to_time = str_pad($to_time, 2, "0", STR_PAD_LEFT);
                } else {
                    $to_time = $to_time;
                }
                if (strlen($timenow) == 4) {
                    $timenow = str_pad($timenow, 5, "0", STR_PAD_LEFT);
                } else {
                    $timenow = $timenow;
                }
                //if($closed_at)
                if ($selected_date == $today_date) {
                    (int) $mod = $from_time_exp[0] - $now_hrs;
                    $timenow = date("G:s");
                    if (strlen($timenow) == 4) {
                        $timenow = str_pad($timenow, 5, "0", STR_PAD_LEFT);
                    } else {
                        $timenow = $timenow;
                    }
                    if ($mod <= $closed_at) {
                        $dont_sel = "disabled = disabled";
                        $msg      = "You can book this slot";
                        $checked  = "";
                    }
                }
                if ($dont_sel == '' and $dont_sel != "disabled = disabled") {
                    $msg     = "You can book this slot ";
                    $checked = "checked";
                }
                if (($order_status == '1' or $order_status == '0'))
                //if(($order_status =='1' or $order_status =='0') and ($user_type =='1' or $registered_by_id  ==$id))
                    {
                    $dont_sel = "disabled = disabled";
                    $msg      = "Slot In Use ";
                } else if ($timenow >= $from_time) {
                    $dont_sel = "disabled = disabled";
                    $msg      = "Time frame has lapsed";
                    $checked  = "";
                } else {
                    $dont_sel = "";
                    $msg      = "";
                }
                if ($all_system_disabled == '1' && $user_type_booked != '1') {
                    $checked  = "";
                    $dont_sel = "disabled = disabled";
                    $msg      = "$all_system_msg";
                } elseif ($row[peak] == '1' and $all_system_disabled_peak == '1' && $user_type_booked != '1') {
                    $checked  = "";
                    $dont_sel = "disabled = disabled";
                    $msg      = "$all_system_msg_peak";
                } elseif ($row[peak] == '0' and $all_system_disabled_nonpeak == '1' && $user_type_booked != '1') {
                    $checked  = "";
                    $dont_sel = "disabled = disabled";
                    $msg      = "$all_system_msg_nonpeak";
                }
                if ($dont_sel == '') {
                    $checked = "checked";
                }
                $time_fram = "$from_time-$to_time&$row[peak]";
                // check for if pool table is booked for entertainment - start 11 Feb 2009								
                if ($unique_no == '1294727179') {
                    $newunique_no     = '(unique_no = \'1294727326\' || unique_no = \'1294727362\')';
                    $query_my_booking = "select * from my_booking where " . $newunique_no . " and date_of_booking = '$choosen_date' and  from_time >= '" . $from_time . "' AND from_time < '" . $to_time . "' AND status = '1'";
                    //}
                    //else
                    //{
                    //$query_my_booking = "select * from my_booking where unique_no = '$unique_no' and date_of_booking = '$selected_date' and uid = $_GET[user_id] and status !='2' ";
                    //}
                    $result_my_query  = mysql_query($query_my_booking);
                    $have_entertain   = mysql_num_rows($result_my_query);
                    while ($row_my = mysql_fetch_array($result_my_query)) {
                        $fram_user_from_time       = $row_my[from_time];
                        $fram_user_to_time         = $row_my[to_time];
                        $explode_fram_user_to_time = explode(':', $fram_user_to_time);
                        //	echo "$fram_user_from_time == $from_time";
                        /*if($fram_user_from_time == $from_time)
                        
                        {
                        
                        $my_booking_no = $row_my[sno];
                        
                        $dont_sel = "disabled = disabled";
                        
                        $msg = "Slot used by other user";
                        
                        $registered_by_id = $row_my[uid];
                        
                        $rid = $row_my[rid];
                        
                        $checked = "";
                        
                        //$order_status  =  $row_my[status];
                        
                        echo $order_status_entertain  =  $row_my[status];
                        
                        $amount_recived  = $row_my[amount_recived];
                        
                        $time_of_booking = $row_my[time_of_booking];
                        
                        $allowed_cancel = $row_my[allowed_cancel];
                        
                        $date_of_booking = $row_my[date_of_booking];
                        
                        $greybar_info = $row_my[day] . "-" . $row_my[month] . "-" . $row_my[year];
                        
                        $cancle_booking_date_time  = $row_my[cancle_booking_date_time];
                        
                        $query_user = "select * from user_account where id = '$registered_by_id'";
                        
                        $query_result = mysql_query($query_user);
                        
                        while($row_user = mysql_fetch_array($query_result))
                        
                        {
                        
                        $registered_by = $row_user[username];
                        
                        
                        
                        
                        
                        }
                        
                        
                        
                        }*/
                    }
                    if (strlen($from_time) == 1) {
                        $from_time = str_pad($from_time, 2, "0", STR_PAD_LEFT);
                    } else {
                        $from_time = $from_time;
                    }
                    if (strlen($to_time) == 1) {
                        $to_time = str_pad($to_time, 2, "0", STR_PAD_LEFT);
                    } else {
                        $to_time = $to_time;
                    }
                    //echo $fram_user_from_time . " >= " . $from_time . " && " . $fram_user_from_time . " < " . $to_time;
                    if (($fram_user_from_time >= $from_time) && ($fram_user_from_time < $to_time) && ($have_entertain != 0))
                    // if($order_status =='1' or $order_status =='0')
                        {
                        $dont_sel       = "disabled = disabled";
                        $msg            = "Pool table hourly booked";
                        $all_system_msg = "Slot In Use ";
                    }
                }
                // end 11 Feb 2009 
?>

            <tr bgcolor="<?php
                echo $color;
?>"  <?
                if ($msg != '') {
?>onMouseover="ddrivetip('<?php
                    echo " $msg ";
?>')";

 onMouseout="hideddrivetip()" <?
                }
?>> 

            	<td align="center" valign="top" style="border-right:1px solid #333333;border-top:1px solid #333333;"> 

                <div align="center"> 

                <?php
                echo $sr;
?>                          </div>                        </td>

                <td valign="top" style="border-right:1px solid #333333;border-top:1px solid #333333;"><label> 

                <div align="center"> 

                <?php
                if ($dont_sel != '') {
                    $count_dont_sel++;
                }
?>

                <?
                if ($dont_sel != '') {
                    echo "<font color='#FF0000'><strong>X</strong></font>";
                } else {
?><input name="time_fram" type="radio" value="<?php
                    echo $time_fram;
?>" <?php
                    echo "$checked";
?> <?php
                    echo $dont_sel;
?> <?
                    if ($msg != '') {
?>title="<?php
                        echo $msg;
?>"<?
                    }
?> onclick="alert('<?php
                    echo "You have selected  $name_fac  for date  $selected_date from $from_time hrs to $to_time hrs";
?> ');"   ><?
                }
?>

                </div>

                </label>                </td>

                <td valign="top" style="border-right:1px solid #333333;border-top:1px solid #333333;"> 

                <div align="center"> 

                <?php
                echo $from_time;
                $from_time_recorded = $from_time;
?>                          </div>                        </td>

                <td valign="top" style="border-right:1px solid #333333;border-top:1px solid #333333;"> 

                <div align="center"> 

                <?php
                echo $to_time;
?>                          </div>                        </td>

                <?
                if ($user_type != '0') {
?>

                <td valign="top" style="border-right:1px solid #333333;border-top:1px solid #333333;"> 

                <div align="center"> 

                <?php
                    if ($registered_by_id == $id || $user_type == '1' || $rid == $id || $user_type == '2') {
                        echo $registered_by;
                    }
?>                          &nbsp;</div>                        </td>

                <?
                }
?>

				<td valign="top" style="border-right:1px solid #333333;border-top:1px solid #333333;"> 

                <div align="center">

                  <?php
                $dont_sel = '';
                if ($order_status == '1' && $auto_apporve != '1') {
                    echo $icon = "PAID";
                } elseif ($order_status == '0' && $auto_apporve != '1') {
                    echo $icon = "&nbsp;";
                } elseif ($order_status == '2') {
                    echo $icon = "&nbsp;";
                } elseif ($dont_sel != '') {
                    echo $icon = "&nbsp;";
                } else {
                    if ($row[peak] == '1') {
                        echo $icon = "&nbsp;";
                    } else {
                        echo $icon = "&nbsp;";
                    }
                }
?>

                </div>                        </td>

                <td valign="top" style="border-top:1px solid #333333;" align="center">

                <?
                // check time now
                $checking_cancel = date("Y-m-dHi");
                if ($user_type == '0') {
                    if ($registered_by_id == $id || $rid == $id) {
                        if ($order_status == '0') {
                            echo "Pending<br>";
                            if ($allowed_cancel >= $checking_cancel) {
?>

													[ <a href="redirect.php?<?php
                                echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=1";
?>" onclick="return validateprompt();">Cancel</a> ]

													<?
                            }
                        } else if ($order_status == '1') {
                            echo "Approved<br>";
                            if ($allowed_cancel >= $checking_cancel) {
?>

													[ <a href="redirect.php?<?php
                                echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=2";
?>" onclick="return validateprompt();">Cancel</a> ]

													<?
                            }
                        } else {
                            echo "&nbsp;";
                        }
                    } else
                    // if booking made by other resident
                        if ($order_status == '1' || $order_status == '0') {
                        echo "Already Booked";
                    }
                    // if no booking done
                    else {
                        echo "&nbsp;";
                    }
                } else if ($user_type == '1') {
                    if ($order_status == '0') {
                        echo "Pending<br>";
                        // if cancel within time limit
                        if ($allowed_cancel >= $checking_cancel) {
?>

                                                [ <a href="redirect.php?<?php
                            echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=approve";
?>">Approve</a> ] [ <a href="redirect.php?<?php
                            echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=7";
?>" onclick="return validateprompt();">Cancel</a> ]

                                                <?
                        }
                        // if still not paid but limit has reach
                        else {
?> 

                                                [ <a href="redirect.php?<?php
                            echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=approve";
?>">Approve</a> ] [ <a href="redirect.php?<?php
                            echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=9";
?>" onclick="return validateprompt();">Cancel</a> ]

                                                  <?
                        }
                    } else if ($order_status == '1') {
                        echo "Approved<br>";
                        // can still cancel as long as limit not reach
                        if ($allowed_cancel >= $checking_cancel) {
?>

                                                [ <a href="redirect.php?<?php
                            echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=8";
?>" onclick="return validateprompt();">Cancel</a> ]

                                                <?
                        }
                        // illegal if more than time limit, but need so that they can release the booking for other residents
                        else {
?>

                                                [ <a href="redirect.php?<?php
                            echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=9";
?>" onclick="return validateprompt();">Cancel</a> ]

                                                <?
                        }
                        $compare_date = date("Y-m-d");
                        // check once approved, to show absent link
                        if ($date_of_booking == $compare_date) {
                            $breakfromtime = explode(":", $from_time_recorded);
                            $breaktotime   = $breakfromtime[0] . ":30";
                            $breaktime     = date("H:i");
                            if ($breaktime >= $from_time_recorded && $breaktime <= $breaktotime)
                            //if ($breaktime >= '02:56' && $breaktime <= '03:04')
                                {
?>

													[ <a href="redirect.php?<?php
                                echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=11";
?>">Absent</a> ]

													<?
                            }
                            //check also for rain on same day if outdoor
                            $sqloutdoor    = "SELECT type FROM facility WHERE unique_no = '$unique_no'";
                            $resultoutdoor = mysql_query($sqloutdoor);
                            $outdoorrow    = mysql_fetch_array($resultoutdoor);
                            if ($outdoorrow['type'] == 1) {
                                $breakfromtime      = explode(":", $from_time_recorded);
                                $breakfromtimestart = $breakfromtime[0];
                                if ($breakfromtimestart[0] == 0) {
                                    $newbreakfromtime = "0" . ($breakfromtimestart[1] - 1) . ":30";
                                } else {
                                    $newbreakfromtime = ($breakfromtimestart - 1) . ":30";
                                }
                                $newbreaktotime = $breakfromtime . ":30";
                                $breaktime      = date("H:i");
                                if ($breaktime >= $from_time_recorded && $breaktime <= $to_time_recorded)
                                //if ($breaktime >= '02:56' && $breaktime <= '03:04')
                                    {
?>

														[ <a href="redirect.php?<?php
                                    echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=10";
?>">Rain</a> ]

														<?
                                }
                            }
                        }
                    } else {
                        echo "&nbsp;";
                    }
                } else if ($user_type == '2') {
                    if ($order_status == '0') {
                        echo "Pending<br>";
                        if ($allowed_cancel >= $checking_cancel) {
?>

                                                [ <a href="redirect.php?<?php
                            echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=approve";
?>">Approve</a> ] [ <a href="redirect.php?<?php
                            echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=3";
?>" onclick="return validateprompt();">Cancel</a> ]

                                                <?
                        }
                        // if still not paid but limit has reach
                        else {
?> 

                                                [ <a href="redirect.php?<?php
                            echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=approve";
?>">Approve</a> ]

                                                  <?
                        }
                    } else if ($order_status == '1') {
                        echo "Approved<br>";
                        if ($allowed_cancel >= $checking_cancel) {
?>

                                                [ <a href="redirect.php?<?php
                            echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=4";
?>" onclick="return validateprompt();">Cancel</a> ]

                                                <?
                        }
                        $compare_date = date("Y-m-d");
                        // check once approved, to show absent link
                        if ($date_of_booking == $compare_date) {
                            $breakfromtime = explode(":", $from_time_recorded);
                            $breaktotime   = $breakfromtime[0] . ":30";
                            $breaktime     = date("H:i");
                            if ($breaktime >= $from_time_recorded && $breaktime <= $breaktotime)
                            //if ($breaktime >= '02:56' && $breaktime <= '03:04')
                                {
?>

													[ <a href="redirect.php?<?php
                                echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=6";
?>">Absent</a> ]

													<?
                            }
                            //check also for rain on same day if outdoor
                            $sqloutdoor    = "SELECT type FROM facility WHERE unique_no = '$unique_no'";
                            $resultoutdoor = mysql_query($sqloutdoor);
                            $outdoorrow    = mysql_fetch_array($resultoutdoor);
                            if ($outdoorrow['type'] == 1) {
                                $breakfromtime      = explode(":", $from_time_recorded);
                                $breakfromtimestart = $breakfromtime[0];
                                if ($breakfromtimestart[0] == 0) {
                                    $newbreakfromtime = "0" . ($breakfromtimestart[1] - 1) . ":30";
                                } else {
                                    $newbreakfromtime = ($breakfromtimestart - 1) . ":30";
                                }
                                $newbreaktotime = $breakfromtime . ":30";
                                $breaktime      = date("H:i");
                                if ($breaktime >= $from_time_recorded && $breaktime <= $to_time_recorded)
                                //if ($breaktime >= '02:56' && $breaktime <= '03:04')
                                    {
?>

														[ <a href="redirect.php?<?php
                                    echo "crypted=$_GET[crypted]&id=$_GET[id]&page=book_now&user_id=$_GET[user_id]&fac=$_GET[fac]&date_sel=$curent_date&booking_no=$my_booking_no&type=cancle&reason=5";
?>">Rain</a> ]

														<?
                                }
                            }
                        }
                    } else {
                        echo "&nbsp;";
                    }
                }
?>                                        </td>

                        <?php
                if ($user_type == '1') {
?>

                        	<td valign="top" style="border-left:1px solid #333333;border-top:1px solid #333333;"> 

                          	<div align="center"> 

                            <?php
                    //if((($order_status =='0' or $order_status =='1') and  $amount_recived =='')   and ($user_type =='1' or $uid =='$id'))
                    if ($order_status == '0' or $order_status == '1' and $amount_recived == '') {
                        //echo "<img src=images/dollar_icon_gray.jpg>";
                        //}elseif($order_status =='1' and $amount_recived !='' and ($user_type =='1' or $uid =='$id'))
                    } elseif (($order_status == '0' || $order_status == '1') && $user_type == 1) {
                        echo "<a href=javascript:openwindow('receipt.php?id=$my_booking_no')><strong>View</strong></a>";
                    }
                    echo "&nbsp;";
                    $show         = '';
                    $order_status = "";
?>

                          	</div>                            </td>

                            <?
                }
?>

                   	  </tr>

                      <?
                if ($user_type != '0' && $time_of_booking != '') {
?>

                        <tr bgcolor="#CCCCCC">

                        <td colspan="10" style="font-size: 11px;"><i><?php
                    if ($time_of_booking != '')
                        echo "<b>Booked on </b>$greybar_info at $time_of_booking";
                    $time_of_booking = '';
?>&nbsp;&nbsp; 

							<?php
                    if ($date_of_conf != '') {
                        echo " | <b>Approved on </b>$date_of_conf";
                    }
                    if ($cancle_booking_date_time != '') {
                        echo " | <b>Cancelled on </b>$row[cancle_booking_date_time]";
                    }
?> </i></td>

					</tr>

                    <?
                }
?>

                    <?
                $dont_sel         = "";
                $msg              = "";
                $registered_by_id = '';
                $registered_by    = '';
                $greybar_info     = '';
                $order_status     = '';
                $icon             = "";
                $sr++;
            }
?>

            </table>            </td>

        </tr>

                    <tr> 

                    	<td colspan="2"><label> 

                        <?php
            if ($count_dont_sel == $sr) {
                $dis = "disabled=disabled";
            }
?>

                        <input type="submit" name="Submit4" <?php
            if ($user_type != '0') {
?> id="book_now" <?php
            }
?> value="Book Now"  <?php
            echo $dis;
?>  >

                        </label>

                        <?php
            //Script added By Vasanth to check the advance booking dates [23-Nov-2015]
            $selected_date    = $_POST[date_sel];
            $Getselected_date = explode("-", $selected_date);
            $choosen_date     = $Getselected_date[2] . "-" . $Getselected_date[1] . "-" . $Getselected_date[0];
            $popupTwo         = date('Y-m-d', strtotime(' +60 day'));
            $Get_fac          = $_GET['fac'];
            //Code Added by Vasanth - Popup for Entertainment Room [24-Nov-2015]
            $Get_facz         = $_GET['fac'];
            if (($Get_fac == '11') || ($Get_fac == '13') || ($Get_fac == '15')) {
                if ($choosen_date > $popupTwo) {
                    $_fac      = $_GET['fac'];
                    $sql       = "SELECT popup FROM `facility` WHERE sno='$_fac '";
                    $res_popup = mysql_query($sql);
                    $row_popup = mysql_fetch_array($res_popup);
?>

									<div id="element_to_pop_up" title="">

										<p><?= stripslashes($row_popup['popup']) ?></p>

									</div>
										<?
                }
            }
            if ($Get_fac == '16') {
                $selected_datez   = $_POST[date_sel];
                $Getselected_date = explode("-", $selected_datez);
                $choosen_datez    = $Getselected_date[2] . "-" . $Getselected_date[1] . "-" . $Getselected_date[0];
                $popupTwoz        = date('Y-m-d', strtotime(' +30 day'));
                echo $auto_apporve;
                if ($choosen_datez > $popupTwoz) {
                    $_fac      = $_GET['fac'];
                    $sql       = "SELECT popup FROM `facility` WHERE sno='$_fac '";
                    $res_popup = mysql_query($sql);
                    $row_popup = mysql_fetch_array($res_popup);
?>

								<div id="element_to_pop_up" title="">

									<p><?= stripslashes($row_popup['popup']) ?></p>

								</div>
							  <?
                }
            }
            //End of Script - Added By Vasanth
?>
                        

                        </td>

                        <td colspan="7"> 

                        <?
            if ($display_legend == 1) {
?> 

                		<table width="100%" border="0">

                        <tr> 

                        	<td>

                            <div align="right">Legend: <img src="images/legend.jpg" width="510" height="17" align="absmiddle"></div>                            </td>

                        </tr>

                        </table>

                        <?
            } else {
                echo "&nbsp;";
            }
?>                        </td>

                    </tr>

                    <?
        } else {
?>

            <tr>

            <td colspan="9" align="center">

            Facility is currently closed from  <?
            echo $facility_closed_from;
?> to <?
            echo $facility_closed_to;
?> - <?
            echo $messageclosed;
?>            </td>

            </tr>

            <?
        }
?>

                    </table>

                    <?php
    }
?>                    </td>

				</tr>

                </table>

              </form>

                <?php
}
if ($_GET[page] == 'all') {
    // print_r($_POST);
    if (isset($_POST[date_sel_all]) || isset($_GET[date_sel_all])) {
        if (($_POST[date_sel_all] == '' or $_POST[date_sel_all_end] == '') && ($_GET[date_sel_all] == '' or $_GET[date_sel_all_end] == '')) {
            echo "<div align=center><font color=red> <b>Please provide proper date range</b> </font></div>";
            $er = 1;
        } else if (isset($_GET['sort'])) {
            $date_sel_all     = $_GET[date_sel_all];
            $date_sel_all_end = $_GET[date_sel_all_end];
            $menu2            = $_GET[menu2];
            $user_sel         = $_GET[user_sel];
            $select           = $_GET[select];
        } else {
            isset($_POST[date_sel_all]) ? $date_sel_all = $_POST[date_sel_all] : $date_sel_all = $_GET[date_sel_all];
            isset($_POST[date_sel_all_end]) ? $date_sel_all_end = $_POST[date_sel_all_end] : $date_sel_all_end = $_GET[date_sel_all_end];
            isset($_POST[menu2]) ? $menu2 = $_POST[menu2] : $menu2 = $_GET[menu2];
            isset($_POST[user_sel]) ? $user_sel = $_POST[user_sel] : $user_sel = $_GET[user_sel];
            isset($_POST[select]) ? $select = $_POST[select] : $select = $_GET[select];
            //$date_sel_all = $_POST[date_sel_all];
            //$date_sel_all_end = $_POST[date_sel_all_end];
            //$menu2 = $_POST[menu2];
            //$user_sel = $_POST[user_sel];
            //$select = $_POST[select];
        }
    }
?>

                  	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

                    <tr>

                    	<td style="background-repeat:no-repeat"><div align="right"><img src="images/left_win_10.gif" width="21" height="30" border="0"></div></td>

                      	<td width="100%" background="images/middle_win_11.gif"><span class="fontitle style1"><strong>View Booking </strong></span></td>

                      	<td><img src="images/right_win_14.gif" width="17" height="30"></td>

                    </tr>

                    <tr>

                    	<td colspan="3">

                        <table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">

                        <form name="form_1" method="post" action="?page=all&crypted=<?
    echo $_GET[crypted];
?>" <?
    if ($user_type == '0') {
?>onSubmit="return validate()"<?
    }
?>>

                        <tr>

                        <td colspan="4" bgcolor="#944542" class="fontitle txtgrey" style="border-left:1px solid #b09852;border-right:1px solid #b09852; padding-left:15px; padding-top:5px; padding-bottom:5px;"><span class="fontitle">&nbsp;<strong>Booking  Details <?php
    echo date("l dS M Y h:i:s A");
?></strong></span></td>

                        </tr>

                        <tr>

                        <td width="19%" style="padding-left:15px; padding-top:5px; padding-bottom:5px;">Start Date </td>

                        <td width="31%" style="padding-left:15px; padding-top:5px; padding-bottom:5px;"><label>

                            <input name="date_sel_all" type="text" value="<?php
    echo $date_sel_all;
?>" size="8" maxlength="10" readonly="">

                            </label>

                            <img src="images/icon-calender.gif" width="19" height="18"  onclick="displayCalendar(document.forms[0].date_sel_all,'dd-mm-yyyy',this)" value="Cal">

                          <label></label></td>

                        <td width="15%" style="padding-left:15px; padding-top:5px; padding-bottom:5px;"><label>End Date</label></td>

                        <td width="35%" style="padding-left:15px; padding-top:5px; padding-bottom:5px;"><label>

                            <input name="date_sel_all_end" type="text" value="<?php
    echo $date_sel_all_end;
?>" size="8" maxlength="10" readonly="">

                            </label>

                            <img src="images/icon-calender.gif" width="19" height="18"  onclick="displayCalendar(document.forms[0].date_sel_all_end,'dd-mm-yyyy',this)" value="Cal">

                            <label></label></td>

                        </tr>

                        <tr>

                          <td style="padding-left:15px; padding-top:5px; padding-bottom:5px;">Facility</td>

                          <td style="padding-left:15px; padding-top:5px; padding-bottom:5px;"><select name="menu2" >

                            	<option value="0">See All</option>

                                <?php
    $query  = "select * from facility where enable ='1' ORDER BY name ASC";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result)) {
        $unique_no = $row[unique_no];
        if ($menu2 == $row[unique_no]) {
            $sel_fac = "selected = selected";
        } else {
            $sel_fac = "";
        }
        echo " <option value=$row[unique_no] $sel_fac>$row[name]</option>";
    }
?>

                       	  </select></td>

                          <?
    if ($user_type != '0') {
?> 

                          <td style="padding-left:15px; padding-top:5px; padding-bottom:5px;">User</td>

                          <td style="padding-left:15px; padding-top:5px; padding-bottom:5px;">

                          

                          <select name="user_sel"  >

                                <?php
        if ($user_type == '0') {
            $sel_user_dis = " and id = '$id' limit 1";
            $user_sel     = $id;
        } else {
            echo "   <option value=0>All User</option>";
        }
?>

                                <?php
        $query  = "select * from user_account where active ='1' $sel_user_dis";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result)) {
            if ($user_sel == $row[id]) {
                $sel = "selected = selected";
            } else {
                $sel = "";
            }
            echo " <option value=$row[id] $sel>$row[username]</option>";
        }
?>

                              	</select></td><?
    } else {
?>

                                <td style="padding-left:15px; padding-top:5px; padding-bottom:5px;">Status</td>

                          <td style="padding-left:15px; padding-top:5px; padding-bottom:5px;">

                          <input type="hidden" name="user_sel" value="<?
        echo $id;
?>"><select name="select">

                                <?php
        if ($select == '0') {
            $sel_sel_1 = "selected";
        } elseif ($select == '1') {
            $sel_sel_2 = "selected";
        } elseif ($select == '2') {
            $sel_sel_3 = "selected";
        } elseif ($select == '7') {
            $sel_sel_0 = "selected";
        } elseif ($select == '3') {
            $sel_sel_4 = "selected";
        } elseif ($select == '4') {
            $sel_sel_5 = "selected";
        } elseif ($select == '5') {
            $sel_sel_6 = "selected";
        } elseif ($select == '6') {
            $sel_sel_7 = "selected";
        }
?>

                                	<option value="7" <?php
        echo $sel_sel_0;
?>>All Status</option>

                                	<option value="0" <?php
        echo $sel_sel_1;
?>>Pending Approval</option>

                                	<option value="1" <?php
        echo $sel_sel_2;
?>>Approved</option>

                                	<option value="2" <?php
        echo $sel_sel_3;
?>>Cancelled</option>

                              		<option value="3" <?php
        echo $sel_sel_4;
?>>Rain</option>

                              		<option value="4" <?php
        echo $sel_sel_5;
?>>Absent</option>

                              		<!--<option value="5" <?php
        echo $sel_sel_6;
?>>Improper Cancellation</option>-->

                              		<option value="6" <?php
        echo $sel_sel_7;
?>>Lapsed</option>

                              	</select></td>

                                 

                                <?
    }
?>

                          </tr>

                        <tr>

                        <?
    if ($user_type != 0) {
?>

                          <td style="padding-left:15px; padding-top:5px; padding-bottom:5px;">Status</td>

                          <td style="padding-left:15px; padding-top:5px; padding-bottom:5px;"><select name="select">

                                <?php
        if ($select == '0') {
            $sel_sel_1 = "selected";
        } elseif ($select == '1') {
            $sel_sel_2 = "selected";
        } elseif ($select == '2') {
            $sel_sel_3 = "selected";
        } elseif ($select == '7') {
            $sel_sel_0 = "selected";
        } elseif ($select == '3') {
            $sel_sel_4 = "selected";
        } elseif ($select == '4') {
            $sel_sel_5 = "selected";
        } elseif ($select == '5') {
            $sel_sel_6 = "selected";
        } elseif ($select == '6') {
            $sel_sel_7 = "selected";
        }
?>

                                	<option value="7" <?php
        echo $sel_sel_0;
?>>All Status</option>

                                	<option value="0" <?php
        echo $sel_sel_1;
?>>Pending Approval</option>

                                	<option value="1" <?php
        echo $sel_sel_2;
?>>Approved</option>

                                	<option value="2" <?php
        echo $sel_sel_3;
?>>Cancelled</option>

                              		<option value="3" <?php
        echo $sel_sel_4;
?>>Rain</option>

                              		<option value="4" <?php
        echo $sel_sel_5;
?>>Absent</option>

                              		<!--<option value="5" <?php
        echo $sel_sel_6;
?>>Improper Cancellation</option>-->

                              		<option value="6" <?php
        echo $sel_sel_7;
?>>Lapsed</option>

                              	</select></td>

                                <?
    } else {
?>

                                <td>&nbsp;</td>

                          		<?
    }
?>

                          <td>&nbsp;</td>

                          <td style="padding-left:15px; padding-top:5px; padding-bottom:5px;"><input type="submit" name="Submit7" value="Submit" ></td>

                          </tr>

                        </form>

                        </table>

                      </td>

                   	  </tr>

                    	<tr>

                      		<td colspan="3">

                            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">

                          	<tr>

                            	<td bgcolor="#FFFFFF"><?php
    //	echo "$_POST[date_sel_all] !='' and $er !='1'";
    isset($_GET['er']) ? $er = $_GET['er'] : $er = '';
    if (($_POST[date_sel_all] != '' || $_GET[date_sel_all] != '') and $er != '1') {
        isset($_POST[user_sel]) ? $user_sel = $_POST[user_sel] : $user_sel = $_GET[user_sel];
        isset($_POST[menu2]) ? $menu2 = $_POST[menu2] : $menu2 = $_GET[menu2];
        isset($_POST[select]) ? $select = $_POST[select] : $select = $_GET[select];
?>

                                <table width="100%" border="0" cellpadding="5" cellspacing="0" style="border:1px solid #333333;">

                                <form>

                                <tr>

                                  <td colspan="12">

								  [ <a href="javascript:void();" onclick="MM_openBrWindow('printing.php?<?php
        echo "crypted=$_GET[crypted]&page=$_POST[page]&date_sel_all=$_POST[date_sel_all]&date_sel_all_end=$_POST[date_sel_all_end]&select=$_POST[select]&menu2=$_POST[menu2]&user_sel=$_POST[user_sel]&er=$_POST[er]&user_type=$_SESSION[user_type]";
?>','','status=no,width=850,height=600,toolbar=no,titlebar=no,resizable=yes,scrollbars=yes')">print</a> ]</td>

                                  </tr>

                                  </form>

                                <tr>

                                	<td width="3%" bgcolor="#944542" style="border-right:1px solid #333333;"><div align="center" class="fontitle">#</div></td>

                                  <td width="11%" bgcolor="#944542" style="border-right:1px solid #333333;"><div align="center" class="fontitle"><?
        if ($user_type != '0') {
?><a href="booking.php?page=all&select=<?
            if (isset($_POST[select])) {
                echo $_POST[select];
            } else {
                echo $_GET[select];
            }
?>&user_sel=<?
            if (isset($_POST[user_sel])) {
                echo $_POST[user_sel];
            } else {
                echo $_GET[user_sel];
            }
?>&menu2=<?
            if (isset($_POST[menu2])) {
                echo $_POST[menu2];
            } else {
                echo $_GET[menu2];
            }
?>&crypted=<?
            echo $_GET[crypted];
?>&sort=facility&date_sel_all=<?
            if (isset($_POST[date_sel_all])) {
                echo $_POST[date_sel_all];
            } else {
                echo $_GET[date_sel_all];
            }
?>&date_sel_all_end=<?
            if (isset($_POST[date_sel_all_end])) {
                echo $_POST[date_sel_all_end];
            } else {
                echo $_GET[date_sel_all_end];
            }
?>"><font color="#FFFFFF">Facility</font></a><?
        } else {
?>Facility<?
        }
?></div></td>

                                  <td width="8%" bgcolor="#944542" style="border-right:1px solid #333333;"><div align="center" class="fontitle"><?
        if ($user_type != '0') {
?><a href="booking.php?page=all&select=<?
            if (isset($_POST[select])) {
                echo $_POST[select];
            } else {
                echo $_GET[select];
            }
?>&user_sel=<?
            if (isset($_POST[user_sel])) {
                echo $_POST[user_sel];
            } else {
                echo $_GET[user_sel];
            }
?>&menu2=<?
            if (isset($_POST[menu2])) {
                echo $_POST[menu2];
            } else {
                echo $_GET[menu2];
            }
?>&crypted=<?
            echo $_GET[crypted];
?>&sort=date&date_sel_all=<?
            if (isset($_POST[date_sel_all])) {
                echo $_POST[date_sel_all];
            } else {
                echo $_GET[date_sel_all];
            }
?>&date_sel_all_end=<?
            if (isset($_POST[date_sel_all_end])) {
                echo $_POST[date_sel_all_end];
            } else {
                echo $_GET[date_sel_all_end];
            }
?>"><font color="#FFFFFF">Date</font></a><?
        } else {
?>Date<?
        }
?></div></td>

                                  <td width="6%" bgcolor="#944542" style="border-right:1px solid #333333;"><div align="center" class="fontitle">From Time</div></td>

                                  <td width="6%" bgcolor="#944542" style="border-right:1px solid #333333;"><div align="center" class="fontitle">To Time </div></td>

                                  <?
        if ($user_type != '0') {
?>

                   			  	  <td width="7%" bgcolor="#944542" style="border-right:1px solid #333333;">

                           		  <div align="center" class="fontitle">Resident</div>                                        </td>

                                  <?
        }
?>

                                  <?
        if ($user_type != '0') {
?>

                   			  	  <td width="8%" bgcolor="#944542" style="border-right:1px solid #333333;"><div align="center" class="fontitle">By Who</div></td>

                                  <?
        }
?>

                                  <td width="18%" bgcolor="#944542" style="border-right:1px solid #333333;"><div align="center" class="fontitle">Restrictions On Cancellation </div></td>

                                  <td width="5%" bgcolor="#944542" style="border-right:1px solid #333333;"><div align="center" class="fontitle">Deposit Status</div></td> <?
        if ($user_type == '0') {
?>

                                  <td width="7%" bgcolor="#944542"><div align="center" class="fontitle">Remarks</div></td> <?
        }
?><?
        if ($user_type != '0') {
?>

								  <td width="12%" bgcolor="#944542">

                           		  <div align="center" class="fontitle">Mode</div></td>

								  <td width="9%" bgcolor="#944542" style="border-left:1px solid #333333;"><div align="center" class="fontitle">Receipt</div></td><?
        }
?>

                                </tr>

                                

                                <?php
        // print_r($_POST);
        //isset($_POST[user_sel]) ?  $user_sel = $_POST[user_sel] : $user_sel = $_GET[user_sel];
        //isset($_POST[menu2]) ?  $menu2 = $_POST[menu2] : $menu2 = $_GET[menu2];
        //isset($_POST[select]) ?  $select = $_POST[select] : $select = $_GET[select];
        if ($user_sel != '0') {
            $my_query .= "uid = '$user_sel' and ";
        }
        if ($menu2 != '0') {
            $my_query .= "unique_no  = '$menu2' and ";
        }
        if ($select == '7') {
            $my_query .= "";
        } elseif ($select == '2') {
            $my_query .= "(status   = '$select' or  status   = '5') and ";
        } else {
            $my_query .= "status   = '$select' and ";
        }
        $from_date       = explode('-', $date_sel_all);
        $from_day        = $from_date[0];
        $from_month      = $from_date[1];
        $from_year       = $from_date[2];
        $fromdatetocheck = $from_year . "-" . $from_month . "-" . $from_day;
        $to_date         = explode('-', $date_sel_all_end);
        $to_day          = $to_date[0];
        $to_month        = $to_date[1];
        $to_year         = $to_date[2];
        $todatetocheck   = $to_year . "-" . $to_month . "-" . $to_day;
        $sr              = 1;
        if (isset($_GET[sort]) && $_GET[sort] == 'facility') {
            $query = "select * from my_booking where $my_query `date_of_booking` >='$fromdatetocheck' and `date_of_booking`  <= '$todatetocheck' ORDER BY unique_no,date_of_booking DESC,from_time DESC";
        } else if (isset($_GET[sort]) && $_GET[sort] == 'date') {
            $query = "select * from my_booking where $my_query `date_of_booking` >='$fromdatetocheck' and `date_of_booking`  <= '$todatetocheck' ORDER BY date_of_booking ASC,from_time ASC,unique_no DESC";
        } else {
            $query = "select * from my_booking where $my_query `date_of_booking` >='$fromdatetocheck' and `date_of_booking`  <= '$todatetocheck' ORDER BY date_of_booking DESC,from_time DESC";
        }
        $result = mysql_query($query) or die(mysql_error());
        while ($row = mysql_fetch_array($result)) {
            $date_of_booking = $row[date_of_booking];
            $time_of_booking = $row[time_of_booking];
            $greybar_info    = $row[day] . "-" . $row[month] . "-" . $row[year];
            $order_status    = $row[status];
            $reason          = $row[cancle_reson];
            $unique_no       = $row[unique_no];
            $allowed_cancel  = $row[allowed_cancel];
            $uid             = $row[uid];
            $rid             = $row[rid];
            if ($rid == '') {
                $rid = "&nbsp;";
            }
            $amount_recived = $row[amount_recived];
            if ($display_legend != 1) {
                $color = '#fdf5e2';
            } else if ($row[peak] == '0') {
                $color = '#cbe8c6';
            } else if ($row[peak] == '1') {
                $color = '#ffdcd8';
            } else if ($row[peak] == '2') {
                $color = '#fdf5e2';
            }
            if ($amount_recived == '') {
                $amount_recived = "NO";
            }
            $query_facility  = "select * from facility where unique_no ='$row[unique_no]' limit 1";
            $result_facility = mysql_query($query_facility);
            while ($row_facility = mysql_fetch_array($result_facility)) {
                $name_fac     = $row_facility[name];
                $closed_at    = $row_facility[closed_at];
                $fac          = $row_facility[sno];
                $autoapproval = $row_facility[auto_apporve];
                $closed_at    = $row_facility[closed_at];
            }
            if ($fac != '12' && $fac != '14') {
                $text = "usage time";
            } else {
                $text = "playtime";
            }
            $query_user  = "select * from user_account where id ='$uid' limit 1";
            $result_user = mysql_query($query_user);
            while ($row_user = mysql_fetch_array($result_user)) {
                $username = $row_user[username];
            }
            $query_user  = "select * from user_account where id ='$rid' limit 1";
            $result_user = mysql_query($query_user);
            while ($row_user = mysql_fetch_array($result_user)) {
                $rid  = $row_user[username];
                $rid2 = $row_user[id];
            }
            $my_booking_no = $row[sno];
            $from_time     = explode(':', $row[from_time]);
            $from_time_hrs = $from_time[0];
            $from_time_min = $from_time[1];
            $today_date    = date("d-m-Y");
            $hour          = date("G");
            $min           = date("i");
            $jan           = mktime($from_time_hrs, $from_time_min, 0, $row[month], $row[day], $row[year]);
            $hrs           = ((($jan - $today) / 60) / 60);
            if ($closed_at >= $hrs and $row[status] == '0') {
                //	$order_status ='5';
            }
            $newfrom_time  = explode(":", $from_time_recorded);
            $from_timehour = $newfrom_time[0];
            $from_timemin  = $newfrom_time[1];
            if ($from_timemin < $min) {
                $from_timemin += 60;
                $from_timehour -= 1;
            }
            //$from_timehour;
            //$from_timemin;
            $newmin = $from_timemin - $min;
            if (strlen($newmin) == 1) {
                $newmin = str_pad($newmin, 2, "0", STR_PAD_LEFT);
            } else {
                $newmin = $newmin;
            }
            if (strlen($hour) == 1) {
                $hour = str_pad($hour, 2, "0", STR_PAD_LEFT);
            } else {
                $hour = $hour;
            }
            if (strlen($min) == 1) {
                $min = str_pad($min, 2, "0", STR_PAD_LEFT);
            } else {
                $min = $min;
            }
            $difference        = ($from_timehour - $hour) . ":" . $newmin . "<br>";
            $check_absent_time = $hour . ":" . $min;
            $closed_at_new     = $closed_at;
            $closed_at         = $closed_at . ":00";
            $from_time_new     = $from_timehour . ":" . $from_timemin;
            $d                 = date('d');
            $today             = time();
?>

                                  	<tr align="center" bgcolor="<?php
            echo $color;
?>">

                                    	<td style="border-right:1px solid #333333;border-top:1px solid #333333;"><?php
            echo $sr;
?></td>

                                    	<td style="border-right:1px solid #333333;border-top:1px solid #333333;"><?php
            echo $name_fac;
?></td>

                                    	<td style="border-right:1px solid #333333;border-top:1px solid #333333;"><?php
            echo "$row[date_of_booking]";
?></td>

                                        <td style="border-right:1px solid #333333;border-top:1px solid #333333;"><?php
            echo $row[from_time];
            $from_time_recorded = $row[from_time];
?></td>

                                    	<td style="border-right:1px solid #333333;border-top:1px solid #333333;"><?php
            if (strlen($row['to_time']) == 4) {
                echo $to_time_recorded = str_pad($row['to_time'], 5, "0", STR_PAD_LEFT);
            } else {
                echo $row[to_time];
                $to_time_recorded = $row[to_time];
            }
?></td>

                                        <?
            if ($user_type != '0') {
?>

                   			        	<td style="border-right:1px solid #333333;border-top:1px solid #333333;"><?php
                echo $username;
?></td><?
            }
?>

                                    	<?
            if ($user_type != '0') {
?>

                   			  	   		<td style="border-right:1px solid #333333;border-top:1px solid #333333;"><?php
                if ($user_type == '1' || $rid2 == $id) {
                    echo $rid;
                } else {
                    $sqlcheckbooker    = "SELECT * FROM user_account WHERE id = $rid2";
                    $resultcheckbooker = mysql_query($sqlcheckbooker);
                    $rowcheckbooker    = mysql_fetch_array($resultcheckbooker);
                    if ($rowcheckbooker['user_type'] == '2' && $user_type == '2') {
                        echo $rowcheckbooker['username'];
                    } else {
                        echo "&nbsp;";
                    }
                }
?></td>

                                        <?
            }
?>

                                    	<td style="border-right:1px solid #333333;border-top:1px solid #333333;"><?php
            echo "$closed_at_new hr(s) before $text";
?></td>

                                    	<td style="border-right:1px solid #333333;border-top:1px solid #333333;"><?php
            if ($autoapproval != 1 && $order_status == 1) {
?>PAID<?
            } else {
?><font color="#ffffff">&nbsp;</font><?
            }
?></td><?
            if ($user_type == '0') {
?>

                                    	<td style="border-top:1px solid #333333;">

										

										<?
                // check time now
                $checking_cancel = date("Y-m-dHi");
                if ($order_status == '0') {
                    echo "Pending<br>";
                    if ($allowed_cancel >= $checking_cancel) {
?>

											[ <a href="redirect.php?crypted=<?
                        echo $_GET[crypted];
?>&id=<?
                        echo $fac;
?>&page=<?
                        echo $_GET[page];
?>&user_id=<?
                        echo $uid;
?>&fac=<?
                        echo $fac;
?>&date_sel=<?
                        echo $date_of_can;
?>&booking_no=<?
                        echo $my_booking_no;
?>&type=cancle&date_sel_all=<?
                        echo $_POST[date_sel_all];
?>&date_sel_all_end=<?
                        echo $_POST[date_sel_all_end];
?>&menu2=<?
                        echo $_POST[menu2];
?>&user_sel=<?
                        echo $_POST[user_sel];
?>&select=<?
                        echo $_POST[select];
?>&reason=1" onclick="return validateprompt();">Cancel</a> ]

											<?
                    }
                } else if ($order_status == '1') {
                    echo "Approved<br>";
                    if ($allowed_cancel >= $checking_cancel) {
?>

											[ <a href="redirect.php?crypted=<?
                        echo $_GET[crypted];
?>&id=<?
                        echo $fac;
?>&page=<?
                        echo $_GET[page];
?>&user_id=<?
                        echo $uid;
?>&fac=<?
                        echo $fac;
?>&date_sel=<?
                        echo $date_of_can;
?>&booking_no=<?
                        echo $my_booking_no;
?>&type=cancle&date_sel_all=<?
                        echo $_POST[date_sel_all];
?>&date_sel_all_end=<?
                        echo $_POST[date_sel_all_end];
?>&menu2=<?
                        echo $_POST[menu2];
?>&user_sel=<?
                        echo $_POST[user_sel];
?>&select=<?
                        echo $_POST[select];
?>&reason=2" onclick="return validateprompt();">Cancel</a> ]

											<?
                    }
                } else if ($order_status == '2') {
                    echo "Cancelled";
                } else if ($order_status == '3') {
                    echo "Cancelled<br>(Rain)";
                } else if ($order_status == '4') {
                    echo "Cancelled<br>(Absent)";
                } else if ($order_status == '5') {
                    echo "Cancelled";
                }
?>

										

                                        </td>

                                    	<?
            }
?>

                                    		<?php
            if ($user_type != '0') {
                $in = 0;
                //echo $check_absent_time . " < " . $from_time_recorded . " && " . $today_date . " <= " . $date_of_booking; 
?>

                               		  <td style="border-top:1px solid #333333;">

									  

									  <?
                // check time now
                $checking_cancel = date("Y-m-dHi");
                if ($user_type == '1') {
                    if ($order_status == '0') {
                        echo "Pending<br>";
                        // if cancel within time limit
                        if ($allowed_cancel >= $checking_cancel) {
?>

                                                [ <a href='redirect.php?crypted=<?
                            echo $_GET[crypted];
?>&id=<?
                            echo $fac;
?>&page=<?
                            echo $_GET[page];
?>&user_id=<?
                            echo $uid;
?>&fac=<?
                            echo $fac;
?>&date_sel=<?
                            echo $date_of_can;
?>&booking_no=<?
                            echo $my_booking_no;
?>&type=approve&date_sel_all=<?
                            echo $_POST[date_sel_all];
?>&date_sel_all_end=<?
                            echo $_POST[date_sel_all_end];
?>&menu2=<?
                            echo $_POST[menu2];
?>&user_sel=<?
                            echo $_POST[user_sel];
?>&select=<?
                            echo $_POST[select];
?>'>Approve</a> ] [ <a href="redirect.php?crypted=<?
                            echo $_GET[crypted];
?>&id=<?
                            echo $fac;
?>&page=<?
                            echo $_GET[page];
?>&user_id=<?
                            echo $uid;
?>&fac=<?
                            echo $fac;
?>&date_sel=<?
                            echo $date_of_can;
?>&booking_no=<?
                            echo $my_booking_no;
?>&type=cancle&date_sel_all=<?
                            echo $_POST[date_sel_all];
?>&date_sel_all_end=<?
                            echo $_POST[date_sel_all_end];
?>&menu2=<?
                            echo $_POST[menu2];
?>&user_sel=<?
                            echo $_POST[user_sel];
?>&select=<?
                            echo $_POST[select];
?>&reason=7" onclick="return validateprompt();">Cancel</a> ]

                                                <?
                        }
                        // if still not paid but limit has reach
                        else {
?> 

                                                [ <a href="redirect.php?crypted=<?
                            echo $_GET[crypted];
?>&id=<?
                            echo $fac;
?>&page=<?
                            echo $_GET[page];
?>&user_id=<?
                            echo $uid;
?>&fac=<?
                            echo $fac;
?>&date_sel=<?
                            echo $date_of_can;
?>&booking_no=<?
                            echo $my_booking_no;
?>&type=approve&date_sel_all=<?
                            echo $_POST[date_sel_all];
?>&date_sel_all_end=<?
                            echo $_POST[date_sel_all_end];
?>&menu2=<?
                            echo $_POST[menu2];
?>&user_sel=<?
                            echo $_POST[user_sel];
?>&select=<?
                            echo $_POST[select];
?>">Approve</a> ] [ <a href="redirect.php?crypted=<?
                            echo $_GET[crypted];
?>&id=<?
                            echo $fac;
?>&page=<?
                            echo $_GET[page];
?>&user_id=<?
                            echo $uid;
?>&fac=<?
                            echo $fac;
?>&date_sel=<?
                            echo $date_of_can;
?>&booking_no=<?
                            echo $my_booking_no;
?>&type=cancle&date_sel_all=<?
                            echo $_POST[date_sel_all];
?>&date_sel_all_end=<?
                            echo $_POST[date_sel_all_end];
?>&menu2=<?
                            echo $_POST[menu2];
?>&user_sel=<?
                            echo $_POST[user_sel];
?>&select=<?
                            echo $_POST[select];
?>&reason=9" onclick="return validateprompt();">Cancel</a> ]

                                                  <?
                        }
                    } else if ($order_status == '1') {
                        echo "Approved<br>";
                        // can still cancel as long as limit not reach
                        if ($allowed_cancel >= $checking_cancel) {
?>

                                                [ <a href="redirect.php?crypted=<?
                            echo $_GET[crypted];
?>&id=<?
                            echo $fac;
?>&page=<?
                            echo $_GET[page];
?>&user_id=<?
                            echo $uid;
?>&fac=<?
                            echo $fac;
?>&date_sel=<?
                            echo $date_of_can;
?>&booking_no=<?
                            echo $my_booking_no;
?>&type=cancle&date_sel_all=<?
                            echo $_POST[date_sel_all];
?>&date_sel_all_end=<?
                            echo $_POST[date_sel_all_end];
?>&menu2=<?
                            echo $_POST[menu2];
?>&user_sel=<?
                            echo $_POST[user_sel];
?>&select=<?
                            echo $_POST[select];
?>&reason=8" onclick="return validateprompt();">Cancel</a> ]

                                                <?
                        }
                        // illegal if more than time limit, but need so that they can release the booking for other residents
                        else {
?>

                                                [ <a href="redirect.php?crypted=<?
                            echo $_GET[crypted];
?>&id=<?
                            echo $fac;
?>&page=<?
                            echo $_GET[page];
?>&user_id=<?
                            echo $uid;
?>&fac=<?
                            echo $fac;
?>&date_sel=<?
                            echo $date_of_can;
?>&booking_no=<?
                            echo $my_booking_no;
?>&type=cancle&date_sel_all=<?
                            echo $_POST[date_sel_all];
?>&date_sel_all_end=<?
                            echo $_POST[date_sel_all_end];
?>&menu2=<?
                            echo $_POST[menu2];
?>&user_sel=<?
                            echo $_POST[user_sel];
?>&select=<?
                            echo $_POST[select];
?>&reason=9" onclick="return validateprompt();">Cancel</a> ]

                                                <?
                        }
                        $compare_date = date("Y-m-d");
                        // check once approved, to show absent link
                        if ($date_of_booking == $compare_date) {
                            $breakfromtime = explode(":", $from_time_recorded);
                            $breaktotime   = $breakfromtime[0] . ":30";
                            $breaktime     = date("H:i");
                            //echo $from_time_recorded;
                            //echo $to_time_recorded;
                            if ($breaktime >= $from_time_recorded && $breaktime <= $to_time_recorded)
                            //if ($breaktime >= '02:56' && $breaktime <= '03:04')
                                {
?>

													[ <a href="redirect.php?crypted=<?
                                echo $_GET[crypted];
?>&id=<?
                                echo $fac;
?>&page=<?
                                echo $_GET[page];
?>&user_id=<?
                                echo $uid;
?>&fac=<?
                                echo $fac;
?>&date_sel=<?
                                echo $date_of_can;
?>&booking_no=<?
                                echo $my_booking_no;
?>&type=cancle&date_sel_all=<?
                                echo $_POST[date_sel_all];
?>&date_sel_all_end=<?
                                echo $_POST[date_sel_all_end];
?>&menu2=<?
                                echo $_POST[menu2];
?>&user_sel=<?
                                echo $_POST[user_sel];
?>&select=<?
                                echo $_POST[select];
?>&reason=11">Absent</a> ]

													<?
                            }
                            //check also for rain on same day if outdoor
                            $sqloutdoor    = "SELECT type FROM facility WHERE unique_no = '$unique_no'";
                            $resultoutdoor = mysql_query($sqloutdoor);
                            $outdoorrow    = mysql_fetch_array($resultoutdoor);
                            if ($outdoorrow['type'] == 1) {
                                $breakfromtime      = explode(":", $from_time_recorded);
                                $breakfromtimestart = $breakfromtime[0];
                                if ($breakfromtimestart[0] == 0) {
                                    $newbreakfromtime = "0" . ($breakfromtimestart[1] - 1) . ":30";
                                } else {
                                    $newbreakfromtime = ($breakfromtimestart - 1) . ":30";
                                }
                                $newbreaktotime = $breakfromtime . ":30";
                                $breaktime      = date("H:i");
                                if ($breaktime >= $from_time_recorded && $breaktime <= $to_time_recorded)
                                //if ($breaktime >= '02:56' && $breaktime <= '03:04')
                                    {
?>

														[ <a href="redirect.php?crypted=<?
                                    echo $_GET[crypted];
?>&id=<?
                                    echo $fac;
?>&page=<?
                                    echo $_GET[page];
?>&user_id=<?
                                    echo $uid;
?>&fac=<?
                                    echo $fac;
?>&date_sel=<?
                                    echo $date_of_can;
?>&booking_no=<?
                                    echo $my_booking_no;
?>&type=cancle&date_sel_all=<?
                                    echo $_POST[date_sel_all];
?>&date_sel_all_end=<?
                                    echo $_POST[date_sel_all_end];
?>&menu2=<?
                                    echo $_POST[menu2];
?>&user_sel=<?
                                    echo $_POST[user_sel];
?>&select=<?
                                    echo $_POST[select];
?>&reason=10">Rain</a> ]

														<?
                                }
                            }
                        }
                    } else if ($order_status == '2') {
                        echo "Cancelled";
                    } else if ($order_status == '3') {
                        echo "Cancelled<br>(Rain)";
                    } else if ($order_status == '4') {
                        echo "Cancelled<br>(Absent)";
                    } else if ($order_status == '5') {
                        echo "Cancelled";
                    } else if ($order_status == '6') {
                        echo "Booking Lapsed<br>Click the above '<strong><font color='#FF0000'>X</font></strong>' mark to cancel";
?><br>[<a href="redirect.php?crypted=<?
                        echo $_GET[crypted];
?>&id=<?
                        echo $fac;
?>&page=<?
                        echo $_GET[page];
?>&user_id=<?
                        echo $uid;
?>&fac=<?
                        echo $fac;
?>&date_sel=<?
                        echo $date_of_can;
?>&booking_no=<?
                        echo $my_booking_no;
?>&type=delete&date_sel_all=<?
                        echo $_POST[date_sel_all];
?>&date_sel_all_end=<?
                        echo $_POST[date_sel_all_end];
?>&menu2=<?
                        echo $_POST[menu2];
?>&user_sel=<?
                        echo $_POST[user_sel];
?>&select=<?
                        echo $_POST[select];
?>&reason=7" onclick="return validatepromptdelete();"><strong><font color="#FF0000">X</font></strong></a>]

												<?
                    }
                } else if ($user_type == '2') {
                    if ($order_status == '0') {
                        echo "Pending<br>";
                        if ($allowed_cancel >= $checking_cancel) {
?>

                                                [ <a href='redirect.php?crypted=<?
                            echo $_GET[crypted];
?>&id=<?
                            echo $fac;
?>&page=<?
                            echo $_GET[page];
?>&user_id=<?
                            echo $uid;
?>&fac=<?
                            echo $fac;
?>&date_sel=<?
                            echo $date_of_can;
?>&booking_no=<?
                            echo $my_booking_no;
?>&type=approve&date_sel_all=<?
                            echo $_POST[date_sel_all];
?>&date_sel_all_end=<?
                            echo $_POST[date_sel_all_end];
?>&menu2=<?
                            echo $_POST[menu2];
?>&user_sel=<?
                            echo $_POST[user_sel];
?>&select=<?
                            echo $_POST[select];
?>'>Approve</a> ] [ <a href="redirect.php?crypted=<?
                            echo $_GET[crypted];
?>&id=<?
                            echo $fac;
?>&page=<?
                            echo $_GET[page];
?>&user_id=<?
                            echo $uid;
?>&fac=<?
                            echo $fac;
?>&date_sel=<?
                            echo $date_of_can;
?>&booking_no=<?
                            echo $my_booking_no;
?>&type=cancle&date_sel_all=<?
                            echo $_POST[date_sel_all];
?>&date_sel_all_end=<?
                            echo $_POST[date_sel_all_end];
?>&menu2=<?
                            echo $_POST[menu2];
?>&user_sel=<?
                            echo $_POST[user_sel];
?>&select=<?
                            echo $_POST[select];
?>&reason=3" onclick="return validateprompt();">Cancel</a> ]

                                                <?
                        }
                        // if still not paid but limit has reach
                        else {
                            // can approve but cannot cancel if last minute
?> 

                                                [ <a href="redirect.php?crypted=<?
                            echo $_GET[crypted];
?>&id=<?
                            echo $fac;
?>&page=<?
                            echo $_GET[page];
?>&user_id=<?
                            echo $uid;
?>&fac=<?
                            echo $fac;
?>&date_sel=<?
                            echo $date_of_can;
?>&booking_no=<?
                            echo $my_booking_no;
?>&type=approve&date_sel_all=<?
                            echo $_POST[date_sel_all];
?>&date_sel_all_end=<?
                            echo $_POST[date_sel_all_end];
?>&menu2=<?
                            echo $_POST[menu2];
?>&user_sel=<?
                            echo $_POST[user_sel];
?>&select=<?
                            echo $_POST[select];
?>">Approve</a> ]

                                                  <?
                        }
                    } else if ($order_status == '1') {
                        echo "Approved<br>";
                        if ($allowed_cancel >= $checking_cancel) {
                            //echo $allowed_cancel;
                            //echo "<br>";
                            //echo $checking_cancel;
?>

                                                [ <a href="redirect.php?crypted=<?
                            echo $_GET[crypted];
?>&id=<?
                            echo $fac;
?>&page=<?
                            echo $_GET[page];
?>&user_id=<?
                            echo $uid;
?>&fac=<?
                            echo $fac;
?>&date_sel=<?
                            echo $date_of_can;
?>&booking_no=<?
                            echo $my_booking_no;
?>&type=cancle&date_sel_all=<?
                            echo $_POST[date_sel_all];
?>&date_sel_all_end=<?
                            echo $_POST[date_sel_all_end];
?>&menu2=<?
                            echo $_POST[menu2];
?>&user_sel=<?
                            echo $_POST[user_sel];
?>&select=<?
                            echo $_POST[select];
?>&reason=4" onclick="return validateprompt();">Cancel</a> ]

                                                <?
                        }
                        $compare_date = date("Y-m-d");
                        // check once approved, to show absent link
                        if ($date_of_booking == $compare_date) {
                            $breakfromtime = explode(":", $from_time_recorded);
                            $breaktotime   = $breakfromtime[0] . ":30";
                            //$breaktime = date("H:i");
                            $breaktime     = date("H:i");
                            //echo $from_time_recorded;
                            //echo $to_time_recorded;
                            if ($breaktime >= $from_time_recorded && $breaktime <= $to_time_recorded)
                            //if ($breaktime >= '02:56' && $breaktime <= '03:04')
                                {
?>

													[ <a href="redirect.php?crypted=<?
                                echo $_GET[crypted];
?>&id=<?
                                echo $fac;
?>&page=<?
                                echo $_GET[page];
?>&user_id=<?
                                echo $uid;
?>&fac=<?
                                echo $fac;
?>&date_sel=<?
                                echo $date_of_can;
?>&booking_no=<?
                                echo $my_booking_no;
?>&type=cancle&date_sel_all=<?
                                echo $_POST[date_sel_all];
?>&date_sel_all_end=<?
                                echo $_POST[date_sel_all_end];
?>&menu2=<?
                                echo $_POST[menu2];
?>&user_sel=<?
                                echo $_POST[user_sel];
?>&select=<?
                                echo $_POST[select];
?>&reason=6">Absent</a> ]

													<?
                            }
                            //check also for rain on same day if outdoor
                            $sqloutdoor    = "SELECT type FROM facility WHERE unique_no = '$unique_no'";
                            $resultoutdoor = mysql_query($sqloutdoor);
                            $outdoorrow    = mysql_fetch_array($resultoutdoor);
                            if ($outdoorrow['type'] == 1) {
                                $breakfromtime      = explode(":", $from_time_recorded);
                                $breakfromtimestart = $breakfromtime[0];
                                if ($breakfromtimestart[0] == 0) {
                                    $newbreakfromtime = "0" . ($breakfromtimestart[1] - 1) . ":30";
                                } else {
                                    $newbreakfromtime = ($breakfromtimestart - 1) . ":30";
                                }
                                $newbreaktotime = $breakfromtime . ":30";
                                $breaktime      = date("H:i");
                                if ($breaktime >= $from_time_recorded && $breaktime <= $to_time_recorded)
                                //if ($breaktime >= '02:56' && $breaktime <= '03:04')
                                    {
?>

														[ <a href="redirect.php?crypted=<?
                                    echo $_GET[crypted];
?>&id=<?
                                    echo $fac;
?>&page=<?
                                    echo $_GET[page];
?>&user_id=<?
                                    echo $uid;
?>&fac=<?
                                    echo $fac;
?>&date_sel=<?
                                    echo $date_of_can;
?>&booking_no=<?
                                    echo $my_booking_no;
?>&type=cancle&date_sel_all=<?
                                    echo $_POST[date_sel_all];
?>&date_sel_all_end=<?
                                    echo $_POST[date_sel_all_end];
?>&menu2=<?
                                    echo $_POST[menu2];
?>&user_sel=<?
                                    echo $_POST[user_sel];
?>&select=<?
                                    echo $_POST[select];
?>&reason=5">Rain</a> ]

														<?
                                }
                            }
                        }
                    } else if ($order_status == '2') {
                        echo "Cancelled";
                    } else if ($order_status == '3') {
                        echo "Cancelled<br>(Rain)";
                    } else if ($order_status == '4') {
                        echo "Cancelled<br>(Absent)";
                    } else if ($order_status == '5') {
                        echo "Cancelled";
                    } else if ($order_status == '6') {
                        echo "Cancelled<br>(Lapsed)";
                    }
                }
?>

										

									  

									  </td>

                                    		<td style="border-left:1px solid #333333;border-top:1px solid #333333;">

											<?php
                // if($order_status =='0' or $order_status =='1' and  $amount_recived =='')
                if ($order_status == '0' and $amount_recived == '') {
                    //echo "<img src=images/dollar_icon_gray.jpg>";
                } elseif ($order_status == '1' and $amount_recived == '')
                //}elseif($order_status =='1' and $amount_recived !='')
                    {
                    echo "<a href=javascript:openwindow('receipt.php?id=$my_booking_no')><strong>View</strong></a>";
                }
?>&nbsp; </td>

                                            	<?php
            }
?>

                           		  </tr>

                                  <?
            if ($user_type == '1') {
?>

                                        <tr bgcolor="#CCCCCC">

                                        	<td colspan="11" style="font-size: 11px;"><i>

											<?php
                if ($time_of_booking != '')
                    echo "<b>Date & Time of booking :</b>$greybar_info at $time_of_booking";
?>                                    		&nbsp;&nbsp; 

								  			<?php
                if ($row[cancle_booking_date_time] != '') {
                    echo "| <b> Cancellation Date & Time : </b>$row[cancle_booking_date_time]";
                }
                if ($row[cancelled_by] != '' && $row[cancelled_by] != '0') {
                    $queryuser = "select * from user_account where id = '$row[cancelled_by]' limit 1";
                    $resultuser = mysql_query($queryuser) or die(mysql_error());
                    //$count = mysql_num_rows($result);
                    $rowuser = mysql_fetch_array($resultuser);
                    echo " cancelled by $rowuser[username]";
                }
                if ($row[date_of_conf] != '') {
                    echo "| <b> Confirmation Date & Time : </b>$row[date_of_conf]";
                }
?>   </i>                                         </td>

                                  		</tr>

                                        <?
            }
?>

                                  		<?php
            $dont_sel         = "";
            $msg              = "";
            $registered_by_id = '';
            $registered_by    = '';
            $sr++;
            $greybar_info = '';
            $text         = '';
        }
?>

                                  </table>

                           		  <?php
    }
?>

                              </td>

                       		  </tr>

                   			  </table>

                          </td>

               		  </tr>

   			  </table>

                			<?php
}
?>

                			</p>

                  			<?php
if ($_GET[page] == 'group' and $user_type == '1') {
?>

                            <table width="75%" border="0" align="center">

                            <tr>

                            	<td>Group With </td>

                              	<td><strong>:</strong></td>

                              	<td><label>

                                <select name="select3">

                                      <option value="0" selected>---&gt;</option>

                                      <option value="1">&lt;---</option>

                                      <option value="2">&lt;---&gt;</option>

                        		</select>

                        		<select name="select2">

						  		<?php
    $query  = "select * from facility where enable ='1' ";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result)) {
        if ($_GET[fac] == $row[sno]) {
            $sel_fac = "selected = selected";
        } else {
            $sel_fac = "";
        }
        echo " <option value=fac=$row[sno] $sel_fac>$row[name]</option>";
    }
?>

                        	</select>

                      		</label>

                            </td>

                      		<td>&nbsp;</td>

                    	</tr>

                    	<tr>

                      		<td>Bond With </td>

                      		<td><strong>:</strong></td>

                      		<td>

                            <select name="select4">

                                <option value="0" selected>---&gt;</option>

                                <option value="1">&lt;---</option>

                                <option value="2">&lt;---&gt;</option>

                      		</select>

                        	<select name="select5">

						  	<?php
    $query  = "select * from facility where enable ='1' ";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result)) {
        if ($_GET[fac] == $row[sno]) {
            $sel_fac = "selected = selected";
        } else {
            $sel_fac = "";
        }
        echo " <option value=fac=$row[sno] $sel_fac>$row[name]</option>";
    }
?>

                        	</select>

                        	</td>

                      		<td>&nbsp;</td>

                    	</tr>

                    	<tr>

                      		<td width="15%">&nbsp;</td>

                      		<td width="1%">&nbsp;</td>

                      		<td width="73%">&nbsp;</td>

                      		<td width="11%">&nbsp;</td>

                    	</tr>

                  		</table>

                  		<?
}
?>

                		</p>

          </td>

		  </tr>

		  </table>

	</td>

					<td class="ctrrgt" vAlign="top" align="right" width="29">

					<img height="82" src="img/ctrrighttop.gif" width="29"></td>

</tr>

				<tr>

					<td background="img/leftbotbg.gif"><SPACER type="block" height="20">

					</td>

					<td vAlign="top" align="left" background="img/ctrbotctr.gif">

					<img height="20" src="img/ctrleftbot.gif" width="29"></td>

					<td class="ctrbot" vAlign="top">&nbsp;</td>

					<td vAlign="top" align="right" background="img/ctrbotctr.gif">

					<img height="20" src="img/ctrrgtbot.gif" width="29"></td>

				</tr>

</table>

<?
include("../footer.php");
?>
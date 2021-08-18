<?php
error_reporting(0);
$set =2; //1=localhost , 2 = server
if($set==1)
{
	
	$dbhost = 'localhost';
	$dbuser = 'axon';
	$dbpass = 'axondev';
	
	
	$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die  ('Error connecting to mysql');
	$dbname = 'axonsg_dev';
	@mysql_select_db("$dbname") or die( "Unable to select database");
}
else
{
			
	$dbhost = 'localhost';
	$dbuser = 'fonejove_v1v2';
	$dbpass = 'fonejove_v1v2';
	
//	$dbuser = 'axon_ardmorepark';
//	$dbpass = 'i4NuTCq8Ji';
	
	
	$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die  ('Error connecting to mysql');
	$dbname = 'fonejove_oldv1ard';
	@mysql_select_db("$dbname") or die( "Unable to select database");




} 

$scriptName = basename($_SERVER['SCRIPT_NAME']);
switch($scriptName){
	case 'login.php':
	break;

	case 'main.php':
	break;

	case 'index.php':
	break;
	
	default:
	if($_SESSION['basic_is_logged_in'] ==''){
//	header('Location:../login.php');
//	exit;
	}
}




?>
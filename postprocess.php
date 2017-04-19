<?php

session_start();

include('keys_salts.php');

$error='';


// create an array of the urlencoded variables, also construct the GET query string, and the concatenated invoice
$enc=array();
$querystrng='';
$concatenated='';
if ($_POST) {
foreach ($_POST as $key => $value) {
	$value = strip_tags($value);
	$enc[$key]=urlencode($value);
	$querystring.='&'.$key.'='.$value;
	$concatenated.=$value;}
}// end if ($_POST) 



if (!is_numeric($_POST['amount'])) {$error.='<p>Please enter a number for the amount.</p>';}
if (empty($_POST['addr'])) {$error.='<p>Please enter valid Dash address where you would like to receive your Dash.</p>';}

$salted=INVOICE_HASH_SALT.$concatenated;
$invoice_hash=hash('sha256',$salted);
$querystring='?inv_hash='.$invoice_hash.$querystring;


if (!$error) {$url='index.php'.$querystring;} else {$url='index.php';}


header("location: $url");


?>





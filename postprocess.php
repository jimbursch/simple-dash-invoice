<?php

session_start();


// ideally for security purposes this include should reside outside the web directory. IF you move it, this include needs to be updated with the new location.
include('keys_salts.php');

$error='';


// create an array of the urlencoded variables
// construct the GET query string
// concatenate the invoice data for the invoice hash
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


// error checking
if (!is_numeric($_POST['amount'])) {$error.='<p>Please enter a number for the amount.</p>';}
if (empty($_POST['addr'])) {$error.='<p>Please enter valid Dash address where you would like to receive your Dash.</p>';}


// salt the invoice data with your unique salt, hash it, and add it to the query string
$salted=INVOICE_HASH_SALT.$concatenated;
$invoice_hash=hash('sha256',$salted);
$querystring='?inv_hash='.$invoice_hash.$querystring;

// if there is no error, redirect to index with query string (this is the invoice) else redirect to index with error message in $_SESSION
if (!$error) {$url='index.php'.$querystring;} else {$url='index.php';$_SESSION['message']=$error;}


header("location: $url");


?>





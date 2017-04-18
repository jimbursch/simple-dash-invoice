<?php

session_start();

include('keys_salts.php');

$error='';

$issuer='';
$recipient='';
$description='';
$amount='';
$other='';
$addr='';


if (isset($_POST['issuer'])) {$issuer=urlencode($_POST['issuer']);}
if (isset($_POST['recipient'])) {$recipient=urlencode($_POST['recipient']);}
if (isset($_POST['description'])) {$product=urlencode($_POST['description']);}
if (isset($_POST['amount'])) {$amount=urlencode($_POST['amount']);}
if (isset($_POST['other'])) {$other=urlencode($_POST['other']);}
if (isset($_POST['addr'])) {$addr=urlencode($_POST['addr']);}

if (!is_numeric($amount)) {$error.='<p>Please enter a number for the amount.</p>';}

$salted=INVOICE_HASH_SALT.$issuer.$recipient.$description.$amount.$other.$addr;
$invoice_hash=hash('sha256',$salted);




$q='getreceivedbyaddress';
$path='http://chainz.cryptoid.info/dash/api.dws?key='.CRYPTOID_API_KEY.'&q='.$q.'&a='.$addr;


$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $path);
$result = curl_exec($ch);
curl_close($ch);
if ($result === false) {throw new Exception('Could not get reply: ' . curl_error($ch));}
$result = json_decode($result, true);

$invoice_url='index.php?inv_hash='.$invoice_hash.'&issuer='.$issuer.'&recipient='.$recipient.'&description='.$description.'&amount='.$amount.'&other='.$other.'&addr='.$addr;


header("location: $invoice_url");


?>





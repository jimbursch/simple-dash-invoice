<?php

session_start();

include('../inc/keys_salts.php');

$invoice_hash='';

// create an array of the urldecoded variables, concatenate the invoice data to check hash, check the hash
$concatenated='';
$dec=array();
if ($_GET) {
	foreach ($_GET as $key => $value) {
		$dec[$key]=urldecode($value);
		if ($key != 'inv_hash') {$concatenated.=$value;}
	}//end foreach
	
	if (isset($_GET['inv_hash'])) {
		$given_hash=$_GET['inv_hash'];
		$correct_hash=hash('sha256',INVOICE_HASH_SALT.$concatenated);
		if ($given_hash==$correct_hash) {$invoice_hash=$given_hash;}
	}//end if (isset($_GET['inv_hash'])) 	
	
}// end if ($_GET) 


echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN" "http://www.w3.org/TR/xhtm-basic/xhtml-basic11.dtd">';
echo '<html xmlns="http://www.w3.org/1999/xhtml">';
echo '<head>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
echo '<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />';
echo '<title>Simple Dash Invoice</title>';
echo '</head>';



echo '<h1 style="color: blue;">Simple Dash Invoice</h1>';

if (isset($_SESSION['message'])) {echo $_SESSION['message'];unset($_SESSION['message']);}


if ($invoice_hash) {

	if ($dec['issuer']) {echo '<br />From: '.$dec['issuer'];}
	if ($dec['recipient']) {echo '<br />To: '.$dec['recipient'];}
	if ($dec['description']) {echo '<br />For: '.$dec['description'];}
	if ($dec['amount']) {echo '<br />Amount: '.number_format($dec['amount'],3).' Dash';}
	if ($dec['other']) {echo '<br />Other: '.$dec['other'];}
	echo '<p>Please send your Dash payment to the address below:</p>';
	echo '<img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=dash:'.$dec['addr'].'" />';
	echo'<br />dash:'.$dec['addr'];

	echo '<hr>';

	echo '<h2>Payment status</h2>';

	$q='getreceivedbyaddress';
	$path='http://chainz.cryptoid.info/dash/api.dws?key='.CRYPTOID_API_KEY.'&q='.$q.'&a='.$dec['addr'];
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $path);
	$result = curl_exec($ch);
	curl_close($ch);
	if ($result === false) {throw new Exception('Could not get reply: ' . curl_error($ch));}
	$recd = json_decode($result, true);

	$status='';
	if ($dec['amount']) {
		if ($recd == $dec['amount']) {$status='Paid in full';}
		if ($recd > $dec['amount']) {$status='Paid in excess';}
		if ($recd > 0 && $recd < $dec['amount']) {$status='Partial payment received.';}
		if (!$recd) {$status='No payment received.';}
	}//end if ($dec['amount'])

	echo '<p>'.$status.'<br />'.number_format($recd,3).' Dash has been received.</p>';

	$url=$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	echo '<p><form method="post" action="'.$url.'"><button type="submit">Recheck status (refresh)</button></form></p>';

	echo '<p>Invoice ID: '.substr($invoice_hash,0,8).'</p>';

}// end if ($invoice_hash)

else {

	echo '<p>This is not a valid invoice.</p>';

}//end else



echo '<hr>';

echo '<a href="create_invoice.php">Create invoice</a> | <a href="https://github.com/jimbursch/simple-dash-invoice">GitHub</a> | <a href="https://fundchan.com/jimbursch">Contact</a> | <a href="https://jimbursch.com/simple-dash-invoice/index.php?inv_hash=5a0a0ed5f0bc9ede49a996f55a73714972b067be96be49b0e7b9b43a71ae2645&issuer=Jim%20Bursch&recipient=You!&description=Tip%20for%20creating%20the%20Simple%20Dash%20Invoice&other=&amount=0&addr=Xfh48kkftKnvwPRwPSponzUE2zcMzrHgWj">Tip</a>';


echo '</html>';

?>

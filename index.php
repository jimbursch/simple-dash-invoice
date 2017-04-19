<?php

session_start();

include('keys_salts.php');

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


echo '<!DOCTYPE html>';
echo '<html>';
echo '<head>';
echo '<title>Simple Dash Invoice</title>';
echo '</head>';



echo '<h1>Simple Dash Invoice</h1>';


if ($invoice_hash) {


if ($dec['issuer']) {echo '<br />From: '.$dec['issuer'];}
if ($dec['recipient']) {echo '<br />To: '.$dec['recipient'];}
if ($dec['description']) {echo '<br />For: '.$dec['description'];}
if ($dec['amount']) {echo '<br />Amount: '.number_format($dec['amount'],3).' Dash';}
if ($dec['other']) {echo '<br />Other: '.$dec['other'];}
echo '<p>Please send the requested amount of Dash to the address below:</p>';
echo '<img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data='.$dec['addr'].'" />';
echo'<br />'.$dec['addr'];

echo '<hr>';

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


}// end if ($invoice_hash)

else {

echo '<form method="post" action="postprocess.php">';
echo 'Issuer (merchant):<br />';
echo '<input type="text" name="issuer" value="" />';
echo '<br />Recipient (customer):<br />';
echo '<input type="text" name="recipient" value="" />';
echo '<br />Description (product):<br />';
echo '<input type="text" name="description" value="" />';
echo '<br />Other:<br />';
echo '<input type="text" name="other" value="" />';
echo '<br />Amount:<br />';
echo '<input type="text" name="amount" value="0" />';
echo '<br />Dash address*:<br />';
echo '<input type="text" name="addr" value="" />';
echo '<br /><button type="submit">Create invoice</button>';
echo '</form>';

echo '<p>* Your Dash receiving address is the only field that is required. We do not check the validity of the address entered, so be sure that it is correct.</p>';

}//end else



echo '<hr>';

echo '<a href="index.php">Create invoice</a> | <a href="https://github.com/jimbursch/simple-dash-invoice">GitHub</a> | <a href="https://fundchan.com/jimbursch">Contact</a> | <a href="http://jimbursch.com/simple-dash-invoice/index.php?inv_hash=5a0a0ed5f0bc9ede49a996f55a73714972b067be96be49b0e7b9b43a71ae2645&issuer=Jim%20Bursch&recipient=You!&description=Tip%20for%20creating%20the%20Simple%20Dash%20Invoice&other=&amount=0&addr=Xfh48kkftKnvwPRwPSponzUE2zcMzrHgWj">Tip</a>';


echo '</html>';

?>

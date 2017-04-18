<?php

session_start();

$issuer='';
$recipient='';
$description='';
$amount=0;
$other='';
$addr='';


if (isset($_GET['issuer'])) {$issuer=urldecode($_GET['issuer']);}
if (isset($_GET['recipient'])) {$recipient=urldecode($_GET['recipient']);}
if (isset($_GET['description'])) {$product=urldecode($_GET['description']);}
if (isset($_GET['amount'])) {$amount=urldecode($_GET['amount']);} else {$amount=0;}
if (isset($_GET['other'])) {$other=urldecode($_GET['other']);}
if (isset($_GET['addr'])) {$addr=urldecode($_GET['addr']);}



echo '<h1>Simple Dash Invoice</h1>';


if (isset($_GET['inv_hash'])) {

	if ($issuer) {echo '<br />From: '.$issuer;}
	if ($recipient) {echo '<br />To: '.$recipient;}
	if ($description) {echo '<br />For: '.$description;}
	if ($amount) {echo '<br />Amount: '.$amount.' Dash';}
	if ($other) {echo '<br />Other: '.$other;}
	echo '<p>Please send the requested amount of Dash to the address below:</p>';
	echo '<img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data='.$addr.'" />';
	echo'<br />'.$addr;


}

else {

//$addr='Xfh48kkftKnvwPRwPSponzUE2zcMzrHgWj';

echo '<form method="post" action="postprocess.php">';
echo 'Issuer (merchant):<br />';
echo '<input type="text" name="issuer" value="'.$issuer.'" />';
echo '<br />Recipient (customer):<br />';
echo '<input type="text" name="recipient" value="'.$recipient.'" />';
echo '<br />Description (product):<br />';
echo '<input type="text" name="description" value="'.$description.'" />';
echo '<br />Other:<br />';
echo '<input type="text" name="other" value="'.$other.'" />';
echo '<br />Amount:<br />';
echo '<input type="text" name="amount" value="'.$amount.'" />';
echo '<br />Dash address:<br />';
echo '<input type="text" name="addr" value="'.$addr.'" />';
echo '<br /><button type="submit">Create invoice</button>';
echo '</form>';
}


https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=Example


?>

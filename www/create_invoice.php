<?php

session_start();

echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN" "http://www.w3.org/TR/xhtm-basic/xhtml-basic11.dtd">';
echo '<html xmlns="http://www.w3.org/1999/xhtml">';
echo '<head>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
echo '<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />';
echo '<title>Simple Dash Invoice</title>';
echo '</head>';



echo '<h1>Simple Dash Invoice</h1>';

if (isset($_SESSION['message'])) {echo $_SESSION['message'];unset($_SESSION['message']);}






echo '<form method="post" action="postprocess.php">';
echo 'Issuer (merchant):<br />';
echo '<input type="text" name="issuer" value="" />';
echo '<br />Recipient (customer):<br />';
echo '<input type="text" name="recipient" value="" />';
echo '<br />Description (product):<br />';
echo '<input type="text" name="description" value="" />';
echo '<br />Other:<br />';
echo '<input type="text" name="other" value="" />';
echo '<br />Amount(Dash):<br />';
echo '<input type="text" name="amount" value="0" />';
echo '<br />Dash address*:<br />';
echo '<input type="text" name="addr" value="" />';
echo '<br /><button type="submit">Create invoice</button>';
echo '</form>';

echo '<p>* Your Dash receiving address is the only field that is required. We do not check the validity of the address entered, so be sure that it is correct.</p>';




echo '<hr>';

echo '<a href="index.php">Create invoice</a> | <a href="https://github.com/jimbursch/simple-dash-invoice">GitHub</a> | <a href="https://fundchan.com/jimbursch">Contact</a> | <a href="https://jimbursch.com/simple-dash-invoice/index.php?inv_hash=5a0a0ed5f0bc9ede49a996f55a73714972b067be96be49b0e7b9b43a71ae2645&issuer=Jim%20Bursch&recipient=You!&description=Tip%20for%20creating%20the%20Simple%20Dash%20Invoice&other=&amount=0&addr=Xfh48kkftKnvwPRwPSponzUE2zcMzrHgWj">Tip</a>';


echo '</html>';

?>






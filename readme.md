this is another test.

# Simple Dash Invoice

Working prototype: https://jimbursch.com/simple-dash-invoice/

This is a very simple invoicing application for the Dash cryptocurrency written in PHP. It is simple because:

- it currently is only 3 files to upload and only 1 file needs to be modified to get it working.
- no database is required.
- it does not use javascript.
- all variables are passed to the invoice in the url.
- to check the status of the invoice, just reload the page.

## DISCLAIMER

This is a SIMPLE invoicing app, which means that it should NOT be considered secure and it could be manipulated and spoofed. Out of the box, this application should only be used for small amounts between known users. DO NOT use this for large amounts or users who you do not know. 

Currently the index.php file functions to both, create an invoice and view an invoice. In the next version, these functions will be separated so that the create-invoice function can be better secured behind some sort of login.

## Dependencies

This app is dependent on the CryptoID blockchain explorer API (https://chainz.cryptoid.info/api.dws) to check the status of invoices.

The QR code is generated by http://goqr.me/api/

There is currently nothing in the code that checks the availability of these services.

## Best practices

- When generating an invoice, us a Dash address that has never been used before.
- The invoice ID is the first 8 characters of the invoice hash. Whenever you generate an invoice, record the invoice ID so that you can check the authenticity of the invoice at a later date.


## Credits

This project was inspired by, but not forked:

ultra-simple-Bitcoin-merchant
https://github.com/zooitje/ultra-simple-Bitcoin-merchant

Bitcoin Lazy API
https://github.com/zooitje/ultra-simple-Bitcoin-merchant

Dash Forum
https://www.dash.org/forum/threads/ultra-simple-dash-merchant-php.14307/




 

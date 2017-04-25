# Simple Dash Invoice

Working prototype: https://simple-dash-invoice.jimbursch.com

This is a very simple invoicing application for the Dash cryptocurrency written in PHP. It is simple because:

- no database is required.
- it does not use javascript.
- all variables are passed to the invoice in the url.
- to check the status of the invoice, just reload the page.

## DISCLAIMER

This is a SIMPLE invoicing app, which means that it should NOT be considered secure and it could be manipulated and spoofed. Out of the box, this application should only be used for small amounts between known users. DO NOT use this for large amounts or users who you do not know. 

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




 

To create a very simple Dash invoice:

- mannually enter a Dash address that has never received funds
- optionally enter:
-- issuer(merchant) name
-- customer name/id
-- invoice id (from issuer's accounting system)
-- product name/id
-- amount

When submitted, a url is generated that passes all variables to invoice page (get), including a hash of the invoice to check authenticity.

When a customer views the invoice, the invoice hash is checked for authenticity and the Dash address is queried for received funds. The Dash address is displayed with a QR code and instructions for payment, along with the optional invoice data.

If the Dash address has received funds equal to or greater than the amount of the invoice, the invoice is marked paid.

To check the status of payment, simply reload the invoice page.

live prototype:

https://jimbursch.com/simple-dash-invoice/
 

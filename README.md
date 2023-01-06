# Auto Document Number

This module is meant to provide a way to use an auto-generated invoice number
for newly created invoices and bills via the Akaunting API. 


## Install
To install this module run
```bash
php artisan module:install auto-document-number 1
php artisan cache:clear
```
where `1` is the company you install the module for.

## Usage
Now, whenever you assign a ***negative*** value to the request parameter `document_number`
it will get replaced by the next number in line. The module will respect the settings
for prefix and digits (padding), thus allowing you to keep a consistent range of numbers
throughout all your invoices and bills.

Example:

```php
$client = new \GuzzleHttp\Client();
$res = $client->request('POST', $this->baseUrl.'/documents', [
    'auth' => [$this->username, $this->password],
    'form_params' => [
        'company_id' => '1',
        'document_number' => '-1',
        'type' => 'invoice',
        'search' => 'type:invoice',
        'category_id' => 0,
        'order_number' => $invoice->getOrderNumber(),
        'status' => $invoice->getStatus(),
        'issued_at' => $invoice->getIssueDate()->format('c'),
        'due_at' => $invoice->getDueDate()->format('c'),
        'currency_code' => $invoice->getCurrencyCode(),
        'currency_rate' => 1,
        'contact_id' => $customer->getId(),
        'contact_name' => $invoice->getRecipient()->getFirstName() . ' ' . $invoice->getRecipient()->getLastName(),
        'contact_email' => $invoice->getRecipient()->getEmail(),
        'contact_address' => $invoice->getRecipient()->getAddress(),
        'contact_zip_code' => $invoice->getRecipient()->getZip(),
        'contact_city' => $invoice->getRecipient()->getCity(),
        'contact_country' => $invoice->getRecipient()->getCountry(),
        'amount' => 0,
        'items' => [
            0 => [
                'name' => 'test item',
                'quantity' => '2',
                'price' => '39.95', //price per item, excluding tax
                'description' => 'this is a test item for demo purposes',
                'tax_ids' => [
                    0 => '1',
                ]
            ]
        ],
    ],
]);
```

## Uninstall
To uninstall, use
```bash
php artisan module:uninstall auto-document-number 1
php artisan cache:clear
```

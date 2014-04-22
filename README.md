Yii PHP component for Customer.io
==============

Setup
----------------------------
Add to your config file
```php
'components'=>array(

  'customerio' => array(
    'class' => 'CustomerIO',
    'siteId' => '<SITE ID>',
    'apiKey' => '<API KEY>',
  ),
  
  ...
```

Usage
----------------------------
```php
// Creating a customer
Yii::app()->customerio->createCustomer(
  Yii::app()->user->id,
  [
    'first_name' => 'Bruce',
    'last_name' => 'Wayne',
    'email' => 'bruce-wayne@gotham.com',
    'country' => 'Venezuela',
    // add as many fields as you want
  ]
);

// Tracking an event
Yii::app()->customerio->trackEvent(Yii::app()->user->id, 'createdNewProject');

// Tracking an event with extra fields
Yii::app()->customerio->trackEvent(
  Yii::app()->user->id, 
  'purchased',
  [
    'amount' => 1499.9,
    'product' => 'MacBook Pro'
  ]
);
```


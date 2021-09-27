# Core Helper
<p>
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<!-- <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a> -->
<!-- <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a> -->
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

This package provides some common helper functions that we need regularly for almost every project.

**Useful helper functions will be added from time to time**

## Installation

Require this package with composer.

```shell
composer require corealg/helper
```

## Branding
Set the custom alias under the aliases section in your config/app.php

Replace `MyHelper` with your own branding
```php
'MyHelper' => CoreAlg\Helper\Helper::class,
```

## Usage

**Get pagination summary**
```php
<?php
echo MyHelper::paginationSummary(100, 10, 1);
// Output: Showing 1 to 10 of 100 records
```

**Convert number to word**
```php
<?php
echo MyHelper::number2word(100);
// Output: One Hundred Taka Only.
```

**Format amount**
```php
<?php
echo MyHelper::formatAmount(10000, 2, '.', ',');
// Output: 10,000.00
```

**The power to control your app's amount format**
```php
<?php
// set amount_format into session variable under `core_helper` key (you can do this once after login)
session()->put('core_helper', [
    'amount_format' => [ // you can set this value from database as well
        'decimals' => 3,
        'decimal_separator' => '.',
        'thousands_separator' => ','
    ]
]);
$order = \App\Models\Order::find(1);
echo MyHelper::formatAmount($order->amount);
// Output: 10,000.000
```

**Format date**
```php
<?php
echo MyHelper::formatDate("2021-09-27", "d M, Y");
// Output: 27 Sep, 2021
```

**The power to control your app's date format**
```php
<?php
// set data_format into session variable under `core_helper` key (you can do this once after login)
session()->put('core_helper', [
    'date_format' => 'd M, Y @ h:i:s A (P)' // you can set this value from database as well
]);
$user = \App\Models\User::find(1);
echo MyHelper::formatDate($user->created_at);
// Output: 27 Sep, 2021 @ 03:25:10 PM (+06:00)
```


## Testing
```
composer test
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## Authors
- [Mizanur Rahman (mizan3008@gmail.com)](https://github.com/mizan3008)

## License
[MIT License](https://choosealicense.com/licenses/mit/)

Copyright (c) 2021 CoreAlg
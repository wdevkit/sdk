# A sdk to wdevkit services

[![Latest Version on Packagist](https://img.shields.io/packagist/v/wdevkit/sdk.svg?style=flat-square)](https://packagist.org/packages/wdevkit/sdk)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/wdevkit/sdk/Tests/master?label=tests&style=flat-square)](https://github.com/wdevkit/sdk/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/wdevkit/sdk.svg?style=flat-square)](https://packagist.org/packages/wdevkit/sdk)

A sdk that simplifies the usage of many wdevkit services, with a tested, clean and easy to use api.

## Installation

You can install the package via composer:

```bash
composer require wdevkit/sdk
```

## Usage

The `wdevkit/sdk` provides api to multiple _wdevkit_ services. The services are provided by the `\Wdevkit\Sdk\Api` class, by calling the respective service name as a static method, as you can see below:

```php
$accounts = \Wdevkit\Sdk\Api::accounts($settings);
$payments = \Wdevkit\Sdk\Api::payments($settings);
$checkout = \Wdevkit\Sdk\Api::checkout($settings);
$orders = \Wdevkit\Sdk\Api::orders($settings);
$inventory = \Wdevkit\Sdk\Api::inventory($settings);
```

By calling the static method, a new instance of the service handler will be instantiated, with the given `$settings` array. In this settings, you must a `base_uri` and a `token`, on order to correctly make the requests to each service. You also can pass a `client` instance to the service. If not provided, a default client using [Guzzle](https://github.com/guzzle/guzzle) will be used, with the given request headers:

```php
'headers' => [
    'User-Agent' => 'wdevkit/sdk:1.x',
    'Accept'     => 'application/json',
    'Content-Type' => 'application/json',
    'Authorization' => 'Bearer ' . <token>,
]
```

Each service handler instantiated may have its own methods, wich will be described in the respective service documentation.

### Checkout

##### Create a Checkout

In order to create a checkout, you can use the `\Wdevkit\Sdk\Api::checkout($settings)->create([])` method from the sdk, and you need to provide the required data.

``` php
$settings = [
    'base_uri' => 'https://checkout.your_domain.dev',
    'token' => 'some_token'
];

$checkout = \Wdevkit\Sdk\Api::checkout($settings)->create([
    'items' => [
        [
            'name' => 'Black shirt #1', // required
            'sku' => 'black_shirt_1', // required
            'qty' => 2, // required
            'price' => 15.10, // required
        ],
    ]
]);

// response

'data' => [
    'uuid' => '2dcdf759-1ba1-4d25-aca9-9c0c11224cfd',
    'actions' => [
        'get' => 'https://checkout.your_domain.dev/checkouts/2dcdf759-1ba1-4d25-aca9-9c0c11224cfd/profiles',
    ]
]
```

### Payments

##### Fetch Methods

To fetch payment methods options, you can use the `\Wdevkit\Sdk\Api::payments($settings)->fetchMethods([])` method from the sdk.

```php
$settings = [
    'base_uri' => 'https://payments.your_domain.dev',
    'token' => 'some_token'
];

$methods = \Wdevkit\Sdk\Api::payments($settings)->fetchMethods([]);

// response

'data' => [
    'methods' => [
        ['code' => 'credit_card', 'title' => 'Credit Card', 'driver' => 'stripe'],
        ['code' => 'transfer', 'title' => 'Transfer', 'driver' => 'bank_acme'],
    ]
]
```

##### Create a Payment

To create a payment, you can use the `\Wdevkit\Sdk\Api::payments($settings)->create([])` method from the sdk, and you need to provide the required data.

```php
$settings = [
    'base_uri' => 'https://payments.your_domain.dev',
    'token' => 'some_token'
];

$methods = \Wdevkit\Sdk\Api::payments($settings)->create([
    'customer' => [
        'name' => 'John Doe', // required
        'document' => '12345678909', // required
        'email' => 'john@test.dev', // required
    ],
    'payment' => [
        'method' => 'credit_card', // required
        'amount' => 125.35, // required,
        'installments' => 1, // required
        'method_data' => [], // required, and attributes required depending on method.
    ],
]);

// response

'data' => [
    'payment_uuid' => 'fb624d85-5a13-47c7-8ea7-b917490d5e12',
    'payment_method' => 'credit_card',
    'amount' => '42',
    'state' => 'processed',
    'status' => 'success',
    'errors' => null,
    'actions' => [
        ['title' => 'Refund', 'code' => 'refund', 'url' => 'https://refund_route'],
        ['title' => 'Details', 'code' => 'details', 'url' => 'https://details_route'],
    ],
]
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Gilmar Pereira](https://github.com/wdarking)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

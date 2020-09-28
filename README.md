
# A sdk to wdevkit services

A sdk that simplifies the usage of many wdevkit services, with a tested, clean and easy to use api.

## Installation

You can install the package via composer:

```bash
composer require wdevkit/sdk
```

## Usage

The `wdevkit/sdk` provides api to multiple _wdevkit_ services. The services are provided by the `\Wdevkit\Sdk\Api` class, by calling the respective service name as a static method, as you can see below:

```php
$account = \Wdevkit\Sdk\Api::accounts($settings);
$payment = \Wdevkit\Sdk\Api::payments($settings);
$checkout = \Wdevkit\Sdk\Api::checkouts($settings);
$order = \Wdevkit\Sdk\Api::orders($settings);
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
In order to create a checkout, you can use the `\Wdevkit\Sdk\Api::checkout($settings)->create([])` method from the sdk, and you need to provide an array of items with the required attributes `name`, `sku`, `qty` and `price`.

``` php
$settings = [
    'base_uri' => 'https://checkout.your_domain.dev',
    'token' => 'some_token'
];

$checkout = \Wdevkit\Sdk\Api::checkout($settings)->create([
    'items' => [
        ['name' => 'Black shirt #1', 'sku' => 'black_shirt_1', 'qty' => 2, 'price' => 15.10],
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

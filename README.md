# Infused for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ryanlholt/infused.svg?style=flat-square)](https://packagist.org/packages/ryanlholt/infused)
[![Build Status](https://github.styleci.io/repos/7548986/shield)](https://github.styleci.io/repos/7548986)
[![Build Status](https://img.shields.io/travis/ryanlholt/infused/master.svg?style=flat-square)](https://travis-ci.org/ryanlholt/infused)
[![Total Downloads](https://img.shields.io/packagist/dt/ryanlholt/infused.svg?style=flat-square)](https://packagist.org/packages/ryanlholt/infused)

The goal of this package is to simplify working with the Infusionsoft API from within Laravel. This package adheres to the PSR12 standards.
## Installation

You can install the package via composer:

```bash
composer require ryanlholt/infused
```

## Usage
First, have your users navigate to the infusionsoft settings page located at YOUR_APP_URL/infusionsoft/settings. After that, you can use the User's token from the `infusionsoft_tokens` table to make API calls.
``` php
$contacts = app('infused')->infusionsoft()->contacts();
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email ryanlholt.88@gmail.com instead of using the issue tracker.

## Credits

- [Ryan Holt](https://github.com/ryanlholt)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

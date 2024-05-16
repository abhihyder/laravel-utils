# Laravel Utils

Utilities for Laravel applications, including various helpful features such as zip file creation, enum handling, and more.

## Installation

You can install the package via Composer:

```bash
composer require hyder/laravel-utils
```

## Configuration

After installing the package, you can publish the configuration file using Artisan:

```bash
php artisan vendor:publish --tag=laravel-utils-config
```

This will publish the configuration file `laravel-utils.php` to your `config` directory.

### Configuration Options

The configuration file allows you to customize the behavior of the package:

```php
// config/laravel-utils.php

return [
    'enums' => [
        // Directory path where enum classes are located
        'dir_path' => app_path('Enums'),

        // Namespace for enum classes
        'namespace' => 'App\Enums',
    ],
];
```

You can adjust the `dir_path` and `namespace` values to match your application's structure.

## Usage

### Enum Facade

The `Enum` facade allows you to work with enums in your Laravel application.

#### Listing Enums

You can list all available enums using the `list` method:

```php
$enums = Enum::list();
```

This will return an array containing the constants of all enums.

#### Setting Directory and Namespace

You can set the directory and namespace for enums using the `setDirectory` and `setNamespace` methods, respectively before calling `list` method.

```php
use Hyder\LaravelUtils\Facades\Enum;

Enum::setDirectory('path/to/enums')
->setNamespace('App\Enums')
->list();
```

## License

Laravel Utils is open-source software licensed under the [MIT license](LICENSE).

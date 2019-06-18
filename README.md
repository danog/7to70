# Convert PHP 7 code to PHP 7.0 code

[![Latest Version on Packagist](https://img.shields.io/packagist/v/danog/7to70.svg?style=flat-square)](https://packagist.org/packages/danog/7to70)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/danog/7to70/master.svg?style=flat-square)](https://travis-ci.org/danog/7to70)
[![Quality Score](https://img.shields.io/scrutinizer/g/danog/7to70.svg?style=flat-square)](https://scrutinizer-ci.com/g/danog/7to70)
[![Total Downloads](https://img.shields.io/packagist/dt/danog/7to70.svg?style=flat-square)](https://packagist.org/packages/danog/7to70)

This package can convert PHP 7 code to PHP 7.0. This can be handy when you are running PHP 7 in development, but
PHP 5 in production.

You can convert an entire directory with PHP 7 code with a the console command:

```bash
php7to70 convert {$directoryWithPHP7Code} {$destinationWithphp70Code}
```

Here's an example of what it can do. It'll convert this code with PHP 7 features:
```php
class Test
{
    public function test(?string $input): ?string
    {
        try {

        } catch (Exception1|Exception2 $e) {
            echo $e;
        }
    }
    public function a(): string
    {
        
    }
}

```

to this equivalent PHP 7.0 code:

```php 
class Test
{
    public function test(string $input = null)
    {
        try {

        } catch (Exception1 $e) {
            echo $e;
        } catch (Exception2 $e) {
            echo $e;
        }
    }
    public function a(): string
    {
        
    }
}

```

## Installation

If you plan on use [the console command](#using-the-console-command) we recommend installing the package globally:

``` bash
$ composer global require danog/7to70
```

If you want to [integrate the package in your own code](#programmatically-convert-files) require the package like usual:

``` bash
$ composer require danog/7to70
```

## The conversion process

This package converts PHP 7 code to equivalent PHP 5 code by:

- removing nullable parameter type hints
- removing nullable return type hints
- substituting multiple catches

Because there are a lot of things that cannot be detected and/or converted properly we do not guarantee that the converted code will work. We highly recommend running your automated tests against the converted code to determine if it works.

## Using the console command

This package provides a console command `php7to70` to convert files and directories.

This is how a entire directory can be converted:

```bash
$ php7to70 convert {$directoryWithPHP7Code} {$destinationWithphp70Code}
```

Want to convert a single file? That's cool too! You can use the same command.

```bash
$ php7to70 convert {$sourceFileWithPHP7Code} {$destinationFileWithPHP70Code}
```

By default the command will only copy over `php`-files. Want to copy over all files? Use the `copy-all` option:
 
```bash
$ php7to70 convert {$directoryWithPHP7Code} {$destinationWithphp70Code} --copy-all
```

By default the command will only convert files with a php extension, but you can customize that by using the `--extension` option.

```bash
$ php7to70 convert {$directoryWithPHP7Code} {$destinationWithphp70Code} --extension=php --extension=phtml
```

If necessary, you can exclude directories / files.

```bash
$ php7to70 convert {$directoryWithPHP7Code} {$destinationWithphp70Code} --exсlude=cache
```

## Programmatically convert files

You can convert a single file by running this code:

```php
$converter = new Converter($pathToPhp7Code);

$converter->saveAsphp70($pathToWherephp70CodeShouldBeSaved);
```

An entire directory can be converted as well:

```php 
$converter = new DirectoryConverter($sourceDirectory);

$converter->savephp70FilesTo($destinationDirectory);
```

By default this will recursively copy all to files to the destination directory, even the non php files.

If you only want to copy over the php files do this:

```php 
$converter = new DirectoryConverter($sourceDirectory);

$converter
   ->doNotCopyNonPhpFiles()
   ->savephp70FilesTo($destinationDirectory);
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

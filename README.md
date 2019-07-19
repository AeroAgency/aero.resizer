aeroidea.resizer
=========

Image resizing module for 1C-Bitrix.

It is possible to cache and force the creation of a resize.

Implemented receivers based on:
* GD library
* ImageMagick library
* Go Lang

## Installation

Library can be installed into application using `Composer` dependency manager.

`composer require aeroidea/aero.resizer dev-master`

Manual
1. Download the archive with the module
2. unpack to `www/local/modules`

## Usage

```php    
$arImgResize = \Aero\Resizer\Resizer::getInstance()
    ->setResizer(\Aero\Resizer\ImagickResizer::class)
    ->setInput('/img.jpg')
    ->setOutput('/img_100_50.jpg')
    ->setWidth(100)
    ->setHeight(50)
    ->setQuality(90)
    ->setForce(true)
    ->setResizeType(\Aero\Resizer\Resizer::RESIZE_PROPORTIONAL)
    ->run()
    ->getResult();
```


## Usage of ImagickResizer:
To use this resizing tool, the ImageMagick library must be installed on the server side
Example of installing ImageMagick 6 in CentOS:
* __Download latest remi-release rpm__: wget http://rpms.remirepo.net/enterprise/7/remi/x86_64/remi-release-7.6-1.el7.remi.noarch.rpm
* __Install remi-release rpm__: rpm -Uvh remi-release*rpm
* __Install ImageMagick6 rpm package__: yum --enablerepo=remi install ImageMagick6 ImageMagick6-devel
* __Install pecl package__: sudo pecl install imagick
* __Add extension to php__: echo "extension=imagick.so" > /etc/php.d/imagick.ini
* __Restart php__: sudo systemctl restart php-fpm


## Usage of GoResizer:
* __Add permissions to bin file__: sudo chmod +x resizer/src/bin/resizer


## Docs

* Aeroidea\Resizer
    * [ImagickResizer](docs/Aeroidea-Resizer-ImagickResizer.md)
    * [NullResizer](docs/Aeroidea-Resizer-NullResizer.md)
    * [GoResizer](docs/Aeroidea-Resizer-GoResizer.md)
    * [BaseResizer](docs/Aeroidea-Resizer-BaseResizer.md)
    * [BitrixResizer](docs/Aeroidea-Resizer-BitrixResizer.md)
    * Aeroidea\Resizer\Exception
        * [ResizerException](docs/Aeroidea-Resizer-Exception-ResizerException.md)
    * [ResizerInterface](docs/Aeroidea-Resizer-ResizerInterface.md)
    * [Resizer](docs/Aeroidea-Resizer-Resizer.md)


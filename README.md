# Документация библиотеки Resizer

## Пример использования:

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

## Подключение ImagickResizer:
#### Для использования данного ресайзера на стороне сервера должна быть установлена библиотека ImageMagick
##### Пример подключения ImageMagick6:
* __Download latest remi-release rpm__: wget http://rpms.remirepo.net/enterprise/7/remi/x86_64/remi-release-7.6-1.el7.remi.noarch.rpm
* __Install remi-release rpm__: rpm -Uvh remi-release*rpm
* __Install ImageMagick6 rpm package__: yum --enablerepo=remi install ImageMagick6 ImageMagick6-devel
* __Install pecl package__: sudo pecl install imagick
* __Add extension to php__: echo "extension=imagick.so" > /etc/php.d/imagick.ini
* __Restart php__: sudo systemctl restart php-fpm

## Подключение GoResizer:
* __Add permissions to bin file__: sudo chmod +x resizer/src/bin/resizer
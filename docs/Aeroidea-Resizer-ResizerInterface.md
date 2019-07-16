Aeroidea\Resizer\ResizerInterface
===============

Interface ResizerInterface




* Interface name: ResizerInterface
* Namespace: Aeroidea\Resizer
* This is an **interface**






Methods
-------


### resizeImg

    string Aeroidea\Resizer\ResizerInterface::resizeImg(string $input, integer $width, integer $height, string $output, integer $quality, string $output_format, boolean $force)

Точный ресайз изображения



* Visibility: **public**


#### Arguments
* $input **string** - Путь к исходному изображению
* $width **integer** - Ширина итогового изображения
* $height **integer** - Высота итогового изображения
* $output **string** - Путь к итоговому изображению
* $quality **integer** - Качество изображения в пределах 1-100
* $output_format **string** - Формат выходного файла
* $force **boolean** - Обязательное пересоздание файла



### resizeImgProportional

    string Aeroidea\Resizer\ResizerInterface::resizeImgProportional(string $input, integer $width, integer $height, string $output, integer $quality, string $output_format, boolean $force)

Пропорциональный ресайз изображения



* Visibility: **public**


#### Arguments
* $input **string** - Путь к исходному изображению
* $width **integer** - Ширина итогового изображения
* $height **integer** - Высота итогового изображения
* $output **string** - Путь к итоговому изображению
* $quality **integer** - Качество изображения в пределах 1-100
* $output_format **string** - Формат выходного файла
* $force **boolean** - Обязательное пересоздание файла



### checkResizer

    boolean Aeroidea\Resizer\ResizerInterface::checkResizer()

Проверка доступности ресайзера



* Visibility: **public**




### needPrepareOutput

    boolean Aeroidea\Resizer\ResizerInterface::needPrepareOutput()

Подготавливать путь к выходному файлу



* Visibility: **public**




### needPrepareInput

    boolean Aeroidea\Resizer\ResizerInterface::needPrepareInput()

Подготавливать исходный сайт



* Visibility: **public**



